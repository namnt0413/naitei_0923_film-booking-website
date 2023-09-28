<?php

namespace App\Http\Controllers;

use App\Http\Requests\Film\SearchRequest;
use App\Http\Requests\Film\StoreRequest;
use App\Http\Requests\Film\UpdateRequest;
use App\Models\Film;
use App\Models\Genre;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use App\Services\MediaService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FilmController extends Controller
{
    private $mediaService;

    public function __construct(MediaService $mediaService)
    {
        $this->mediaService = $mediaService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $films = Film::with('medias')->paginate(config('app.items_per_page'));

        return view('films.index', compact('films'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genres = Genre::all(['id', 'name']);

        return view('films.create', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $createdFilm = Film::create($request->validated());
            $this->mediaService->handleStoreUpload($createdFilm, $request);
            foreach ($request->genres as $genre) {
                $createdFilm->genres()->attach($genre);
            }
            DB::commit();

            return redirect()->route('films.index')->with('success', trans('Successfully created'));
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' --- Line: ' . $exception->getLine());
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Film $film)
    {
        return view('films.show', compact('film'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Film $film)
    {
        $genres = Genre::all(['id', 'name']);

        return view('films.edit', compact('genres', 'film'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Film $film)
    {
        try {
            DB::beginTransaction();
            $film->update($request->validated());
            $this->mediaService->handleUpdateUpload($film, $request);
            $film->genres()->sync($request->genres);
            DB::commit();

            return redirect()->route('films.index')->with('success', trans('Successfully updated'));
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' --- Line: ' . $exception->getLine());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Film $film)
    {
        $film->tickets()->delete();
        $film->medias()->delete();
        $film->screenings()->delete();
        $film->genres()->detach();
        $film->delete();

        return redirect()->route('films.index')->with('success', trans('Successfully deleted'));
    }

    public function detail(Film $film)
    {
        $id = Auth::user()->id;
        $reviews = Review::with('user')->where('film_id', $film->id)->get();
        
        return view('films.detail', compact('film', 'reviews', 'id'));
    }

    public function search(SearchRequest $request)
    {
        $validated = $request->validated();
        $films = Film::when(isset($validated['search']), function ($q) use ($validated) {
            return $q->where('title', 'like', '%' . $validated['search'].'%')
                ->orWhere('description', 'like', '%' . $validated['search'].'%')
                ->orWhere('director', 'like', '%' . $validated['search'].'%');
        })->when(isset($validated['remain']), function ($q) use ($validated) {
            if ($validated['remain']) {
                return $q->whereHas('screenings', function ($q) {
                    return $q->where('remain', '>', 0);
                });
            } else {
                return $q->whereDoesntHave('screenings', function ($q) {
                    return $q->where('remain', '>', 0);
                });
            }
        })->paginate(config('app.items_per_page'));

        return view('films.search', compact('films'));
    }
}

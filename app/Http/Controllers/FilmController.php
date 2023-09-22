<?php

namespace App\Http\Controllers;

use App\Http\Requests\Film\StoreRequest;
use App\Http\Requests\Film\UpdateRequest;
use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\Film;
use App\Services\MediaService;
use Illuminate\Support\Facades\Log;
use DB;

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
        $genres = Genre::all(['id','name']);

        return view('films.create', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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

            return redirect()->route('films.index')->with('success', trans('Successfully deleted'));
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' --- Line: ' . $exception->getLine());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Film $film
     * @return \Illuminate\Http\Response
     */
    public function show(Film $film)
    {
        return view('films.show', compact('film'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Film $film
     * @return \Illuminate\Http\Response
     */
    public function edit(Film $film)
    {
        $genres = Genre::all(['id','name']);

        return view('films.edit', compact('genres', 'film'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Film $film
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
     * @param  \App\Models\Film $film
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
        return view('films.detail', compact('film'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\Screening\CreateRequest;
use App\Http\Requests\Screening\UpdateRequest;
use App\Models\Film;
use App\Models\Room;
use App\Models\Screening;
use Illuminate\Support\Facades\Request;

class ScreeningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $screenings = Screening::with('film:id,title')->paginate(config('app.items_per_page'));

        return view('screenings.index', compact('screenings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $films = Film::all(['id', 'title']);
        $rooms = Room::all(['id','name']);

        return view('screenings.create', compact('films', 'rooms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $validated = $request->validated();

        if (checkOverlapped(
            'screenings',
            $request->input('start_time'),
            $request->input('end_time'),
            $request->input('room_id'),
            null
        )) {
            return redirect()->back()->with('error', trans('Overlapped time'));
        }

        Screening::create(array_merge($validated, ["remain" => $validated['total']]));

        return redirect()->back()->with('success', trans("Successfully created"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Screening  $screening
     * @return \Illuminate\Http\Response
     */
    public function show(Screening $screening)
    {
        return view('screenings.show', compact('screening'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Screening  $screening
     * @return \Illuminate\Http\Response
     */
    public function edit(Screening $screening)
    {
        return view('screenings.edit', compact('screening'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Screening  $screening
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Screening $screening)
    {
        $validated = $request->validated();

        if (checkOverlapped(
            'screenings',
            $validated['start_time'],
            $validated['end_time'],
            $screening->room_id,
            $screening->id
        )) {
            return redirect()->back()->with('error', trans('Overlapped time'));
        }

        $screening->start_time = $validated['start_time'];
        $screening->end_time = $validated['end_time'];
        $screening->save();

        return redirect()->back()->with('success', trans("Successfully updated"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Screening  $screening
     * @return \Illuminate\Http\Response
     */
    public function destroy(Screening $screening)
    {
        $screening->tickets()->delete();
        $screening->delete();

        return redirect()->route('screenings.index')->with('success', trans('Successfully deleted'));
    }

    public function searchByRoom(Request $request, int $room, int $film)
    {
        return response()->json(
            Screening::where('room_id', $room)
            ->where('film_id', $film)
            ->where('remain', '>', 0)
            ->whereRaw('start_time >= NOW()')
            ->get()
        );
    }

    public function searchScreeningByDate($date)
    {
        $screenings = Screening::with('film.medias', 'room:id,name')
            ->selectRaw('* , DATE_FORMAT(start_time, "%H:%i") AS startTime, DATE_FORMAT(end_time, "%H:%i") AS endTime')
            ->whereRaw('DATE(start_time) = ?', [$date])
            ->whereRaw('start_time >= NOW()')
            ->take(config('app.homepage_max_screening_item'))->orderBy('start_time', 'ASC')->get();

        return $screenings;
    }
}

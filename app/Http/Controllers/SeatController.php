<?php

namespace App\Http\Controllers;

use App\Http\Requests\Seat\CreateRequest;
use App\Http\Requests\Seat\UpdateRequest;
use App\Models\Room;
use App\Models\Seat;
use Illuminate\Support\Facades\DB;

class SeatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seats = Seat::with('room:id, name')->orderBy('room_id')->paginate(config('app.items_per_page'));

        return view('seats.index', compact('seats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rooms = Room::all(['id', 'name']);

        return view('seats.create'. compact('rooms'));
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
        Seat::create($validated);

        return redirect()->back()->with('success', trans('Successfully created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function show(Seat $seat)
    {
        return view('seats.show', compact('seat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function edit(Seat $seat)
    {
        return view('seats.edit', compact('seat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Seat $seat)
    {
        $validated = $request->validated();
        $seat->price_ratio = $validated['price_ratio'];
        $seat->type = $validated['type'];
        $seat->save();

        return redirect()->back()->with('success', trans('Successfully updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seat $seat)
    {
        DB::transaction(function () use ($seat) {
            $seat->tickets()->delete();
            $seat->delete();
        }, config('app.transaction_request'));

        return redirect()->route('rooms.index')->with('success', trans('Successfully deleted'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\Room\CreateRequest;
use App\Http\Requests\Room\UpdateRequest;
use App\Models\Room;
use App\Models\Screening;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use App\Traits\StoreImageTrait;

class RoomController extends Controller
{
    use StoreImageTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::paginate(config('app.items_per_page'));

        return view('rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRoomRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        if ($request->hasFile('image')) {
            $imageUpload = $this->uploadImageToStorage($request->file('image'), 'room');
        }
        $validated = $request->validated();
        Room::create([
            "name" => $validated["name"],
            "image" => $imageUpload["link"],
        ]);

        return redirect()->route('rooms.index')->with('success', trans('Successfully created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        return view('rooms.show', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        return view('rooms.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRoomRequest  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Room $room)
    {
        $validated = $request->validated();
        $room->name = $validated['name'];
        if ($request->hasFile('image')) {
            $imageUpload = $this->uploadImageToStorage($request->file('image'), 'room');
            $room->image =  $imageUpload['link'];
        }
        $room->save();

        return redirect()->route('rooms.index')->with('success', trans('Successfully updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        DB::transaction(function () use ($room) {
            $seatIds = $room->seats->pluck('id');
            Ticket::whereIn('seat_id', $seatIds)->delete();
            $screeingIds = $room->screenings->pluck('id');
            Ticket::whereIn('screening', $screeingIds)->delete();
            $room->seats()->delete();
            $room->screenings()->delete();
            $room->delete();
        }, config('app.transaction_request'));

        return redirect()->route('rooms.index')->with('success', trans('Successfully deleted'));
    }

    public function detail(int $room)
    {
        return response()->json(
            Room::where('id', $room)->get()
        );
    }
}

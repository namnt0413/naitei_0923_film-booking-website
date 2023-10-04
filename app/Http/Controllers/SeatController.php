<?php

namespace App\Http\Controllers;

use App\Http\Requests\Seat\CreateRequest;
use App\Http\Requests\Seat\UpdateRequest;
use App\Models\Room;
use App\Models\Screening;
use App\Models\Seat;
use App\Models\Ticket;
use App\Repositories\SeatRepositoryInterface;
use Illuminate\Support\Facades\Request;

class SeatController extends Controller
{
    private $repository;

    public function __construct(SeatRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seats = $this->repository->getAll();

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

        return view('seats.create', compact('rooms'));
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

        $response = $this->repository->insert($validated);

        if (isset($response['error'])) {
            return redirect()->route('seats.index')->with('error', $response['error']);
        }

        return redirect()->route('seats.index')->with('success', $response['success']);
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

        $response = $this->repository->update($seat, $validated);

        return redirect()->route('seats.index')->with('success', $response['success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seat $seat)
    {
        $response = $this->repository->delete($seat);

        return redirect()->route('rooms.index')->with('success', $response['success']);
    }

    public function searchByRoom(Request $request, Room $room)
    {
        $seats = $this->repository->searchByRoom($room);

        return response()->json($seats);
    }

    public function searchByRoomScreening(Request $request, Room $room, Screening $screening)
    {
        $seatIds = $room->seats()->pluck('id')->all();
        $cannotBookingSeatIds = Ticket::whereIn('seat_id', $seatIds)
            ->where('screening_id', $screening->id)
            ->pluck('seat_id')
            ->all();
        $seats = Seat::where('room_id', $room->id)
            ->whereIn('id', $cannotBookingSeatIds)
            ->get();
        return response()->json($seats);
    }
}

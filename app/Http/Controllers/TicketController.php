<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ticket\CreateRequest;
use App\Http\Requests\Ticket\UpdateRequest;
use App\Models\Film;
use App\Models\Screening;
use App\Models\Seat;
use App\Models\Ticket;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    public function renderBooking(Request $request, Film $film)
    {
        $mediaByType = [
            'avatar' => [],
            'image' => [],
            'trailer' => [],
        ];
        foreach ($film->medias as $media) {
            $mediaByType[$media['type']][] = $media['link'];
        }
        $film->avatar = $mediaByType['avatar'];
        $film->image = $mediaByType['image'];
        $film->trailer = $mediaByType['trailer'];

        $rooms = [];
        $tmpScreenings = Film::with('screenings.room')->find($film->id)->screenings;
        foreach ($tmpScreenings as $screeing) {
            array_push($rooms, $screeing->room);
        }
        $rooms = array_unique($rooms);

        return view('tickets.booking', [
            "film" => $film,
            "rooms" => $rooms,
        ]);
    }

    // create function get all booked tickets
    public function bookedTickets(Request $request)
    {
        $tickets = Ticket::with(['film', 'screening', 'seat'])
            ->where('user_id', Auth::user()->id)
            ->paginate(config('app.items_pre_page'));

        return view('tickets.booked', compact('tickets'));
    }

    public function detailTicket(Ticket $ticket)
    {
        return view('tickets.detail', compact('ticket'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::with(['film', 'screening', 'user'])->paginate(config('app.items_per_page'));

        return view('tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $validated = $request->validated();
                $user_id = Auth::user()->id;
                $price = config('app.price');
                $screeing = Screening::find($validated['screening_id']);
                $screeing->remain -= count($validated['seats']);
                $screeing->save();
                if ($screeing->remain < 0) {
                    throw new Exception(trans('Unsuccessfully created'));
                }
                // createMany
                $data = [];
                $seats = Seat::whereIn('id', $validated['seats'])->get();
                foreach ($seats as $seat) {
                    $ticket = [
                        'film_id' => $validated['film_id'],
                        'room_id' => $validated['room_id'],
                        'screening_id' => $validated['screening_id'],
                        'user_id' => $user_id,
                        'seat_id' => $seat->id,
                        'price' => $price * $seat->price_ratio,
                        'created_at' => Carbon::now()->toDateTimeString(),
                        'updated_at' => Carbon::now()->toDateTimeString(),
                    ];
                    array_push($data, $ticket);
                }
                Ticket::insert($data);
            }, config('app.transaction_request'));
    
            return redirect()->back()->with('success', trans('Successfully created'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', trans($th->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        return view('tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        return view('tickets.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Ticket $ticket)
    {
        $validated = $request->validated();
        $ticket->price = $validated['price'];
        $ticket->save();

        return redirect()->back()->with('success', trans('Successfully updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return redirect()->route('tickets.booked')->with('success', trans('Successfully deleted'));
    }
}

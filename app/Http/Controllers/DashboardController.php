<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $totalFilms = DB::table('films')->count('id');
        $totalTickets = DB::table('tickets')->count('id');
        $sumPrice = DB::table('tickets')->sum('price');
        $mostPopularFilm = Ticket::groupBy('film_id')
            ->selectRaw('film_id, sum(price) as sum_price')
            ->orderBy('sum_price', 'desc')->first()->film;
        $mostBookingUser = Ticket::groupBy('user_id')
            ->selectRaw('user_id, count(film_id) as count_film')
            ->orderBy('count_film', 'desc')->first()->user;
        
        return view('dashboard', [
            "sumPrice" => $sumPrice,
            "totalFilms" => $totalFilms,
            "totalTickets" => $totalTickets,
            "mostBookingUser" => $mostBookingUser,
            "mostPopularFilm" => $mostPopularFilm,
        ]);
    }
}

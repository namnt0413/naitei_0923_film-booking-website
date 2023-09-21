<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use App\Models\Screening;
use App\Models\Ticket;

class HomeController extends Controller
{
    public function index()
    {
        $newFilms = Film::latest('release_date', 'desc')->take(config('app.homepage_max_film_item'))->get();

        $hotFilms = Ticket::with('film')->selectRaw('film_id, COUNT(film_id)')
            ->groupBy('film_id')->orderBy('COUNT(film_id)', 'DESC')->limit(config('app.homepage_max_film_item'))->get();

        $currentScreenings = Screening::with('film.medias', 'room:id,name')
            ->selectRaw('* , DATE_FORMAT(start_time, "%H:%i") AS startTime, DATE_FORMAT(end_time, "%H:%i") AS endTime')
            ->whereRaw('DATE(start_time) = CURRENT_DATE')
            ->whereRaw('start_time >= NOW()')
            ->take(config('app.homepage_max_screening_item'))->orderBy('start_time', 'ASC')->get();

        return view('homes.index', compact('newFilms', 'hotFilms', 'currentScreenings'));
    }
}

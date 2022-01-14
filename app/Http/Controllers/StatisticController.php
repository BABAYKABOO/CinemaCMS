<?php

namespace App\Http\Controllers;


use App\Models\Booking;
use App\Models\Movie;
use App\Models\Timetable;
use App\Models\User;

class StatisticController extends Controller
{
    public function index()
    {
        $users = new User;
        $books_movie = Booking::selectRaw('movies.name as name, count(movies.movie_id) as count')
            ->groupBy('movies.movie_id')
            ->orderBy('count', 'desc')
            ->join('timetables', 'timetables.timetable_id', '=', 'bookings.timetable_id')
            ->join('movies', 'movies.movie_id', '=', 'timetables.movie_id')
            ->where('timetables.data', '>', date("Y-m-d", strtotime('- 7 days')))
            ->get();

        $tickets_count = count(Booking::where('')->get());
        dd($tickets_count);

        return view('admin.statistic', [
            'users' => $users,
            'books_movie' => $books_movie
        ]);
    }
}

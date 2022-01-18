<?php

namespace App\Http\Controllers;

use App\Filters\TimetablesFilter;
use App\Models\Cinema;
use App\Models\Hall;
use App\Models\Movie;
use App\Models\Timetable;
use App\Models\Type;
use Illuminate\Http\Request;

class Timetables_AdminController extends Controller
{
    public function showTimetables(TimetablesFilter $request)
    {
        $date = Timetable::orderBy('data')
            ->get()
            ->unique('data');

        $timetables = Timetable::filter($request)
            ->join('cinemas', 'cinemas.cinema_id', '=', 'timetables.cinema_id')
            ->join('movies', 'movies.movie_id', '=', 'timetables.movie_id')
            ->join('halls', 'halls.hall_id', '=', 'timetables.hall_id')
            ->orderBy('data')
            ->paginate(6);


        $types = Type::get();

        $cinemas = Cinema::get();

        $movies = Movie::get();

        $halls = array();
        foreach($cinemas as $cinema)
            $halls[$cinema->cinema_id] = Hall::where('cinema_id', $cinema->cinema_id)->get();

        return view('admin.timetables', [
            'timetables' => $timetables,
            'types' => $types,
            'cinemas' => $cinemas,
            'halls' => $halls,
            'dates' => $date,
            'movies' => $movies
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Filters\TimetablesFilter;
use App\Models\Timetable;
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
            ->get();


        $types = Timetable::join('types', 'types.type_id', '=', 'timetables.type_id')
            ->get()
            ->unique('type_id');

        $cinemas = Timetable::join('cinemas', 'cinemas.cinema_id', '=', 'timetables.cinema_id')
            ->get()
            ->unique('cinema_id');

        $movies = Timetable::join('movies', 'movies.movie_id', '=', 'timetables.movie_id')
            ->get()
            ->unique('movie_id');

        $halls = Timetable::join('halls', 'halls.hall_id', '=', 'timetables.hall_id')
            ->get()
            ->unique('hall_id');
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

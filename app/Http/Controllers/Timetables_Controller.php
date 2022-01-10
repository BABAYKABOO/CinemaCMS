<?php

namespace App\Http\Controllers;

use App\Filters\TimetablesFilter;
use App\Models\Cinema;
use App\Models\Hall;
use App\Models\Movie;
use App\Models\Timetable;
use App\Models\Type;
use DateTime;
use Illuminate\Http\Request;

class Timetables_Controller extends Controller
{
    public function translateDate(string $date) : string
    {
        $week = [
            'воскресенье',
          'понедельник',
          'вторник',
          'среда',
          'четверг',
          'пятница',
          'суббота'
        ];

        $arr = new DateTime($date);
        return $arr->format('j') . ' ' . Timetable::translateMonth($arr->format('n')-1) . ', ' . $week[$arr->format('N')-1];
    }
    public function showTimetables(TimetablesFilter $request)
    {
        $date = Timetable::filter($request)
            ->where('data', '>=', date("Y-m-d"))
            ->orderBy('data')
            ->get()
            ->unique('data');
        $timetables = array();
        foreach ($date as $item)
        {
            $timetables[$this->translateDate($item->data)] = Timetable::filter($request)
                        ->where('data', $item->data)
                        ->join('movies', 'movies.movie_id', '=', 'timetables.movie_id')
                        ->join('halls', 'halls.hall_id', '=', 'timetables.hall_id')
                        ->orderBy('data')
                        ->get();
        }

        $types = Type::get();

        $cinemas = Cinema::get();

        $movies = Movie::get();

        $halls = Hall::get();

        $dates = Timetable::where('data', '>=', date("Y-m-d"))
            ->orderBy('data')
            ->get()
            ->unique('data');

        return view('timetables', [
            'timetables' => $timetables,
            'types' => $types,
            'cinemas' => $cinemas,
            'dates' => $dates,
            'halls' => $halls,
            'movies' => $movies
        ]);
    }
}

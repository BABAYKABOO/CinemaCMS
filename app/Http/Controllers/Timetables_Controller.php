<?php

namespace App\Http\Controllers;

use App\Filters\TimetablesFilter;
use App\Models\Cinema;
use App\Models\Movie;
use App\Models\Timetable;
use App\Models\Type;
use DateTime;
use Illuminate\Http\Request;

class Timetables_Controller extends Controller
{
    public function translateDate(string $date) : string
    {
        $month = [
            'января',
            'февраля',
            'марта',
            'апреля',
            'мая',
            'июня',
            'июля',
            'августа',
            'сентября',
            'октября',
            'ноября',
            'декабря'
        ];
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
        return $arr->format('j') . ' ' . $month[$arr->format('n')-1] . ', ' . $week[$arr->format('N')-1];
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

        $types = Timetable::filter($request)
            ->join('types', 'types.type_id', '=', 'timetables.type_id')
            ->get()
            ->unique('type_id');

        $cinemas = Timetable::filter($request)
            ->join('cinemas', 'cinemas.cinema_id', '=', 'timetables.cinema_id')
            ->get()
            ->unique('cinema_id');

        $movies = Timetable::filter($request)
            ->join('movies', 'movies.movie_id', '=', 'timetables.movie_id')
            ->get()
            ->unique('movie_id');

        $halls = Timetable::filter($request)
            ->join('halls', 'halls.hall_id', '=', 'timetables.hall_id')
            ->get()
            ->unique('hall_id');

        return view('timetables', [
            'timetables' => $timetables,
            'types' => $types,
            'cinemas' => $cinemas,
            'dates' => $date,
            'halls' => $halls,
            'movies' => $movies
        ]);
    }
}

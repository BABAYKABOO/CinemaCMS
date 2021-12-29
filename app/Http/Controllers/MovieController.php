<?php

namespace App\Http\Controllers;

use App\Filters\TimetablesFilter;
use App\Models\Cinema;
use App\Models\Gallery;
use App\Models\Hall;
use App\Models\Movie;
use App\Models\Timetable;
use App\Models\Type;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Time;

class MovieController extends Controller
{
    public function month($id)
    {
        $arr = [
            'январь',
            'февраль',
            'март',
            'апрель',
            'май',
            'июнь',
            'июль',
            'август',
            'сентябрь',
            'октябрь',
            'ноябрь',
            'декабрь'
        ];
        return $arr[$id];
    }

    public function wday($id)
    {
        $arr = [
            'Вс',
            'Пн',
            'Вт',
            'Ср',
            'Чт',
            'Пт',
            'Сб'
        ];
        return $arr[$id];
    }
    public function showMovie(TimetablesFilter $request, int $id)
    {
        $movie = Movie::where('movie_id', $id)
            ->join('images', 'images.image_id', '=', 'movies.mainimg')
            ->first();
        $gallery = Gallery::where('gallery_id', $movie->gallery)
            ->join('images', 'images.image_id', '=', 'galleries.image_id')
            ->get();
        $cinemas = Cinema::get();
        $timetables = Timetable::filter($request)->where('movie_id', $id);
//        foreach ($timetables as $timetable) {
//            $day = getdate($timetable->data);
//            $time = getdate($timetable->data);
//            $date_day = array();
//            $date_time = array();
//            $info = array();
//            $date_day['day'] = $day['mday'];
//            $date_day['wday'] = $this->wday($day['wday']);
//            $date_day['month'] = $this->month($day['mon']);
//            $date_time['time'] = $time['hours'].':'.$time['minutes'];
//            $info['type'] = Type::where('type_id', $timetable->type_id)->get()->name;
//            $info['hall'] = Hall::where('hall_id', $timetable->hall_id)->get()->number;
//            $timetable->date_day = $date_day;
//            $timetable->date_time = $date_time;
//            $timetable->info = $info;
//        }

        return view('movie', [
            'movie' => $movie,
            'gallery' => $gallery,
            'cinemas' => $cinemas,
            'timetables' => $timetables
        ]);
    }
}

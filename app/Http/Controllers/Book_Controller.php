<?php

namespace App\Http\Controllers;

use App\Models\Hall;
use App\Models\Movie;
use App\Models\Timetable;
use Illuminate\Http\Request;

class Book_Controller extends Controller
{
    public function placeRow(array $places, int $max_place)
    {
        $places[] = array();
        for ($i = 0; $i < $max_place; $i++)
            $places[count($places)-1][] = true;

        return $places;
    }
    public function showBook(int $timetable_id)
    {
        $timetable = Timetable::where('timetable_id', $timetable_id)->first();

        $hall = Hall::where('hall_id', $timetable->hall_id)->first();
        $arr = explode('-', $timetable->data);
        $date = $arr[2].' '.Timetable::translateMonth($arr[1]).', '.$timetable->time.', '.$hall->number;
        $movie = Movie::where('movie_id', $timetable->movie_id)
            ->join('images', 'images.image_id', '=', 'movies.mainimg')
            ->first();

        $places = array();
        $places = $this->placeRow($places, 12);
        $places = $this->placeRow($places, 14);
        $places = $this->placeRow($places, 15);
        $places = $this->placeRow($places, 13);
        $places = $this->placeRow($places, 13);
        $places = $this->placeRow($places, 13);
        $places = $this->placeRow($places, 13);
        $places = $this->placeRow($places, 13);
        $places = $this->placeRow($places, 13);
        $places = $this->placeRow($places, 20);
        return view('book', [
            'timetable' => $timetable,
            'date' => $date,
            'movie' => $movie,
            'places' => $places
        ]);
    }
}

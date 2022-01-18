<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Hall;
use App\Models\HallSchema;
use App\Models\Movie;
use App\Models\Place;
use App\Models\Timetable;
use Illuminate\Http\Request;

class Book_Controller extends Controller
{
    public function showBook(int $timetable_id)
    {
        $timetable = Timetable::where('timetable_id', $timetable_id)->first();

        $hall = Hall::where('hall_id', $timetable->hall_id)->first();
        $arr = explode('-', $timetable->data);
        $date = $arr[2].' '.Timetable::translateMonth($arr[1]).', '.$timetable->time.', '.$hall->number;
        $movie = Movie::where('movie_id', $timetable->movie_id)
            ->join('images', 'images.image_id', '=', 'movies.mainimg')
            ->first();


        $places = Booking::bookPlace($timetable_id);

        return view('book', [
            'timetable' => $timetable,
            'date' => $date,
            'movie' => $movie,
            'places' => $places
        ]);
    }

    public function book(Request $request, int $timetable_id)
    {
        Booking::createBooking($request, $timetable_id);
        return redirect(route('book', $timetable_id));
    }
}

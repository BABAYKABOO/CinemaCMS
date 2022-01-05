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

        return view('movie', [
            'movie' => $movie,
            'gallery' => $gallery,
            'cinemas' => $cinemas,
            'timetables' => $timetables
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Movie;
use App\Models\Timetable;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function showMovie(int $id)
    {
        $movie = Movie::where('movie_id', $id)
            ->join('images', 'images.image_id', '=', 'movies.mainimg')
            ->first();
        $gallery = Gallery::where('gallery_id', $movie->gallery)
            ->join('images', 'images.image_id', '=', 'galleries.image_id')
            ->get();
        return view('movie', [
            'movie' => $movie,
            'gallery' => $gallery,
            'timetable' => Timetable::getConcreteTimetables($id)->get()
        ]);
    }
}

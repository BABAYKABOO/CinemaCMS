<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Timetable;
use Illuminate\Http\Request;

class PostersController extends Controller
{
    public function showMovies()
    {
        $movies = Movie::getMovies();
        foreach ($movies as $movie)
        {
            $data = Timetable::select('data')->orderBy('data')->where('movie_id', $movie->movie_id)->limit(1)->first();
            $movie->data = isset($data->data) ? $data->data : null;
        }
        return view('posters', [
            'movies' => $movies
        ]);
    }
}

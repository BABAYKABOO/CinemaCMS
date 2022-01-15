<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Timetable;
use Illuminate\Http\Request;

class PostersController extends Controller
{
    public function showMovies()
    {
        $movies = [];
        foreach (Movie::getMovies() as $movie)
        {
            $data = Timetable::select('data')
                ->where('data', '>=', today())
                ->orderBy('data')
                ->where('movie_id', $movie->movie_id)
                ->first();
            if (isset($data))
            {
                $movie->data = $data->data;
                $movies[] = $movie;
            }
        }
        return view('posters', [
            'movies' => $movies
        ]);
    }
}

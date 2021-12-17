<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class PosterAdminController extends Controller
{
    public function showMovies()
    {
        return view('admin.posters', [
            'moviesToday' => Movie::getMovies(date("Y-m-d")),
            'moviesSoon' => Movie::getMovies()
        ]);
    }
}

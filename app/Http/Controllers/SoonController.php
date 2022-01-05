<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Timetable;
use Illuminate\Http\Request;

class SoonController extends Controller
{
    public function showMovies()
    {
        return view('soon', [
            'movies' => Movie::getMovies('soon')
        ]);
    }
}

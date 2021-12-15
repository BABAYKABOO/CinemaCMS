<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index()
    {
        $movies = DB::table('movies')
            ->join('images', 'images.image_id', '=', 'movies.mainimg')
            ->join('seos', 'seos.seo_id', '=', 'movies.seo')
            ->get();
        return view('main', [
            'movies' => $movies
        ]);
    }
}

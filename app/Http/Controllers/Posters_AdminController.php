<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Timetable;
use Illuminate\Http\Request;

class Posters_AdminController extends Controller
{
    public function showMovies()
    {
        $movies_id = Movie::get();
        $movies_without_tt = array();
        foreach ($movies_id as $id) {
            $isntHave = true;
                foreach (Timetable::orderBy('data', 'desc')->get()->unique('movie_id')  as $timetable) {
                    if ($id->movie_id == $timetable->movie_id) {
                        if ($timetable->data > today()){
                        $isntHave = false;
                        break;
                        }
                    }
                }
            if ($isntHave)
                $movies_without_tt[] = Movie::where('movie_id', $id->movie_id)
                    ->join('images', 'images.image_id', '=', 'movies.mainimg')->first();

        }

        return view('admin.posters', [
            'moviesToday' => Movie::getMovies(date("Y-m-d")),
            'moviesSoon' => Movie::getMovies('soon'),
            'movie_wt_tt' => $movies_without_tt
        ]);
    }
}

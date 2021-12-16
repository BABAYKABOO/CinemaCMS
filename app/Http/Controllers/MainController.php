<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index()
    {
        $arr = [
            'января',
            'февраля',
            'марта',
            'апреля',
            'мая',
            'июня',
            'июля',
            'августа',
            'сентября',
            'октября',
            'ноября',
            'декабря'
        ];
        $month = date('n')-1;

        return view('main', [
            'moviesToday' => Movie::getMovies(date("Y-m-d")),
            'moviesSoon' => Movie::getMovies("soon"),
            'data' => [date("Y"), $arr[$month], date("d")]
        ]);
    }
}

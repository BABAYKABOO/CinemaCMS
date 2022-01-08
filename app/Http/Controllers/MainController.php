<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Movie;
use App\Models\PageMain;
use App\Models\Timetable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Type\Time;

class MainController extends Controller
{
    public function index()
    {
        return view('main', [
            'banner_main' => Banner::where('position_id', 1)
                             ->join('images', 'images.image_id', '=', 'banners.img')
                             ->get(),
            'banner_news' => Banner::where('position_id', 3)
                             ->join('images', 'images.image_id', '=', 'banners.img')
                             ->get(),
            'info_page' => PageMain::first(),
            'moviesToday' => Movie::getMovies(date("Y-m-d")),
            'moviesSoon' => Movie::getMovies("soon"),
            'data' => [date("Y"), Timetable::translateMonth(date('n')-1), date("d")]
        ]);
    }
}

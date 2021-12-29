<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use App\Models\CinemaCondition;
use App\Models\CinemaHall;
use App\Models\Gallery;
use App\Models\Image;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class CinemaIDController extends Controller
{
    public function showCinema(int $cinema_id)
    {
        $cinema = Cinema::where('cinema_id', $cinema_id)
            ->first();

        $img['logo'] = Image::where('image_id', $cinema->logo)->first()->image_url;
        $img['topbanner'] = Image::where('image_id', $cinema->topbanner)->first()->image_url;
        $img['gallery'] = Gallery::where('gallery_id', $cinema->gallery)
                            ->join('images', 'images.image_id', '=', 'galleries.image_id')
                            ->get();

        $types = Type::get();

        $conditions = CinemaCondition::where('cinema_id', $cinema_id)
                            ->join('conditions', 'conditions.condition_id', '=', 'cinema_conditions.condition_id')
                            ->get();

        $halls = CinemaHall::where('cinema_id', $cinema_id)
                ->join('halls', 'halls.hall_id', '=', 'cinema_halls.hall_id')
                ->get();
        return view('cinema', [
            'cinema' => $cinema,
            'img' => $img,
            'types' => $types,
            'conditions' => $conditions,
            'halls' => $halls
        ]);
    }
}

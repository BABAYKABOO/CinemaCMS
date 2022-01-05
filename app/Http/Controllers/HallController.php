<?php

namespace App\Http\Controllers;

use App\Models\CinemaHall;
use App\Models\hall;
use App\Models\hallCondition;
use App\Models\hallHall;
use App\Models\Gallery;
use App\Models\Image;
use App\Models\Type;
use Illuminate\Http\Request;

class HallController extends Controller
{
    public function showHall(int $cinema_id, int $hall_id)
    {
        $hall = hall::where('hall_id', $hall_id)
            ->first();

        $img['schema'] = Image::where('image_id', $hall->schema)->first()->image_url;
        $img['topbanner'] = Image::where('image_id', $hall->topbanner)->first()->image_url;
        $img['gallery'] = Gallery::where('gallery_id', $hall->gallery)
            ->join('images', 'images.image_id', '=', 'galleries.image_id')
            ->get();

        $halls = CinemaHall::where('cinema_id', $cinema_id)
            ->join('halls', 'halls.hall_id', '=', 'cinema_halls.hall_id')
            ->get();
        return view('hall', [
            'cinema_id' => $cinema_id,
            'hall' => $hall,
            'img' => $img,
            'halls' => $halls
        ]);
    }
}
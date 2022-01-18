<?php

namespace App\Http\Controllers;

use App\Models\Hall;
use App\Models\Gallery;
use App\Models\Image;
use App\Models\Type;
use Illuminate\Http\Request;

class HallController extends Controller
{
    public function showHall(int $cinema_id, int $hall_id)
    {
        $hall = Hall::where('hall_id', $hall_id)
            ->join('images', 'images.image_id', '=', 'halls.topbanner')
            ->first();
        $gallery = Gallery::where('gallery_id', $hall->gallery)
            ->join('images', 'images.image_id', '=', 'galleries.image_id')
            ->get();

        $halls = Hall::where('cinema_id', $cinema_id)
            ->get();
        return view('hall', [
            'cinema_id' => $cinema_id,
            'hall' => $hall,
            'gallery' => $gallery,
            'halls' => $halls
        ]);
    }
}

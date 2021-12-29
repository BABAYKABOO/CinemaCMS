<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use Illuminate\Http\Request;

class CinemasController extends Controller
{
    public function showCinemas()
    {
        $cinemas = Cinema::join('images', 'images.image_id', '=', 'cinemas.mainimg')
                    ->get();

        return view('cinemas', [
            'cinemas' => $cinemas
        ]);
    }
}

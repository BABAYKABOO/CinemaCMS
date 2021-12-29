<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use Illuminate\Http\Request;

class Cinemas_AdminController extends Controller
{
    public function showCinemas()
    {
        $cinemas = Cinema::join('images', 'images.image_id', '=', 'cinemas.mainimg')
            ->get();

        return view('admin.cinemas', [
            'cinemas' => $cinemas
        ]);
    }
}

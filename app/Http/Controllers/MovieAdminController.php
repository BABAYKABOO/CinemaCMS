<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieAdminController extends Controller
{
    public function showCard(int $id)
    {
        return view('admin.movie', [
            'movie' => Movie::where('movie_id', $id)->first()
        ]);
    }

    public function save(Request $request, int $id)
    {
        Image::uploadImage($request, $id, 'mainimg', 'Movie');
        dd($request);
        return view('admin.movie', [
            'movie' => Movie::where('movie_id', $id)->first()
        ]);
    }
}

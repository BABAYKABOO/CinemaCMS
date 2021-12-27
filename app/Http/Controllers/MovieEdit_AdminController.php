<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Image;
use App\Models\Movie;
use App\Models\MovieType;
use App\Models\Seo;
use App\Models\Type;
use Illuminate\Http\Request;

class MovieEdit_AdminController extends Controller
{
    public function showCard(int $id)
    {
        $movie = Movie::where('movie_id', $id)
                ->join('images', 'images.image_id', '=', 'movies.mainimg')
                ->first();
        $gallery = Gallery::where('gallery_id', $movie->gallery)
                ->join('images', 'images.image_id', '=', 'galleries.image_id')
                ->get();
        $seo = Seo::where('seo_id', $movie->seo)->first();
        $types = MovieType::join('types', 'types.type_id', '=', 'movie_types.type_id')
                 ->where('movie_id', $id)->get();
        $all_types = Type::get();

        return view('admin.movie_edit', [
            'movie' => $movie,
            'gallery' => $gallery,
            'seo' => $seo,
            'types' => $types,
            'all_types' => $all_types
        ]);
    }

    public function save(Request $request, int $movie_id)
    {
        $movie = Movie::where('movie_id', $movie_id)->first();
        $seo_id = Seo::where('seo_id', $movie->seo)->first()->seo_id;
        Seo::saveSeo($request->Seo, $seo_id);
        MovieType::saveTypes($request->Types, $movie_id);
        Movie::saveMovie($request, $movie_id);

        return redirect(route('admin-movie_id', $movie_id));
    }

    public function delete(int $movie_id)
    {
        $movie = Movie::where('movie_id', $movie_id)->first();

        Movie::where('movie_id', $movie_id)->delete();

        foreach (Gallery::where('gallery_id', $movie->gallery)->get() as $image)
            Image::deleteImg($image->image_id);

        Image::deleteImg($movie->mainimg);
        Seo::where('seo_id', $movie->seo)->delete();
        return redirect(route('admin-posters'));
    }
}

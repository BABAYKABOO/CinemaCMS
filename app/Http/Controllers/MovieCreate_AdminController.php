<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\MovieType;
use App\Models\PeoplePosition;
use App\Models\Seo;
use App\Models\Type;
use Illuminate\Http\Request;

class MovieCreate_AdminController extends Controller
{
    public function showView()
    {
        $all_types = Type::get();
        $positions = PeoplePosition::get();
        $genres = Genre::get();
        return view('admin.movie_create', [
            'all_types' => $all_types,
            'positions' => $positions,
            'genres' => $genres
        ]);
    }

    public function create(Request $request)
    {
        MovieType::saveTypes($request->Types,
            Movie::createMovie($request,
                Seo::createSeo($request->Seo)));

        return redirect(route('admin-posters'));
    }
}

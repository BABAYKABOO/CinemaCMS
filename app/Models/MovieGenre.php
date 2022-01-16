<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class MovieGenre extends Model
{
    use HasFactory;
    public $timestamps = false;


    protected $fillable = [
        'genre_id',
        'movie_id'
    ];

    static function createMovieGenre(Request $request, int $movie_id)
    {
        if (count($request->genres_active) != count(MovieGenre::where('movie_id', $movie_id)->get()))
        {
            MovieGenre::where('movie_id', $movie_id)->delete();
            foreach ($request->genres_active as $id => $genre)
            {
                MovieGenre::insert([
                    'movie_id' => $movie_id,
                    'genre_id' => $id
                ]);
            }
        }
    }
}

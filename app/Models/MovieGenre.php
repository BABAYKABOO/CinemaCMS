<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieGenre extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'genre_id',
        'movie_id'
    ];

    static function createMovieGenre(array $genres, $movie_id)
    {
        foreach ($genres as $genre)
        {
            MovieGenre::insert([
                'movie_id' => $movie_id,
                'genre_id' => $genre
            ]);
        }
    }
}

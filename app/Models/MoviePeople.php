<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoviePeople extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'people_id',
        'movie_id',
        'position',
        'name',
    ];

    static function createPeople(array $people, int $movie_id)
    {
        foreach ($people as $person)
        {
            MoviePeople::insert([
                'movie_id' => $movie_id,
                'position_id' => $person['position'],
                'name' => $person['name']
            ]);
        }
    }
}

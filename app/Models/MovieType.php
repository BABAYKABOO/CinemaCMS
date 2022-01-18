<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieType extends Model
{
    use HasFactory;

    public $timestamps = false;


    protected $fillable = [
        'movie_id',
        'type_id'
    ];


    static function saveTypes(array $arr, int $movie_id)
    {
        MovieType::where('movie_id', $movie_id)->delete();
        foreach ($arr as $key => $value){
            MovieType::insert([
                'movie_id' => $movie_id,
                'type_id' => $key
                ]);
        }
    }
}

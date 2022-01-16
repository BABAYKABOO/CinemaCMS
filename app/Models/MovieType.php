<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieType extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = [
        'movie_id',
        'type_id',
        ];

    protected $fillable = [
        'movie_id',
        'type_id'
    ];

    public function movie()
    {
        $this->hasMany(Movie::class);
    }

    public function type()
    {
        return $this->hasMany(Type::class);
    }

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

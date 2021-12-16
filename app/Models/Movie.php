<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Movie extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'movie_id',
        'name',
        'desc',
        'mainimg',
        'gallery',
        'trailer',
        'type',
        'seo'
    ];
    public function image()
    {
        $this->hasMany(Image::class);
    }
    public function seo()
    {
        return $this->hasOne(Seo::class);
    }


    static function getMovies($data = null)
    {
        if ($data == "soon"){
            $data = date("Y-m-d");
            $movies = DB::table('timetables')
                ->join('movies', 'movies.movie_id', '=', 'timetables.movie_id')
                ->join('images', 'images.image_id', '=', 'movies.mainimg')
                ->join('seos', 'seos.seo_id', '=', 'movies.seo')
                ->where('timetables.data', '>', $data)
                ->get();
        }
        else if (isset($data)) {
            $movies = DB::table('timetables')
                ->join('movies', 'movies.movie_id', '=', 'timetables.movie_id')
                ->join('images', 'images.image_id', '=', 'movies.mainimg')
                ->join('seos', 'seos.seo_id', '=', 'movies.seo')
                ->where('timetables.data', $data)
                ->get();
        }
        else
        {
            $movies = DB::table('movies')
                ->join('images', 'images.image_id', '=', 'movies.mainimg')
                ->join('seos', 'seos.seo_id', '=', 'movies.seo')
                ->get();
        }
        return $movies;
    }
}

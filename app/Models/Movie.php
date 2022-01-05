<?php

namespace App\Models;


use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
            $movies = [];
            foreach (Movie::getMovies() as $movie)
            {
                $time = Timetable::select('data')
                    ->orderBy('data')
                    ->where('movie_id', $movie->movie_id)
                    ->limit(1)
                    ->first();
                if (isset($time) && $time->data > date("Y-m-d"))
                {
                    $movie->data = $time->data;
                    $movies[] = $movie;
                }
            }
        }
        else if (isset($data)) {
            $movies = [];
            foreach (Movie::getMovies() as $movie)
            {
                $time = Timetable::select('data')
                    ->orderBy('data')
                    ->where('movie_id', $movie->movie_id)
                    ->limit(1)
                    ->first();
                if (isset($time) && $time->data == $data)
                {
                    $movie->data = $data->data;
                    $movies[] = $movie;
                }
            }
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

    static function getConcreteMovie(int $movie_id)
    {
        return Movie::where('movies.movie_id', $movie_id);
    }


    static function saveMovie(Request $request, int $movie_id)
    {
        $movie = Movie::where('movie_id', $movie_id)->first();
        Movie::where('movie_id', $movie_id)->update([
                'name' => $request->name,
                'desc' => $request->desc,
                'mainimg' => Image::saveImg($request, 'mainimg', $movie->mainimg),
                'gallery' => Image::uploadGallery($request, $movie->gallery),
                'trailer' => $request->trailer
            ]);
    }

    static function createMovie(Request $request, int $seo_id)
    {
        Movie::insert([
                'name' => $request->name,
                'desc' => $request->desc,
                'mainimg' => Image::saveImg($request, 'mainimg'),
                'gallery' => Movie::uploadGallery($request),
                'trailer' => $request->trailer,
                'seo' => $seo_id
            ]);
        return Movie::max('movie_id');
    }
}

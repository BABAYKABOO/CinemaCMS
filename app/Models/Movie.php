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
        'seo',
        'year',
        'counrty',
        'budget',
        'age',
        'time'
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
                    $movie->data = $time->data;
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

    static function saveMovie(Request $request, int $movie_id)
    {
        $movie = Movie::where('movie_id', $movie_id)->first();
        Movie::where('movie_id', $movie_id)->update([
                'name' => $request->name,
                'desc' => $request->desc,
                'mainimg' => Image::saveImg($request, 'mainimg', $movie->mainimg),
                'gallery' => Image::uploadGallery($request, 'Gallery', $movie->gallery),
                'trailer' => $request->trailer,
                'year' => $request->year,
                'country' => $request->country,
                'budget' => $request->budget,
                'age' => $request->age,
                'movie_time' => $request->movie_time
            ]);
        if (count($request->People) != count(MoviePeople::where('movie_id', $movie_id)->get()))
        {
            MoviePeople::where('movie_id', $movie_id)->delete();
            MoviePeople::createPeople($request->People, $movie_id);
        }

        if (count($request->People) != count(MovieGenre::where('movie_id', $movie_id)->get()))
        {
            MovieGenre::where('movie_id', $movie_id)->delete();
            MovieGenre::createMovieGenre($request->genres_active, $movie_id);
        }
        return $movie_id;
    }

    static function createMovie(Request $request, int $seo_id)
    {
        Movie::insert([
                'name' => $request->name,
                'desc' => $request->desc,
                'mainimg' => Image::saveImg($request, 'mainimg'),
                'gallery' => Image::uploadGallery($request, 'Gallery'),
                'trailer' => $request->trailer,
                'year' => $request->year,
                'country' => $request->country,
                'budget' => $request->budget,
                'age' => $request->age,
                'time' => $request->time,
                'seo' => $seo_id
            ]);
        $movie_id = Movie::max('movie_id');
        MovieGenre::createMovieGenre($request->genres_active, $movie_id);
        MoviePeople::createPeople($request->People, $movie_id);
        return $movie_id;
    }
}

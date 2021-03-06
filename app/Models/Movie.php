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

    protected $primaryKey = 'movie_id';

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
        'movie_time'
    ];

    public function mainimg()
    {
        return $this->hasOne(Image::class, 'image_id', 'mainimg');
    }
    public function gallery()
    {
        return $this->hasOne(Gallery::class, 'gallery_id', 'gallery');
    }
    public function seo()
    {
        return $this->hasOne(Seo::class, 'seo_id', 'seo');
    }
    public function types()
    {
        return $this->belongsToMany(Type::class, 'movie_types', 'movie_id', 'type_id');
    }
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'movie_genre', 'movie_id', 'genre_id');
    }
    public function people()
    {
        return $this->belongsTo(MoviePeople::class, 'movie_id', 'movie_id');
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
                if (isset($time) && $time->data > date("Y-m-d", strtotime('+ 7 days')))
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
                    ->where('data', '>=', date("Y-m-d"))
                    ->where('movie_id', $movie->movie_id)
                    ->orderBy('data')
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
            $movies = Movie::join('images', 'images.image_id', '=', 'movies.mainimg')
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

        MoviePeople::createPeople($request, $movie_id);
        MovieGenre::createMovieGenre($request, $movie_id);
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
                'movie_time' => $request->movie_time,
                'seo' => $seo_id
            ]);
        $movie_id = Movie::max('movie_id');
        MovieGenre::createMovieGenre($request, $movie_id);
        MoviePeople::createPeople($request, $movie_id);
        return $movie_id;
    }
}

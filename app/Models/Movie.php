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

    static function uploadGallery(Request $request, int $gallery_id = 0) : int
    {
        if ($gallery_id != 0) {
            $gallery = Gallery::where('gallery_id', $gallery_id)->get();
            foreach($request->Gallery as $key => $value)
            {
                $gallery[$key]->image_id = Image::saveImg($request, 'Gallery.'.$key, $gallery[$key]->image_id);

                Gallery::where('image_id', $gallery[$key]->image_id)->update([
                    'image_id' => $gallery[$key]->image_id
                ]);
            }
        }
        else
            $gallery_id = Gallery::max('image_id')+1;
        foreach($request->Gallery as $key => $value)
        {
            Gallery::Insert([
                'gallery_id' => $gallery_id,
                'image_id' => Image::saveImg($request, 'Gallery.'.$key)
            ]);
        }

        return $gallery_id;

    }

    static function saveMovie(Request $request, int $movie_id)
    {
        $movie = Movie::where('movie_id', $movie_id)->first();
        Movie::updateOrInsert(
            ['movie_id' => $movie_id],
            [
                'movie_id' => $movie_id,
                'name' => $request->name,
                'desc' => $request->desc,
                'mainimg' => Image::saveImg($request, 'mainimg', $movie->mainimg),
                'gallery' => Movie::uploadGallery($request, $movie->gallery),
                'trailer' => $request->trailer
            ]);
    }
}

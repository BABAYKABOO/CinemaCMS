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

    static function saveMainImg(Request $request, string $name, int $image_id = 0) : int
    {
        if ($request->hasFile($name)) {
            $path = $request->file($name)->store('img', 'public');
            $path = explode('/', $path);
            if ($image_id != 0) {
                Storage::delete('public/img/'.Image::where('image_id', $image_id)->first()->image_url);
                Image::where('image_id', $image_id)->update([
                    'image_url' => 'http://cinema.com/storage/img/'.$path[1]
                ]);
            }
            else {
                Image::insert([
                    'image_url' => 'http://cinema.com/storage/img/' . $path[1]
                ]);
                $image_id = Image::max('image_id');
            }
        }
        return $image_id;
    }
    static function uploadGallery(Request $request, int $gallery_id = 0) : int
    {
        if ($gallery_id != 0) {
            $gallery = Gallery::where('gallery_id', $gallery_id)->get();
            foreach($request->Gallery as $key => $value)
            {
                $image_old = $gallery[$key]->image_id;
                $gallery[$key]->image_id = Movie::saveMainImg($request, 'Gallery.'.$key);

                Gallery::where('image_id', $image_old)->update([
                    'image_id' => $gallery[$key]->image_id
                ]);

                Gallery::where('gallery_id', $gallery_id)->where('image_id', $image_old)->delete();
                Storage::delete('public/img/'.Image::where('image_id', $image_old)->first()->image_url);
                Image::where('image_id', $image_old)->delete();

            }

        }
        else
            $gallery_id = Gallery::latest()->first()->gallery_id + 1;

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
                'mainimg' => Movie::saveMainImg($request, 'mainimg', $movie->mainimg),
                'gallery' => Movie::uploadGallery($request, $movie->gallery),
                'trailer' => $request->trailer
            ]);
    }
}

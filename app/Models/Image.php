<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'image_id',
        'image_url'
    ];

    static function uploadImage(Request $request, int $id = 0, string $name = null, string $class = null)
    {
        if ($id != 0)
        {
            $nameclass = $class;
            $class = '\App\Models\\'.$class;
            $image_id = $class::where(strtolower($nameclass).'_id', $id)->first()->$name;
            Image::where('image_id', $image_id)->delete();
        }
        else
            $image_id = Image::latest()->first()->image_id + 1;


        if ($request->file($name)) {

            $file = $request->file($name);
            $upload_folder = 'public/img/'.strtolower($nameclass).'s';
            $filename = $file->getClientOriginalName(); // image.jpg

            Storage::putFileAs($upload_folder, $file, $filename);
            Image::insert([
                'image_id' => $image_id,
                'image_url' => 'http://cinema.com/img/'.strtolower($nameclass).'s'.'/'.$filename
            ]);
            $class::insert([
                strtolower($class).'_id' => $id,
                $name => $image_id
            ]);
        }

    }



    static function uploadGallery(Request $request, int $id = 0)
    {
        $image_id = Image::latest()->first()->image_id + 1;
        $gallery_id = 0;
        if ($id != 0) {
            $gallery_id = Movie::where('movie_id', $id)->first()->gallery;
            Gallery::where('id', $gallery_id)->delete();
        }
        else
            $gallery_id = Gallery::latest()->first()->gallery_id + 1;

        for ($i = 1; $i <= 5; $i++)
        {
            if ($request->file('gallery'.$i)) {

                $file = $request->file('gallery'.$i);
                $upload_folder = 'public/img/movies';
                $filename = $file->getClientOriginalName(); // image.jpg

                Storage::putFileAs($upload_folder, $file, $filename);
                Image::insert([
                    'image_id' => $image_id,
                    'image_url' => 'http://cinema.com/img/movies/'.$filename
                ]);
                Gallery::insert([
                    'gallery_id' => $gallery_id,
                    'image_id' => $image_id
                ]);
                $image_id++;
            }
        }
    }
}

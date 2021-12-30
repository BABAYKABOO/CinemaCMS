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

    static function deleteImg(int $image_id)
    {
        Storage::delete('public/img/'.Image::where('image_id', $image_id)->first()->image_url);
        Image::where('image_id', $image_id)->delete();
    }

    static function uploadGallery(Request $request, int $gallery_id = 0) : int
    {
        if ($request->hasFile('Gallery')) {
            if ($gallery_id != 0) {
                $gallery = Gallery::where('gallery_id', $gallery_id)->get();
                foreach ($request->Gallery as $key => $value) {
                    Gallery::where('image_id', $gallery[$key]->image_id)->update([
                        'image_id' => Image::saveImg($request, 'Gallery.' . $key, $gallery[$key]->image_id)
                    ]);
                }
            } else
                $gallery_id = Gallery::max('image_id') + 1;
            foreach ($request->Gallery as $key => $value) {
                Gallery::Insert([
                    'gallery_id' => $gallery_id,
                    'image_id' => Image::saveImg($request, 'Gallery.' . $key)
                ]);
            }
        }
        return $gallery_id;
    }

    static function saveImg(Request $request, string $name, int $image_id = 0) : int
    {
        if ($request->hasFile($name)) {
            $path = $request->file($name)->store('img', 'public');
            $path = explode('/', $path);
            if ($image_id != 0) {
                $old_path = explode('/', Image::where('image_id', $image_id)->first()->image_url);
                Storage::delete('public/img/'.$old_path[count($old_path)-1]);
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


}

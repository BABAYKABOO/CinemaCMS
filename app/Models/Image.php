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

    protected $primaryKey = 'image_id';

    protected $fillable = [
        'image_id',
        'image_url'
    ];

    public function discount()
    {
        return $this->belongsTo(Discount::class, 'mainimg', 'image_id');
    }
    public function discountTopbanner()
    {
        return $this->belongsTo(Discount::class, 'topbanner', 'image_id');
    }
    public function event()
    {
        return $this->belongsTo(Event::class, 'mainimg', 'image_id');
    }
    public function page()
    {
        return $this->belongsTo(Page::class, 'topbanner', 'image_id');
    }
    public function movie()
    {
        return $this->belongsTo(Movie::class, 'mainimg', 'image_id');
    }
    public function hall()
    {
        return $this->belongsTo(Hall::class, 'topbanner', 'image_id');
    }
    public function cinema()
    {
        return $this->belongsTo(Cinema::class, 'mainimg', 'image_id');
    }
    public function cinemaLogo()
    {
        return $this->belongsTo(Cinema::class, 'logo', 'image_id');
    }
    public function banner()
    {
        return $this->belongsTo(Banner::class, 'img', 'image_id');
    }
    public function contact()
    {
        return $this->belongsTo(Contact::class, 'maingimg', 'image_id');
    }
    public function contactLogo()
    {
        return $this->belongsTo(Contact::class, 'logo', 'image_id');
    }


    static function deleteImg(int $image_id)
    {
        Storage::delete('public/img/'.Image::where('image_id', $image_id)->first()->image_url);
        Image::where('image_id', $image_id)->delete();
    }

    static function uploadGallery(Request $request, string $name, int $gallery_id = 0) : int
    {
        if ($request->hasFile($name)) {
            if ($gallery_id != 0) {
                $gallery = Gallery::where('gallery_id', $gallery_id)->get();

                foreach ($request->$name as $key => $value) {
                    Gallery::where('image_id', $gallery[$key]->image_id)->update([
                        'image_id' => Image::saveImg($request, $name.'.'.$key, $gallery[$key]->image_id)
                    ]);
                }
            }
            else {
                $gallery_id = Gallery::max('image_id') + 1;
                foreach ($request->$name as $key => $value) {
                    Gallery::Insert([
                        'gallery_id' => $gallery_id,
                        'image_id' => Image::saveImg($request, $name.'.' . $key)
                    ]);
                }
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

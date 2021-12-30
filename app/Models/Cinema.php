<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Cinema extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'cinema_id',
        'name',
        'desc',
        'conditions',
        'logo',
        'topbanner',
        'gallery',
        'seo',
    ];

    public function image()
    {
        return $this->hasOne(Image::class);
    }
    public function gallery()
    {
        return $this->hasOne(Gallery::class);
    }
    public function seo()
    {
        return $this->hasOne(Seo::class);
    }

    static function saveCinema(Request $request, int $cinema_id)
    {
        $cinema = Cinema::where('cinema_id', $cinema_id)->first();
        Cinema::where('cinema_id', $cinema_id)->update([
            'name' => $request->name,
            'desc' => $request->desc,
            'mainimg' => Image::saveImg($request, 'mainimg', $cinema->mainimg),
            'logo' => Image::saveImg($request, 'logo', $cinema->logo),
            'topbanner' => Image::saveImg($request, 'topbanner', $cinema->topbanner),
            'gallery' => Image::uploadGallery($request, $cinema->gallery),
        ]);
    }
}

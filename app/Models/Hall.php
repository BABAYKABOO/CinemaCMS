<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Hall extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'hall_id';

    protected $fillable = [
        'hall_id',
        'cinema_id',
        'number',
        'desc',
        'topbanner',
        'gallery',
        'seo'
    ];
    public function place()
    {
        return $this->belongsTo(Place::class, 'hall_id', 'hall_id');
    }
    public function schema()
    {
        return $this->belongsTo(HallSchema::class, 'hall_id', 'hall_id');
    }
    public function topbanner()
    {
        return $this->hasOne(Image::class, 'image_id', 'topbanner');
    }
    public function gallery()
    {
        return $this->hasOne(Gallery::class, 'gallery_id', 'gallery');
    }
    public function seo()
    {
        return $this->hasOne(Seo::class, 'seo_id', 'seo');
    }
    public function cinema()
    {
        return $this->hasOne(Cinema::class, 'cinema_id', 'cinema_id');
    }

    static function saveHall(Request $request, int $hall_id)
    {
        $hall = Hall::where('hall_id', $hall_id)->first();
        Hall::where('hall_id', $hall_id)->update([
            'number' => $request->number,
            'desc' => $request->desc,
            'topbanner' => Image::saveImg($request, 'topbanner', $hall->topbanner),
            'gallery' => Image::uploadGallery($request, 'Gallery', $hall->gallery),
        ]);
    }

    static function createHall(Request $request, int $seo_id)
    {
        Hall::insert([
            'number' => $request->number,
            'desc' => $request->desc,
            'topbanner' => Image::saveImg($request, 'topbanner'),
            'gallery' => Image::uploadGallery($request, 'Gallery'),
            'seo' => $seo_id
        ]);
        return Hall::max('hall_id');
    }

    static function deleteHall(int $hall_id)
    {
        $hall = Hall::where('hall_id', $hall_id)->first();
        Timetable::where('hall_id', $hall_id)->delete();
        CinemaHall::where('hall_id', $hall_id)->delete();
        Hall::where('hall_id', $hall_id)->delete();

        Image::deleteImg($hall->topbanner);

        foreach (Gallery::where('gallery_id', $hall->gallery)->get() as $image)
            Image::deleteImg($image->image_id);

        Seo::where('seo_id', $hall->seo)->delete();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Event extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'event_id',
        'ua/ru',
        'status',
        'date',
        'name',
        'desc',
        'mainimg',
        'topbanner',
        'seo',
    ];

    static function createDiscount(Request $request, int $seo_id) : int
    {
        Event::insert([
            'status' => $request->status == 'on' ? 1 : 0,
            'date' => $request->date,
            'name' => $request->name,
            'desc' => $request->desc,
            'mainimg' => Image::saveImg($request, 'mainimg'),
            'gallery' => Image::uploadGallery($request),
            'seo' => $seo_id
        ]);

        return Discount::max('discount_id');
    }
}

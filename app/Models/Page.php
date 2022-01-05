<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Page extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'page_id',
        'ua/ru',
        'status',
        'date',
        'name',
        'topbanner',
        'desc',
        'sub_gallery',
        'sub_desc',
        'gallery',
        'seo'
    ];

    static function createPage(Request $request, int $seo_id)
    {
        Page::insert([
            'status' => 1,
            'name' => $request->name,
            'topbanner' => Image::saveImg($request, 'topbanner'),
            'desc' => $request->desc,
            'sub_gallery' => Image::uploadGallery($request, 'Sub_Gallery'),
            'sub_desc' => $request->sub_desc,
            'gallery' => Image::uploadGallery($request),
            'seo' => $seo_id
        ]);

        return event::max('event_id');
    }
}

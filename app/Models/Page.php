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
            'gallery' => isset($request->Gallery) ? Image::uploadGallery($request, 'Gallery') : null,
            'seo' => $seo_id
        ]);

        return event::max('event_id');
    }

    static function savePage(Request $request, int $page_id)
    {
        $page = Page::where('page_id', $page_id)->first();
        Page::where('page_id', $page_id)->update([
            'status' => 1,
            'name' => $request->name,
            'topbanner' => Image::saveImg($request, 'topbanner', $page->topbanner),
            'desc' => $request->desc,
            'sub_gallery' => Image::uploadGallery($request, 'Sub_Gallery', $page->sub_gallery),
            'sub_desc' => $request->sub_desc,
            'gallery' => isset($request->Gallery) ? Image::uploadGallery($request, 'Gallery', isset($page->gallery) ? $page->gallery : 0) : null
        ]);
    }
}

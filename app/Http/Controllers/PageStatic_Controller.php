<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Page;
use Illuminate\Http\Request;

class PageStatic_Controller extends Controller
{
    public function showPage(int $page_id)
    {
        $page = Page::where('page_id', $page_id)
            ->join('images', 'images.image_id', '=', 'pages.topbanner')
            ->first();

        $sub_gallery = Gallery::where('gallery_id', $page->sub_gallery)
            ->join('images', 'images.image_id', '=', 'galleries.image_id')
            ->get();

        $gallery = Gallery::where('gallery_id', $page->gallery)
            ->join('images', 'images.image_id', '=', 'galleries.image_id')
            ->get();

        return view('page_static',[
            'page' => $page,
            'sub_gallery' => $sub_gallery,
            'gallery' => $gallery
        ]);
    }
}

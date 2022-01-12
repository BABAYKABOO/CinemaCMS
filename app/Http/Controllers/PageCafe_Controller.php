<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Page;
use Illuminate\Http\Request;

class PageCafe_Controller extends Controller
{
    public function showPage()
    {

        $page_id = 6;
        $page = Page::where('page_id', $page_id)
            ->join('images', 'images.image_id', '=', 'pages.topbanner')
            ->first();

        $sub_gallery = Gallery::where('gallery_id', $page->sub_gallery)
            ->join('images', 'images.image_id', '=', 'galleries.image_id')
            ->get();
        return view('page_cafe',[
            'page' => $page,
            'sub_gallery' => $sub_gallery
        ]);
    }
}

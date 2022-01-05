<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Page;
use App\Models\Seo;
use Illuminate\Http\Request;

class PageEdit_AdminController extends Controller
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


        $seo = Seo::where('seo_id', $page->seo)->first();

        return view('admin.page_edit',[
           'page' => $page,
           'sub_gallery' => $sub_gallery,
           'gallery' => $gallery,
           'seo' => $seo,
        ]);
    }

    public function save(Request $request, int $page_id)
    {
        $page = Page::where('page_id', $page_id)->first();
        Seo::saveSeo($request->Seo, $page->seo);
        Page::savePage($request, $page_id);

        return redirect(route('admin-page_id-edit', $page_id));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Page;
use App\Models\Seo;
use Illuminate\Http\Request;

class PageCreate_AdminController extends Controller
{
    public function showPage()
    {

        return view('admin.page_create');
    }

    public function create(Request $request)
    {
        Page::createPage($request, Seo::createSeo($request->Seo));
        return redirect(route('admin-pages'));
    }
}

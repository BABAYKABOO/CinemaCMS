<?php

namespace App\Http\Controllers;

use App\Models\PageMain;
use App\Models\Seo;
use Illuminate\Http\Request;

class Main_AdminController extends Controller
{
    public function showPage()
    {
        $page = PageMain::first();
        $seo = Seo::where('seo_id', $page->seo)->first();
        return view('admin.page_main', [
            'page' => $page,
            'seo' => $seo
        ]);
    }

    public function save(Request $request)
    {
        $page = PageMain::first();
        Seo::saveSeo($request->Seo, $page->seo);
        PageMain::savePage($request, $page->page_id);

        return redirect(route('admin-page_main'));
    }
}

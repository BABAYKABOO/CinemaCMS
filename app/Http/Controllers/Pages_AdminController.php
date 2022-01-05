<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class Pages_AdminController extends Controller
{
    public function showPages()
    {
        $pages = Page::get();
        return view('admin.pages', [
            'pages' => $pages
        ]);
    }
}

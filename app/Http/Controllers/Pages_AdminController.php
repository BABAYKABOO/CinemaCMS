<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Pages_AdminController extends Controller
{
    public function showPages()
    {
        return view('admin.pages');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use App\Models\Event;
use App\Models\Seo;
use Illuminate\Http\Request;

class EventCreate_AdminController extends Controller
{
    public function showEvent()
    {
        $cinemas = Cinema::get();
        return view('admin.event_create',[
            'cinemas' => $cinemas
        ]);
    }

    public function create(Request $request)
    {
        Event::createEvent($request, Seo::createSeo($request->Seo));
        return redirect(route('admin-events'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Seo;
use Illuminate\Http\Request;

class EventCreate_AdminController extends Controller
{
    public function showEvent()
    {
        return view('admin.event_create');
    }

    public function create(Request $request)
    {
        Event::createEvent($request, Seo::createSeo($request->Seo));
        return redirect(route('admin-events'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class Events_AdminController extends Controller
{
    public function showEvents()
    {
        $events = Event::join('images', 'images.image_id', '=', 'events.mainimg')
            ->get();

        return view('admin.events', [
            'events' => $events
        ]);
    }
}

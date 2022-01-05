<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Image;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function showEvents()
    {
        $events = Event::where('status', 1)->join('images', 'images.image_id', '=', 'events.mainimg')
            ->paginate(3);

        return view('events', [
            'events' => $events
        ]);
    }
}

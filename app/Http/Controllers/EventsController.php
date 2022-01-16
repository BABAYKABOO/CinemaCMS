<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Image;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function showEvents()
    {
        $events = Event::selectRaw('events.date, images.image_url, cinemas.name as cinema_name, events.name, events.desc')
            ->where('status', 1)
            ->join('images', 'images.image_id', '=', 'events.mainimg')
            ->join('cinemas', 'cinemas.cinema_id', '=', 'events.cinema_id')
            ->paginate(6);
        return view('events', [
            'events' => $events
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Seo;
use Illuminate\Http\Request;

class EventEdit_AdminController extends Controller
{
    public function showEvent(int $event_id)
    {
        $event = Event::where('event_id', $event_id)
            ->join('images', 'images.image_id', '=', 'events.mainimg')
            ->first();

        $gallery = Gallery::where('gallery_id', $event->gallery)
            ->join('images', 'images.image_id', '=', 'galleries.image_id')
            ->get();

        $cinemas = Cinema::get();

        $seo = Seo::where('seo_id', $event->seo)->first();

        return view('admin.event_edit', [
            'event' => $event,
            'gallery' => $gallery,
            'seo' => $seo,
            'cinemas' => $cinemas
        ]);
    }
    public function save(Request $request, int $event_id)
    {
        $event = Event::where('event_id', $event_id)->first();
        $seo_id = Seo::where('seo_id', $event->seo)->first()->seo_id;
        Seo::saveSeo($request->Seo, $seo_id);
        Event::saveEvent($request, $event_id);

        return redirect(route('admin-event-edit', $event_id));
    }

    public function delete(int $event_id)
    {
        Event::deleteEvent($event_id);
        return redirect(route('admin-events'));
    }
}

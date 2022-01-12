<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Event extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'event_id',
        'ua/ru',
        'status',
        'date',
        'name',
        'desc',
        'mainimg',
        'topbanner',
        'seo',
    ];

    static function createEvent(Request $request, int $seo_id) : int
    {
        Event::insert([
            'status' => $request->status == 'on' ? 1 : 0,
            'date' => $request->date,
            'name' => $request->name,
            'desc' => $request->desc,
            'mainimg' => Image::saveImg($request, 'mainimg'),
            'gallery' => Image::uploadGallery($request),
            'seo' => $seo_id
        ]);

        return event::max('event_id');
    }

    static function saveEvent(Request $request, int $event_id)
    {
        $event = Event::where('event_id', $event_id)->first();
        Event::where('event_id', $event_id)->update([
            'status' => $request->status == 'on' ? 1 : 0,
            'date' => $request->date,
            'name' => $request->name,
            'desc' => $request->desc,
            'mainimg' => Image::saveImg($request, 'mainimg', $event->mainimg),
            'gallery' => Image::uploadGallery($request, $event->gallery, $event->gallery)
        ]);
    }

    static function deleteEvent(int $event_id)
    {
        $event = Event::where('event_id', $event_id)->first();

        Event::where('event_id', $event_id)->delete();
        Image::deleteImg($event->mainimg);

        foreach (Gallery::where('gallery_id', $event->gallery)->get() as $image)
            Image::deleteImg($image->image_id);

        Seo::where('seo_id', $event->seo)->delete();
    }
}

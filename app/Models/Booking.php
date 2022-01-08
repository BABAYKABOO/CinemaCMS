<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Booking extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'booking_id',
        'user_id',
        'timetable_id',
        'place_id',
        'booking_date'
    ];

    static function createBooking(Request $request, int $timetable_id)
    {
        $places = array();
        $timetable = Timetable::where('timetable_id', $timetable_id)->first();
        foreach ($request->request as $row => $value)
        {
            if(is_numeric($row)) {
                foreach ($value as $place => $status) {
                    if (is_numeric($place)) {
                       $concrete_place = Place::insert([
                           'row' => $row,
                           'place' => $place,
                           'hall_id' => $timetable->hall_id
                       ]);
                       $places[] = $concrete_place->place_id;
                    }
                }
            }
        }
        foreach ($places as $place)
        {
            Booking::insert([
                'user_id',
                'timetable_id' => $timetable_id,
                'place_id' => $place
            ]);
        }
        dd($places_active);
    }
}

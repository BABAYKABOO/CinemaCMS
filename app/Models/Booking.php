<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Booking extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $primaryKey = 'booking_id';

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
                        $table_place = Place::where('row', $row)->where('place', $place)->where('hall_id', $timetable->hall_id)->first();
                        if (!isset($table_place))
                           Place::insert([
                               'row' => $row,
                               'place' => $place,
                               'hall_id' => $timetable->hall_id
                           ]);

                       $places[] = Place::where('row', $row)->where('place', $place)->first()->place_id;
                    }
                }
            }
        }
        foreach ($places as $place)
        {
            Booking::insert([
                'user_id' => 2,
                'timetable_id' => $timetable_id,
                'place_id' => $place
            ]);
        }
    }

    static function bookPlace(int $timetable_id)
    {
        $places = array();
        $schema = HallSchema::where('hall_id', 5)->orderBy('row_number')->get();
        $bookings = Booking::where('timetable_id', $timetable_id)->get();
        $places_book = array();
        foreach ($bookings as $booking) {
            $place = Place::where('place_id', $booking->place_id)->first();
            $places_book[]['row'] = $place->row;
            $places_book[count($places_book)-1]['place'] = $place->place;
        }
        foreach ($schema as $row) {
            for ($i = 0; $i < $row->place_number; $i++)
            {
                $isBooked = false;
                foreach($places_book as $place_book)
                {
                    if ($row->row_number == $place_book['row'] && $i+1 == $place_book['place'])
                    {
                        $isBooked = true;
                        break;
                    }
                }
                if ($isBooked)
                    $places[$row->row_number-1][$i] = false;
                else
                    $places[$row->row_number-1][$i] = true;
            }
        }
        return $places;
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Cinema;
use App\Models\Hall;
use App\Models\Movie;
use App\Models\Timetable;
use App\Models\Type;
use Illuminate\Http\Request;

class TimetablesEdit_AdminController extends Controller
{
    public function showTimetable(int $timetable_id)
    {
        $timetable = Timetable::where('timetable_id', $timetable_id)
            ->first();
        $cinemas = Cinema::get();
        $types = Type::get();
        $movies = Movie::get();
        $halls = array();
        foreach($cinemas as $cinema)
            $halls[$cinema->cinema_id] = Hall::where('cinema_id', $cinema->cinema_id)->get();

        $tickets = Booking::join('users', 'users.user_id', '=', 'bookings.user_id')
            ->join('places', 'places.place_id', '=', 'bookings.place_id')
            ->where('timetable_id', $timetable_id)
            ->get();

        return view('admin.timetable_edit',[
            'timetable' => $timetable,
            'cinemas' => $cinemas,
            'types' => $types,
            'movies' => $movies,
            'tickets' => $tickets,
            'halls' => $halls
        ]);
    }

    public function save(Request $request, int $timetable_id)
    {
        Timetable::saveTimetable($request, $timetable_id);
        return redirect(route('admin-timetable-edit', $timetable_id));
    }

    public function delete(int $timetable_id)
    {
        Booking::where('timetable_id', $timetable_id)->delete();
        Timetable::where('timetable_id', $timetable_id)->delete();
        return redirect(route('admin-timetables'));
    }
}

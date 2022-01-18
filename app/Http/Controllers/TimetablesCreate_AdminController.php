<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use App\Models\Hall;
use App\Models\Movie;
use App\Models\Timetable;
use App\Models\Type;
use Illuminate\Http\Request;

class TimetablesCreate_AdminController extends Controller
{
    public function showTimetable()
    {
        $cinemas = Cinema::get();
        $types = Type::get();
        $movies = Movie::get();
        $halls = array();
        foreach($cinemas as $cinema)
            $halls[$cinema->cinema_id] = Hall::where('cinema_id', $cinema->cinema_id)->get();

        return view('admin.timetable_create',[
            'cinemas' => $cinemas,
            'types' => $types,
            'movies' => $movies,
            'halls' => $halls
        ]);
    }
    public function create(Request $request)
    {
        Timetable::createTimetable($request);
        return redirect(route('admin-timetables'));
    }
}

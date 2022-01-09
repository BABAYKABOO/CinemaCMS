<?php

namespace App\Http\Controllers;

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
        $halls = Hall::get();
        return view('admin.timetable_edit',[
            'timetable' => $timetable,
            'cinemas' => $cinemas,
            'types' => $types,
            'movies' => $movies,
            'halls' => $halls
        ]);
    }

    public function save(Request $request, int $timetable_id)
    {
        Timetable::saveTimetable($request, $timetable_id);
        return redirect(route('admin-timetable-edit', $timetable_id));
    }
}

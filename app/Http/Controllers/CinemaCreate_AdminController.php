<?php

namespace App\Http\Controllers;

use App\Models\CinemaCondition;
use App\Models\CinemaHall;
use App\Models\Condition;
use Illuminate\Http\Request;

class CinemaCreate_AdminController extends Controller
{
    private $halls;
    public function showCinema(Request $hall = null )
    {
        if (isset($hall))
            $halls[] = $hall;
        $conditions = Condition::get();

        return view('admin.cinema_create',[
            'conditions' => $conditions
        ]);
    }
    public function addHall(Request $request)
    {
        dd($request);
    }
    public function create(Request $request)
    {
        dd($request);
    }
}

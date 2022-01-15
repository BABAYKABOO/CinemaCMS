<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use App\Models\CinemaCondition;
use App\Models\CinemaHall;
use App\Models\Condition;
use App\Models\Seo;
use Illuminate\Http\Request;

class CinemaCreate_AdminController extends Controller
{
    public function showCinema()
    {
        $conditions = Condition::get();

        return view('admin.cinema_create',[
            'conditions_all' => $conditions
        ]);
    }

    public function create(Request $request)
    {
        $cinema_id = Cinema::createCinema($request, Seo::createSeo($request->Seo));
        CinemaCondition::saveConditions($request, $cinema_id);

        return redirect(route('admin-cinema_id', $cinema_id));
    }
}

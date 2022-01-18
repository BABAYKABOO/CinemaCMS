<?php

namespace App\Http\Controllers;

use App\Models\Hall;
use App\Models\Seo;
use Illuminate\Http\Request;

class HallCreate_AdminController extends Controller
{
    public function showHall(int $cinema_id)
    {
        return view('admin.hall_create', [
            'cinema_id' => $cinema_id
        ]);
    }

    public function create(Request $request, int $cinema_id)
    {
            Hall::createHall($request,
                Seo::createSeo($request->Seo));
        return redirect(stristr(url()->previous(), '/hall_new', true));
    }
}

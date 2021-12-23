<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\PositionBanner;
use Illuminate\Http\Request;

class BannersAdminController extends Controller
{
    public function showPage()
    {
        $position = array();
        for($i = 1; $i <= PositionBanner::max('position_id'); $i++)
        {
            $position[] = Banner::where('position_id', $i)
                ->join('images', 'images.image_id', '=', 'banners.img')
                ->get();
        }//Получение всех баннеров для каждой позиции
        $status = PositionBanner::get();
        return view('admin.banners', [
            'position' => $position,
            'status' => $status
        ]);
    }
    public function save(Request $request, int $id)
    {
        dd($request);
    }
}

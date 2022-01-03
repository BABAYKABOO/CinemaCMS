<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use App\Models\CinemaCondition;
use App\Models\CinemaHall;
use App\Models\Condition;
use App\Models\Gallery;
use App\Models\Image;
use App\Models\Seo;
use App\Models\Type;
use Illuminate\Http\Request;

class CinemaEdit_AdminController extends Controller
{
    public function showCinema(int $cinema_id)
    {
        $cinema = Cinema::where('cinema_id', $cinema_id)
            ->join('images', 'images.image_id', '=', 'cinemas.mainimg')
            ->first();

        $img['logo'] = Image::where('image_id', $cinema->logo)->first()->image_url;
        $img['topbanner'] = Image::where('image_id', $cinema->topbanner)->first()->image_url;
        $img['gallery'] = Gallery::where('gallery_id', $cinema->gallery)
            ->join('images', 'images.image_id', '=', 'galleries.image_id')
            ->get();

        $types = Type::get();

        $conditions_all = Condition::get();
        $conditions_active = CinemaCondition::where('cinema_id', $cinema_id)
            ->join('conditions', 'conditions.condition_id', '=', 'cinema_conditions.condition_id')
            ->get();

        $conditions_inactive = [];
        foreach($conditions_all as $condition)
        {
            $bool = true;
            foreach ($conditions_active as $active_condition)
            {
                if ($condition->condition_id == $active_condition->condition_id)
                {
                    $bool = false;
                    break;
                }
            }
            if ($bool == true)
                $conditions_inactive[] =$condition;
        }

        $halls = CinemaHall::where('cinema_id', $cinema_id)
            ->join('halls', 'halls.hall_id', '=', 'cinema_halls.hall_id')
            ->get();

        $seo = Seo::where('seo_id', $cinema->seo)->first();
        return view('admin.cinema_edit', [
            'cinema' => $cinema,
            'img' => $img,
            'types' => $types,
            'conditions_active' => $conditions_active,
            'conditions_inactive' => $conditions_inactive,
            'halls' => $halls,
            'seo' => $seo
        ]);
    }
    public function save(Request $request, int $cinema_id)
    {
        $cinema = Cinema::where('cinema_id', $cinema_id)->first();
        $seo_id = Seo::where('seo_id', $cinema->seo)->first()->seo_id;
        Seo::saveSeo($request->Seo, $seo_id);
        Cinema::saveCinema($request, $cinema_id);
        CinemaCondition::saveConditions($request, $cinema_id);

        return redirect(route('admin-cinema_id', $cinema_id));
    }

    public function delete(int $cinema_id)
    {
        Cinema::deleteCinema($cinema_id);
        return redirect(route('admin-cinemas'));
    }
}

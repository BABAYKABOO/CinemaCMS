<?php

namespace App\Http\Controllers;

use App\Models\CinemaHall;
use App\Models\Gallery;
use App\Models\Hall;
use App\Models\Image;
use App\Models\Seo;
use Illuminate\Http\Request;

class HallEdit_AdminController extends Controller
{
    public function showHall(int $cinema_id, int $hall_id)
    {
        $hall = Hall::where('hall_id', $hall_id)->first();
        $img['schema'] = Image::where('image_id', $hall->schema)->first()->image_url;
        $img['topbanner'] = Image::where('image_id', $hall->topbanner)->first()->image_url;
        $img['gallery'] = Gallery::where('gallery_id', $hall->gallery)
            ->join('images', 'images.image_id', '=', 'galleries.image_id')
            ->get();
        $seo = Seo::where('seo_id', $hall->seo)->first();
        return view('admin.hall_edit', [
            'cinema_id' => $cinema_id,
            'hall' => $hall,
            'img' => $img,
            'seo' => $seo
        ]);
    }

    public function save(Request $request, int $cinema_id, int $hall_id)
    {
        $hall = Hall::where('hall_id', $hall_id)->first();
        $seo_id = Seo::where('seo_id', $hall->seo)->first()->seo_id;
        Seo::saveSeo($request->Seo, $seo_id);
        Hall::saveHall($request, $hall_id);

        return redirect(route('admin-cinema_id', $cinema_id));
    }

    public function delete(int $cinema_id, int $hall_id)
    {
        Hall::deleteHall($hall_id);
        return redirect(route('admin-cinema_id', $cinema_id));
    }
}

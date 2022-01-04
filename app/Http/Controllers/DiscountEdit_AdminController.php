<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Image;
use App\Models\Seo;
use Illuminate\Http\Request;

class DiscountEdit_AdminController extends Controller
{
    public function showDiscount(int $discount_id)
    {
        $discount = Discount::where('discount_id', $discount_id)
            ->join('images', 'images.image_id', '=', 'discounts.mainimg')
            ->first();

        $topbanner = Image::where('image_id', $discount->topbanner)->first();

        $seo = Seo::where('seo_id', $discount->seo)->first();
        return view('admin.discount_edit', [
            'discount' => $discount,
            'topbanner' => $topbanner,
            'seo' => $seo
        ]);
    }
    public function save(Request $request, int $discount_id)
    {
        $discount = Discount::where('discount_id', $discount_id)->first();
        $seo_id = Seo::where('seo_id', $discount->seo)->first()->seo_id;
        Seo::saveSeo($request->Seo, $seo_id);
        Discount::saveDiscount($request, $discount_id);

        return redirect(route('admin-discount-edit', $discount_id));
    }

    public function delete(int $discount_id)
    {
        Discount::deleteDiscount($discount_id);
        return redirect(route('admin-discounts'));
    }
}

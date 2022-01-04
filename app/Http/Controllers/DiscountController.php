<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Image;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function showDiscount(int $discount_id)
    {
        $discount = Discount::where('discount_id', $discount_id)
            ->join('images', 'images.image_id', '=', 'discounts.mainimg')
            ->first();
        $topbanner = Image::where('image_id', $discount->topbanner)->first();
        return view('discount',[
            'discount' => $discount,
            'topbanner' => $topbanner
        ]);
    }
}

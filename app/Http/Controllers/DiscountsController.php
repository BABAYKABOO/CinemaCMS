<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountsController extends Controller
{
    public function showDiscounts()
    {
        $discounts = Discount::join('images', 'images.image_id', '=', 'discounts.mainimg')
            ->get();

        return view('discounts', [
            'discounts' => $discounts
        ]);
    }
}

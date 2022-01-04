<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;

class Discounts_AdminController extends Controller
{
    public function showDiscounts()
    {
        $discounts = Discount::join('images', 'images.image_id', '=', 'discounts.mainimg')
            ->get();

        return view('admin.discounts', [
            'discounts' => $discounts
        ]);
    }
}

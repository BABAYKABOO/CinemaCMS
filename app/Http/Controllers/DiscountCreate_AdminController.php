<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Seo;
use Illuminate\Http\Request;

class DiscountCreate_AdminController extends Controller
{
    public function showDiscount()
    {
        return view('admin.discount_create');
    }

    public function create(Request $request)
    {
        Discount::createDiscount($request, Seo::createSeo($request->Seo));
        return redirect(route('admin-discounts'));
    }
}

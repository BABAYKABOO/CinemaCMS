<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Discount extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'discount_id';

    protected $fillable = [
        'discount_id',
        'ua/ru',
        'status',
        'name',
        'desc',
        'mainimg',
        'topbanner',
        'seo',

    ];

    public function mainimg()
    {
        return $this->hasOne(Image::class, 'image_id', 'mainimg');
    }
    public function topbanner()
    {
        return $this->hasOne(Image::class, 'image_id', 'topbanner');
    }
    public function seo()
    {
        return $this->hasOne(Seo::class, 'seo_id', 'seo');
    }

    static function createDiscount(Request $request, int $seo_id) : int
    {
        Discount::insert([
            'status' => $request->status == 'on' ? 1 : 0,
            'date' => $request->date,
            'name' => $request->name,
            'desc' => $request->desc,
            'mainimg' => Image::saveImg($request, 'mainimg'),
            'topbanner' => Image::saveImg($request, 'topbanner'),
            'seo' => $seo_id
        ]);

        return Discount::max('discount_id');
    }

    static function saveDiscount(Request $request, int $discount_id)
    {
        $discount = Discount::where('discount_id', $discount_id)->first();
        Discount::where('discount_id', $discount_id)->update([
            'status' => $request->status == 'on' ? 1 : 0,
            'date' => $request->date,
            'name' => $request->name,
            'desc' => $request->desc,
            'mainimg' => Image::saveImg($request, 'mainimg', $discount->mainimg),
            'topbanner' => Image::saveImg($request, 'topbanner', $discount->topbanner)
        ]);
    }

    static function deleteDiscount(int $discount_id)
    {
        $discount = Discount::where('discount_id', $discount_id)->first();

        Discount::where('discount_id', $discount_id)->delete();
        Image::deleteImg($discount->mainimg);
        Image::deleteImg($discount->topbanner);

        Seo::where('seo_id', $discount->seo)->delete();
    }

}

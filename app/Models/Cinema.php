<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cinema extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'cinema_id',
        'name',
        'desc',
        'conditions',
        'logo',
        'topbanner',
        'gallery',
        'seo',
    ];

    public function image()
    {
        return $this->hasOne(Image::class);
    }

    public function gallery()
    {
        return $this->hasOne(Gallery::class);
    }
    public function seo()
    {
        return $this->hasOne(Seo::class);
    }
}

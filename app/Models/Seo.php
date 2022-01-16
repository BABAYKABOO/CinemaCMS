<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'seo_id';

    protected $fillable = [
        'seo_id',
        'seo_url',
        'title',
        'keywords',
        'desc'
    ];

    static function saveSeo(array $arr, int $seo_id)
    {
        Seo::where('seo_id', $seo_id)->update([
                'seo_url' => $arr['url'],
                'title' => $arr['title'],
                'keywords' => $arr['keywords'],
                'desc' => $arr['desc']
            ]);
    }

    static function createSeo(array $arr)
    {
        Seo::insert([
            'seo_url' => $arr['url'],
            'title' => $arr['title'],
            'keywords' => $arr['keywords'],
            'desc' => $arr['desc']
        ]);
        return Seo::max('seo_id');
    }
}

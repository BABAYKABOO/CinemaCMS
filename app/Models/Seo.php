<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'seo_id',
        'seo_url',
        'title',
        'keywords',
        'desc'
    ];

    static function saveSeo(array $arr, int $seo_id)
    {
        Seo::upsert(
            ['seo_id' => $seo_id,
                'seo_url' => $arr['url'],
                'title' => $arr['title'],
                'keywords' => $arr['keywords'],
                'desc' => $arr['desc']
            ], ['seo_id'], ['seo_url', 'title', 'keywords', 'desc']);
    }
}

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

    public function discount()
    {
        return $this->belongsTo(Discount::class, 'seo', 'seo_id');
    }
    public function event()
    {
        return $this->belongsTo(Event::class, 'seo', 'seo_id');
    }
    public function page()
    {
        return $this->belongsTo(Page::class, 'seo', 'seo_id');
    }
    public function pageMain()
    {
        return $this->belongsTo(PageMain::class, 'seo', 'seo_id');
    }
    public function contact()
    {
        return $this->belongsTo(Contact::class, 'seo', 'seo_id');
    }
    public function cinema()
    {
        return $this->belongsTo(Cinema::class, 'seo', 'seo_id');
    }
    public function hall()
    {
        return $this->belongsTo(Hall::class, 'seo', 'seo_id');
    }
    public function movie()
    {
        return $this->belongsTo(Movie::class, 'seo', 'seo_id');
    }

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

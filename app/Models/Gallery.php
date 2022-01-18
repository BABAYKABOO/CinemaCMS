<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'gallery_id';

    protected $fillable = [
        'gallery_id',
        'image_id'
    ];
    public function pageSub()
    {
        return $this->belongsTo(Page::class, 'gallery', 'gallery_id');
    }
    public function page()
    {
        return $this->belongsTo(Page::class, 'sub_gallery', 'gallery_id');
    }
    public function movie()
    {
        return $this->belongsTo(Movie::class, 'gallery', 'gallery_id');
    }
    public function hall()
    {
        return $this->belongsTo(Hall::class, 'gallery', 'gallery_id');
    }
    public function cinema()
    {
        return $this->belongsTo(Cinema::class, 'gallery', 'gallery_id');
    }
}

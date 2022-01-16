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
    public function image()
    {
        return $this->hasOne(Image::class);
    }
}

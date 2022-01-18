<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    protected $primaryKey = 'place_id';

    public $timestamps = false;

    protected $fillable = [
        'place_id',
        'row',
        'place',
        'hall_id'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'place_id', 'place_id');
    }
    public function hall()
    {
        return $this->hasOne(Hall::class, 'hall_id', 'hall_id');
    }
}

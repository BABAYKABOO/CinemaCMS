<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CinemaHall extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'cinema_id',
        'hall_id'
    ];
    public function hall()
    {
        return $this->hasOne(Hall::class);
    }
}

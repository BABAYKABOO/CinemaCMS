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
}

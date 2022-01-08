<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HallSchema extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'hall_schema_id',
        'hall_id',
        'row_number',
        'place_number'
    ];
}

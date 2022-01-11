<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeoplePosition extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'people_id',
        'name',
    ];
}
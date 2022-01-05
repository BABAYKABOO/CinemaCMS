<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'contact_id',
        'name_cinema',
        'address',
        'coordinates',
        'logo'
    ];
}

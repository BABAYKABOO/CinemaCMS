<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    protected $primaryKey = 'visit_id';

    public $timestamps = false;

    protected $fillable = [
        'visit_id',
        'ip',
        'date',
        'is_mobile',
    ];
}

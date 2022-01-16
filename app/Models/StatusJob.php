<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusJob extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'count_queue',
        'count_mails',
        'date'
        ];

}

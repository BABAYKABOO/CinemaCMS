<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CinemaCondition extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'cinema_id',
        'condition_id'
    ];

    public function cinema()
    {
        return $this->hasOne(Cinema::class);
    }

    public function condition()
    {
        return $this->hasOne(Condition::class);
    }
}

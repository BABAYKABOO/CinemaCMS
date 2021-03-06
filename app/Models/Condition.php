<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Condition extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $primaryKey = 'condition_id';

    protected $fillable = [
        'condition_id',
        'condition_name',
        'desc'
    ];
    public function cinemas()
    {
        return $this->belongsToMany(Cinema::class, 'cinema_conditions', 'condition_id', 'cinema_id');
    }
}

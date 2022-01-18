<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PositionBanner extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $primaryKey = 'position_id';

    protected $fillable = [
        'position_id',
        'status',
        'time'
    ];

    public function banner()
    {
        return $this->belongsTo(Banner::class, 'position_id', 'position_id');
    }
}

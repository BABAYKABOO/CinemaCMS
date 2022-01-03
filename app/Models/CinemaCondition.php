<?php

namespace App\Models;

use Illuminate\Http\Request;
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

    static function saveConditions(Request $request, int $cinema_id)
    {
        CinemaCondition::where('cinema_id', $cinema_id)->delete();
        foreach ($request->VERY_IMPORTANT as $condition)
            CinemaCondition::insert([
                'cinema_id' =>  $cinema_id,
                'condition_id' => $condition
            ]);

    }
}

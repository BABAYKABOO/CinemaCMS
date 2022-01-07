<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Timetable extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'timetable_id',
        'data',
        'time',
        'cinema_id',
        'movie_id',
        'hall_id',
        'price'
    ];
    public function cinema()
    {
        return $this->hasOne(Cinema::class);
    }

    public function hall()
    {
        return $this->hasOne(Hall::class);
    }

    public function movie()
    {
        return $this->hasOne(Movie::class);
    }

    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        return $filter->apply($builder);
    }


}

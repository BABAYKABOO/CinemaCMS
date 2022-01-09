<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

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

    static function translateMonth(int $month_id)
    {
        $month = [
            'января',
            'февраля',
            'марта',
            'апреля',
            'мая',
            'июня',
            'июля',
            'августа',
            'сентября',
            'октября',
            'ноября',
            'декабря'
        ];

        return $month[$month_id];
    }

    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        return $filter->apply($builder);
    }

    static function createTimetable(Request $request)
    {
        Timetable::insert([
            'data' => $request->date,
            'time' => $request->time,
            'cinema_id' => $request->cinema_id,
            'movie_id' => $request->movie_id,
            'hall_id' => $request->hall_id,
            'type_id' => $request->type_id,
            'price' => $request->price
        ]);
    }
    static function saveTimetable(Request $request, int $timetable_id)
    {
        Timetable::where('timetable_id', $timetable_id)->update([
            'data' => $request->date,
            'time' => $request->time,
            'cinema_id' => $request->cinema_id,
            'movie_id' => $request->movie_id,
            'hall_id' => $request->hall_id,
            'type_id' => $request->type_id,
            'price' => $request->price
        ]);
    }



}

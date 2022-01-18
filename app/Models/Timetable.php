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

    protected $primaryKey = 'timetable_id';

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
    public function getTimeAttribute($value)
    {
        $data = explode(':',$value);
        return $data[0].':'.$data[1];
    }
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'timetable_id', 'timetable_id');
    }
    public function cinema()
    {
        return $this->hasOne(Cinema::class, 'cinema_id', 'cinema_id');
    }
    public function movie()
    {
        return $this->hasOne(Movie::class, 'movie_id', 'movie_id');
    }
    public function hall()
    {
        return $this->hasOne(Hall::class, 'hall_id', 'hall_id');
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

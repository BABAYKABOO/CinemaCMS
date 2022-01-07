<?php


namespace App\Filters;


class TimetablesFilter extends QueryFilter
{
    public function cinema_id($cinema_id)
    {
        if ($cinema_id == 'all')
            return $this->builder;
        return $this->builder->where('timetables.cinema_id', $cinema_id);
    }
    public function movie_id($movie_id)
    {
        if ($movie_id == 'all')
            return $this->builder;
        return $this->builder->where('timetables.movie_id', $movie_id);
    }
    public function hall_id($hall_id)
    {
        if ($hall_id == 'all')
            return $this->builder;
        return $this->builder->where('timetables.hall_id', $hall_id);
    }
    public function type_id($type_id)
    {
        if ($type_id == 'all')
            return $this->builder;
        return $this->builder->where('timetables.type_id', $type_id);
    }
    public function data($data)
    {
        if ($data == 'all')
            return $this->builder;
        return $this->builder->where('timetables.data', $data);
    }
}

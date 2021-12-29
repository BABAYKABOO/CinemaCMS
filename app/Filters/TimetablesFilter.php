<?php


namespace App\Filters;


class TimetablesFilter extends QueryFilter
{
    public function cinema_id($cinema_id)
    {
        return $this->builder->where('cinema_id', $cinema_id);
    }
}

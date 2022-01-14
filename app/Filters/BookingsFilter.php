<?php


namespace App\Filters;


class BookingsFilter extends QueryFilter
{

    public function book_from_when($date = null)
    {
        if ($date == null)
            return $this->builder;
        return $this->builder->where('bookings.booking_date', '>', $date);
    }

    public function book_to_when($date = null)
    {
        if ($date == null)
            return $this->builder;
        return $this->builder->where('bookings.booking_date', '<', $date);
    }
}

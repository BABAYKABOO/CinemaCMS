<?php


namespace App\Filters;


class UsersFilter extends QueryFilter
{
    public function user_name($user_name = '')
    {
        if ($user_name == '')
            return $this->builder;
        $full_name = explode(' ', $user_name);
        if (isset($full_name[1]))
            return $this->builder->where('users.name', $full_name[0])->where('users.surname', $full_name[1]);
        return $this->builder->where('users.name', $user_name);
    }
}

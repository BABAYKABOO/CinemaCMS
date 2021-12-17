<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Обработка входящего запроса.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function redirectTo($request)
    {
        if (!Auth::guard('admin')->check()) {
            return route('login');
        }
    }
}

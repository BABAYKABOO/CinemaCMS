<?php

namespace App\Http\Middleware;

use App\Models\Visit;
use Closure;
use Illuminate\Http\Request;
use Mobile_Detect;

class CheckVisit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        $visits = Visit::where('date', today())->where('ip', '=', $ip)->get();
        if (count($visits) < 1)
        {
            $detect = new Mobile_Detect;
            if( $detect->isMobile() )
                Visit::insert([
                    'ip' => $ip,
                    'date' => today(),
                    'is_mobile' => 1,
                ]);
            else
                Visit::insert([
                    'ip' => $ip,
                    'date' => today(),
                    'is_mobile' => 0,
                ]);
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;

class TouchPointTypes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $touch_point_types = array(
            '1' => 'Sales office', 
            '2' => 'Service center', 
            '3' => 'Authorized service center', 
            '4' => 'Parts outlet');
        //$request->attributes->add(['touch_points' => $array]);
        $request->merge(compact('touch_point_types'));
        return $next($request);
    }
}

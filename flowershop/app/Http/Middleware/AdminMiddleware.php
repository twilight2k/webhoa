<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check())
        {
            $user=Auth::user();
            if($user->id_levels <= 2)
                return $next($request);
            else
                return redirect('admin/login');
        }
        else
        {
            return redirect('admin/login');
        }
    }
}

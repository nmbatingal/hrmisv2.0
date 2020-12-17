<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use App\User;

class AdminMiddleware
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
        $userCount = User::all()->count();
        $user = Auth::user();
        if (!($userCount == 1)) {
            if (!$user->hasRole('System Administrator')) //If user does //not have this permission
        {
                abort('401');
            }
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Auth;

class CheckUser
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
        // if($request->user != Auth::id()) {
        //     return redirect('/');

        // }
        $user = User::find($request->user);
        if($request->user == Auth::id() && $user->user_type = 'doctor') {
            return $next($request);            
        }
        // if($user->user_type == 'Patient') {
        //     return redirect('/');
        // }
        // dd($user);
        // if($request->user()->hasRole('doctor')) {
        //     return $next($request);
        // }
        // if ($user->user_type == 'Patient') {
        //     return redirect('/');
        // }

        return $next($request);
    }
}

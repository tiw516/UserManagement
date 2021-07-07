<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Admin
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
        // $user = Auth::user();
        // if($user->ifadmin == 0){
        //     abort(403);
        // }
        // return $next($request);
        if(auth()->user()->ifadmin == 1){
            return $next($request);
        }
            return redirect('home')->with('error','You have no admin access');    
    }
}

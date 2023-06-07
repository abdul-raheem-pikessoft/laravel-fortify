<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserPassword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::user()->hasRole('user') && Auth::user()->first_login){
            if($request->route()->getName()  != 'auth.newPassword' && $request->route()->getName() != 'auth.reset.newPassword'){
                return redirect()->guest('/auth/passwords/new_password');
            }
        }
        else {
            if($request->route()->getName()  == 'auth.newPassword' || $request->route()->getName() == 'auth.reset.newPassword'){
                return redirect()->guest('/home');
            }
        }
        return $next($request);
    }
}

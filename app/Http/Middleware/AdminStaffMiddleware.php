<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Helpers\Constant;

class AdminStaffMiddleware
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
        if (auth()->user()->user_type_id == Constant::USER_TYPE['ADMIN'] || auth()->user()->user_type_id == Constant::USER_TYPE['STAFF']) {

            return $next($request);

        } else {
 
            return response()->json("You're not authorized to access.", 401);
            
        }
    }
}

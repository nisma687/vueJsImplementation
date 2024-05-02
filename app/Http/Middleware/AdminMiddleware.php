<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user(); 
        if($user->role != 'admin'){
            return redirect()->route('home')->with('error','You don\'t  have  admin access');
        }
        return $next($request);
    }
}

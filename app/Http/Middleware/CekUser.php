<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CekUser
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
        $id = request()->segment(count(request()->segments()));
        if ($id != auth()->id()) {
            return redirect()->route('main.cart', auth()->id());
        }
        else{
            return $next($request);
        }
    }
}

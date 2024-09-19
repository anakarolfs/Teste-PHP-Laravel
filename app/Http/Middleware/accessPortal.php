<?php

namespace App\Http\Middleware;
use App\Models\Seguranca;
use Closure;

class accessPortal
{
    /**
     * Handle an incoming request.
     * 
     * @param \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        if(!isset($_COOKIE['MATRICULA'])){
            return redirect('/login');
        }else{
            return $next($request);
        }
        
    }
}

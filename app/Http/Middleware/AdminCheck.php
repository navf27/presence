<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminCheck
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
        if(Auth::check()){
            if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SuperAdmin'){
                return $next($request);
            } else{
                return redirect()->route('presence')->with([
                    'nama' => Auth::user()->nama,
                    'divisi' => Auth::user()->divisi->nama_divisi
                ]);
                // return redirect()->route('presenceLog');
            }
        } else{
            return redirect()->route('login');
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class Vertical {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {
        if (!Auth::check()) {
            return redirect()->route('login');
        }if (Auth::user()->role == 1) {
            return redirect()->route('director');
        }if (Auth::user()->role == 2) {
            return redirect()->route('admin');
        }if (Auth::user()->role == 3) {
            return redirect()->route('vertical');
        }if (Auth::user()->role == 4) {
            return redirect()->route('spoc');
        }if (Auth::user()->role == 5) {
            return redirect()->route('team');
        }if (Auth::user()->role == 6) {
            return redirect()->route('vendor');
        }if (Auth::user()->role == 7) {
            return redirect()->route('beneficiary');
        }
        //return $next($request);
    }
}

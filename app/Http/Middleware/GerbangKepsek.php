<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class GerbangKepsek
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
        $cek = Auth::user();
        if(!empty($cek->identitas)) {
            if ($cek->identitas->akses == "kepsek" || $cek->identitas->akses == "superadmin") {
                # code...
                return $next($request);
            }
        }
        return redirect()->back()->with('error', 'Terjadi kesalahan');
    }
}

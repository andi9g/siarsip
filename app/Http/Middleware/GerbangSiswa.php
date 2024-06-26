<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class GerbangSiswa
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
        if(!empty($cek->siswa)) {
            if(empty($cek->siswa->email) || empty($cek->siswa->tempatlahir) || empty($cek->siswa->tanggallahir)){
                return redirect("profil")->with('warning', 'Silahkan Lengkapi Identitas Terlebih Dahulu');
            }
            return $next($request);
        }
        return redirect("home")->with('error', 'Terjadi kesalahan');
    }
}

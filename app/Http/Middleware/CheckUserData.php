<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user->detail_pengguna->nama_pemilih == null || $user->detail_pengguna->kelas_id == null || $user->detail_pengguna->prodi_id == null || $user->detail_pengguna->tahun_ajar_id == null) {
            return redirect()->route('pemilih.complete-data');
        }
        
        return $next($request);
    }
}

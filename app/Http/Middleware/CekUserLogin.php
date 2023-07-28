<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CekUserLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $rules)
    {
        if (!Auth::check()) {
            return redirect('masuk');
        }

        $user = Auth::user();
        if ($user->users_tipe == $rules) {
            return $next($request);
        }
        return redirect('masuk')->with('loginError', 'Kamu Tidak Punya Akses');
    }
}

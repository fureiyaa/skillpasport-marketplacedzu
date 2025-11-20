<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MemberMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || Auth::user()->role !== 'member') {
            return redirect('/login')->with('error', 'Anda harus login sebagai Member.');
        }

        // -----------------------------
        // CEK NOTIFIKASI UNTUK MEMBER
        // -----------------------------
        $user = Auth::user();
        $key = 'notif_member_' . $user->id;

        if (session()->has($key)) {
            session()->flash('notif', session($key));
            session()->forget($key); // Biar notifikasi cuma muncul sekali
        }

        return $next($request);
    }

}

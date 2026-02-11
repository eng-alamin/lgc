<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class StatusMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {

            $status = Auth::user()->account_status;

            // Pending
            if ($status === User::STATUS_PENDING) {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Your account is pending approval.');
            }

            // Deactive
            if ($status === User::STATUS_DEACTIVE) {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Your account is deactivated.');
            }

            // Suspended
            if ($status === User::STATUS_SUSPENDED) {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Your account is suspended.');
            }

            // Banned
            if ($status === User::STATUS_BANNED) {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Your account is banned.');
            }
        }
        return $next($request);
    }
}

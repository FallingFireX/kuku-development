<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Settings;

class CheckMaintenance
{
    public function handle($request, Closure $next)
    {
        if (Settings::get('is_maintenance_mode')) {
            // Allow admins with maintenance_access to bypass
            if (Auth::check() && Auth::user()->hasPower('maintenance_access')) {
                return $next($request);
            }

            // Otherwise, show a dedicated maintenance page with a 503 status
            return response()->view('maintenance', [], 503);
        }

        return $next($request);
    }
}

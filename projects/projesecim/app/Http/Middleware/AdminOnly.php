<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminOnly
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check() || ! (Auth::user()->is_admin ?? false)) {
            abort(403, 'Bu alana erişim yetkiniz yok.');
        }
        return $next($request);
    }
}

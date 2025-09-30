<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!session()->get('role')) {
            return redirect('/login');
        }

        // cek apakah role user termasuk dalam roles yg diizinkan
        if (in_array(session()->get('role'), $roles)) {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}

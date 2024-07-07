<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login.form');
        }

        $user = Auth::user();

        if (!$user->is_verified) {
            return redirect()->route('verify.form');
        }

        foreach ($roles as $role) {
            if ($user->role == $role) {
                return $next($request);
            }
        }

        switch ($user->role) {
            case 1:
                return redirect()->route('comitee.index');
            case 2:
                return redirect()->route('admin.index');
            case 3:
                return redirect()->route('superadmin.index');
            default:
                return redirect()->route('unauthorized'); 
        }
    }
}

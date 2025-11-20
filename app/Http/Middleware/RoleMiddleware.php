<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        
   if (!Auth::check()) {
       return redirect('/login');
    }

   $user = Auth::user();

// Admin can access all roles
   if ($user->role === 'admin') {
       return $next($request);
    }

// Check normal role match
   if ($user->role !== $role) {
       abort(403, 'Unauthorized');
    }

return $next($request);
    }
}

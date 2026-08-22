<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;

class EnsureUserHasRole
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $user = auth()->user();

        abort_unless($user && $user->role, 403);

        abort_unless(
            in_array($user->role->name, $roles, true),
            403,
            'Anda tidak memiliki izin mengakses halaman ini.'
        );

        return $next($request);
    }
}

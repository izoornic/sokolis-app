<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Route;
use App\Models\UserStranicaPrikaz;

class EnsureUserRoleIsAllowedToAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $userRole = auth()->user()->user_tipId;
            $currentRouteName = Route::currentRouteName();

            if (UserStranicaPrikaz::isRoleHasRightToAccess($userRole, $currentRouteName)) {
                return $next($request);
            } else {
                abort(403, 'Unauthorized action 203.');
            }
        } catch (\Throwable $th) {
            abort(403, 'Unauthorized action 204.');
        }
        return $next($request);
    }
}

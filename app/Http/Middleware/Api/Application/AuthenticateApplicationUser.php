<?php

namespace Pterodactyl\Http\Middleware\Api\Application;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class AuthenticateApplicationUser
{
    /**
     * Authenticate that the currently authenticated user is an administrator
     * and should be allowed to proceed through the application API.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /** @var \Pterodactyl\Models\User|null $user */
        $user = $request->user();
        if (!$user || !$user->root_admin) {
            throw new AccessDeniedHttpException('此帐户没有访问 API 的权限.');
        }

        return $next($request);
    }
}

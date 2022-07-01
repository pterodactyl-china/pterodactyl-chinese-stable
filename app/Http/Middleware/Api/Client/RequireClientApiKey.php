<?php

namespace Pterodactyl\Http\Middleware\Api\Client;

use Illuminate\Http\Request;
use Pterodactyl\Models\ApiKey;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class RequireClientApiKey
{
    /**
     * Blocks a request to the Client API endpoints if the user is providing an API token
     * that was created for the application API.
     *
     * @return mixed
     */
    public function handle(Request $request, \Closure $next)
    {
        $token = $request->user()->currentAccessToken();

        if ($token instanceof ApiKey && $token->key_type === ApiKey::TYPE_APPLICATION) {
            throw new AccessDeniedHttpException('您正在尝试在需要客户端 API 密钥的端点上使用应用程序 API 密钥.');
        }

        return $next($request);
    }
}

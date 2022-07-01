<?php

namespace Pterodactyl\Http\Middleware\Admin\Servers;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Pterodactyl\Models\Server;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ServerInstalled
{
    /**
     * Checks that the server is installed before allowing access through the route.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /** @var \Pterodactyl\Models\Server|null $server */
        $server = $request->route()->parameter('server');

        if (!$server instanceof Server) {
            throw new NotFoundHttpException('请求参数中未找到服务器资源.');
        }

        if (!$server->isInstalled()) {
            throw new HttpException(Response::HTTP_FORBIDDEN, '由于当前安装状态，不允许访问此资源.');
        }

        return $next($request);
    }
}

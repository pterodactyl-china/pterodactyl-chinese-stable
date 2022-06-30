<?php

namespace Pterodactyl\Http\Middleware\Api;

use Closure;
use JsonException;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class IsValidJson
{
    /**
     * Throw an exception if the request should be valid JSON data but there is an error while
     * parsing the data. This avoids confusing validation errors where every field is flagged and
     * it is not immediately clear that there is an issue with the JSON being passed.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->isJson() && !empty($request->getContent())) {
            try {
                json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
            } catch (JsonException $exception) {
                throw new BadRequestHttpException('请求中传递的 JSON 数据似乎格式不正确: ' . $exception->getMessage());
            }
        }

        return $next($request);
    }
}

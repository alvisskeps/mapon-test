<?php

declare(strict_types=1);

namespace App;

use App\Exceptions\RouteNotFoundException;

class BaseApp
{
    private Router $router;
    private array $requestInfo;

    public function __construct(Router $router, array $requestInfo)
    {
        $this->router = $router;
        $this->requestInfo = $requestInfo;
    }

    public function run()
    {
        $uri = $this->requestInfo['uri'] ?? '';
        $method = strtolower($this->requestInfo['method'] ?? '');

        try {
            echo $this->router->resolve($uri, $method);
        } catch (RouteNotFoundException) {
            http_response_code(404);

            echo View::make('error/404');
        }
    }
}
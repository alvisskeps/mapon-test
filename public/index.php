<?php

use App\BaseApp;
use App\Session;
use Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$session = Session::getInstance();

const VIEW_PATH = __DIR__ . '/../views';

$router = new App\Router();

$router
    ->get('/', [App\Controllers\HomeController::class, 'index'])
    ->get('/login', [\App\Controllers\UserController::class, 'index'])
    ->post('/login', [\App\Controllers\UserController::class, 'login'])
    ->post('/logout', [\App\Controllers\UserController::class, 'logout']);

(new BaseApp(
    $router,
    ['uri' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']],
))->run();
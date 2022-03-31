<?php

use App\BaseApp;
use App\Models\User;
use App\Session;
use Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$session = Session::getInstance();

const VIEW_PATH = __DIR__ . '/../views';

$router = new App\Router();
$user = new User();

$userExists = $user->getUser($_ENV['USER_EMAIL'], $_ENV['USER_PASSWORD']);

if (!$userExists) {
    $user->createUser($_ENV['USER_EMAIL'], $_ENV['USER_FULL_NAME'], $_ENV['USER_PASSWORD']);
}

$router
    ->get('/', [App\Controllers\HomeController::class, 'index'])
    ->get('/login', [\App\Controllers\UserController::class, 'index'])
    ->post('/login', [\App\Controllers\UserController::class, 'login'])
    ->post('/logout', [\App\Controllers\UserController::class, 'logout'])
    ->get('/routes', [\App\Controllers\RouteController::class, 'index'])
    ->post('/routes', [\App\Controllers\RouteController::class, 'routes']);

(new BaseApp(
    $router,
    ['uri' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']],
))->run();
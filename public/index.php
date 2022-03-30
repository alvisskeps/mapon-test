<?php

use App\BaseApp;
use Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

session_start();

const VIEW_PATH = __DIR__ . '/../views';

$router = new App\Router();

$router
    ->get('/', [App\Controllers\HomeController::class, 'index']);

(new BaseApp(
    $router,
    ['uri' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']],
))->run();
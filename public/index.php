<?php

declare(strict_types=1);

require_once '../vendor/autoload.php';
// use Exception;
use Controllers\HikeController;
use Controllers\UserController;
// use AltoRouter;

ini_set('display_errors', 1);
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();

$router = new AltoRouter();

$router->setBasePath('/19-php-hiking-project-celine-louis');

$hikeController = new HikeController();

$router->map('GET', '/', function () use ($hikeController) {
    $hikeController->listHikes();
});

// filter route
$router->map('POST', '/filter', function () use ($hikeController) {
    $hikeController->filterHikes();
}, 'filter');

$router->map('GET', '/register', function () {
    require('../src/views/register.php');
});

$router->map('GET', '/login', function () {
    require('../src/views/login.php');
});

$router->map('GET', '/hike/[:id]', function ($id) use ($hikeController) {
    $hikeController->infoHike($id);
});

$match = $router->match();

if (is_array($match) && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    echo '<div class="container">
    <div class="text_title">Error 404</div>
    <div class="text_desc">Page not found.</div>';
}

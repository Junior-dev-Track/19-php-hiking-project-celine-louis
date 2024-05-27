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

$router->map('GET', '/', function () {
    $hikeController = new HikeController();
    $hikeController->listHikes();
});

// add User
$router->map('GET', '/register', function () {
    require('../src/views/register.php');
});

$router->map('POST', '/register', function() {
    $userController = (new UserController())->register();
    unset($_SESSION['message']);
});

// login User
$router->map('GET', '/login', function () {
    require('../src/views/login.php');
});

$router->map('POST', '/login', function() {
    $userController = (new UserController())->login();
});

// logout user 
$router->map('GET', '/logout', function () {
    $userController = (new UserController())->logout();
});

// user profile
$router->map('GET', '/profile', function () {
    require('../src/views/userProfile.php');
    unset($_SESSION['message']);
});

// TODO in one function ?
// modif firstname
$router->map('POST', '/profile/update-firstname', function () {
    $userController = (new UserController())->editFirstName();
    require('../src/views/userProfile.php');
});

$router->map('POST', '/profile/update-lastname', function () {
    $userController = (new UserController())->editLastName();
    require('../src/views/userProfile.php');
});

$router->map('POST', '/profile/update-email', function () {
    $userController = (new UserController())->editEmail();
    require('../src/views/userProfile.php');
});

$router->map('POST', '/profile/update-password', function () {
    $userController = (new UserController())->editPassword();
    require('../src/views/userProfile.php');
});

// details hike
$router->map('GET', '/hike/[:id]', function ($id) {
    $hikeController = new HikeController();
    $hikeController->infoHike($id);
});

//Route matching
$match = $router->match();

if (is_array($match) && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    echo '<div class="container">
            <div class="text_title">Error 404</div>
            <div class="text_desc">Page not found.</div>
          </div>';
}

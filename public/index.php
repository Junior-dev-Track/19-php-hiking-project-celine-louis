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

define('BASE_PATH', '/19-php-hiking-project-celine-louis'); 
$router = new AltoRouter();

$router->setBasePath('/19-php-hiking-project-celine-louis');

$hikeController = new HikeController();
$userController = new UserController();

$router->map('GET', '/', function () use ($hikeController) {
    $hikeController->homepage();
});

// filter route
$router->map('POST', '/filter', function () use ($hikeController) {
    $hikeController->filterHikes();
});

// add User
$router->map('GET', '/register', function () {
    require('../src/views/register.php');
});

$router->map('POST', '/register', function () use ($userController) {
    $userController->register();
    unset($_SESSION['message']);
});

// login User
$router->map('GET', '/login', function () {
    require('../src/views/login.php');
});

$router->map('POST', '/login', function () use ($userController) {
    $userController->login();
});

// logout user 
$router->map('GET', '/logout', function () use ($userController) {
    $userController->logout();
});

// user profile
$router->map('GET', '/profile', function () {
    $hikeByUser = (new HikeController())->listHikesByUser();
    unset($_SESSION['message']);
});

$router->map('GET', '/profile/editProfile', function () {
    require('../src/views/editProfile.php');
});

$router->map('POST', '/profile/editProfile', function () use ($userController) {
    $userController->editProfile();
    require('../src/views/userProfile.php');
});

$router->map('POST', '/profile/update-password', function () use ($userController) {
    $userController->editPassword();
    require('../src/views/userProfile.php');
});

$router->map('POST', '/profile/delete-account', function () use ($userController) {
    $userController->deleteAccount();
});

// details hike
$router->map('GET', '/hike/[:id]', function ($id) use ($hikeController) {
    $hikeController->infoHike($id);
});

// Add a hike
$router->map('GET', '/addHike', function () use ($hikeController) {
    $hikeController->tagsAddHike();
    // require('../src/views/addHike.php');
});

$router->map('POST', '/addHike', function () use ($hikeController) {
    $hikeController->addHike();
    header('Location: /19-php-hiking-project-celine-louis/profile');
});
// edit form
$router->map('GET', '/edit-hike/[:id]', function ($id) use ($hikeController) {
    $hikeController->editInfoHikeForm($id);
});

$router->map('POST', '/edit-hike/[:id]', function ($id) use ($hikeController) {
    $hikeController->editInfoHike($id);
});

$router->map('GET', '/deleteHike/[:id]', function ($id) use ($hikeController) {
    $hikeController->deleteHike($id);
});


// Admin

$router->map('GET', '/admin', function () use ($userController) {
    $users = $userController->listUser();
    // require('../src/views/admin.php');
});




//Route matching
$match = $router->match();

if (is_array($match) && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    echo '<div class="container">
    <div class="text_title">Error 404</div>
    <div class="text_desc">Page not found.</div>';
}
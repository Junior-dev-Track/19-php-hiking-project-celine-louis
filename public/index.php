<?php

declare(strict_types=1);

require_once '../src/vendor/autoload.php';
// use Exception;
use Controllers\HikeController;
use Controllers\UserController;

ini_set('display_errors', 1);
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();

try {
    if (isset($_GET['action']) && $_GET['action'] !== '') {
        switch ($_GET['action']) {
            default:
                throw new Exception("The page doesn't exist.");
        }
    } else {
        $hikeController = (new HikeController())->listHikes();
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();
    require('src/views/error.php');
}

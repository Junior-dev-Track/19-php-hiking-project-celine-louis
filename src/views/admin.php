<?php $title = "Hike project - Admin"; ?>

<?php ob_start(); ?>

<?php ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<main>
    <h1>Admin pannel</h1>

    <section class="listUser">
        <h2>Manage users</h2>
        <ul>
            
        </ul>
    </section>
</main>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>
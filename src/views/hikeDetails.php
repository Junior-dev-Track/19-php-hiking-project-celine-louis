<?php $title = "Hike project"; ?>

<?php ob_start(); ?>

<?php ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<main>
    <section class="p-2 mb-2">
        <h1><?php echo htmlspecialchars($hike->name); ?></h1>
        <h2>Overview</h2>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>&#129406; Distance : </strong> <?php echo htmlspecialchars($hike->distance); ?> km</li>
            <li class="list-group-item"><strong>&#128337; Duration : </strong> <?php echo htmlspecialchars($hike->duration); ?> hours</li>
            <li class="list-group-item"><strong>&#128200; Elevation Gain : </strong> <?php echo htmlspecialchars($hike->elevationGain); ?> meters</li>
        </ul>
    </section>
    <section class="p-2 mb-2">
        <h2>Description</h2>
        <p><?php echo (htmlspecialchars($hike->description)); ?></p>
    </section>

    <section class="p-2 mb-2">
        <h2>Info</h2>
        <ul class="list-group list-group-flush">
            <?php if (!isset($hike->updatedAt)) : ?>
                <li class="list-group-item "><strong>&#x231A; Added at : </strong> <?php echo (htmlspecialchars($hike->createdAt)); ?></li>
            <?php else : ?>
                <li class="list-group-item"><strong>&#9203; Last edited : </strong><?php echo (htmlspecialchars($hike->updatedAt)); ?></li>
            <?php endif ?>
            <?php if (isset($creator) && $creator != null) : ?>
                <li class="list-group-item"><strong>&#128100; Created by : </strong> <?php echo (htmlspecialchars($creator['firstname'])); ?> <?php echo (htmlspecialchars($creator['lastname'])); ?></li>
            <?php endif ?>

            <li class="list-group-item"><strong>&#128278; Tag : </strong><?php echo (htmlspecialchars($tags['tag'])); ?>
            </li>
        </ul>
    </section>


</main>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>
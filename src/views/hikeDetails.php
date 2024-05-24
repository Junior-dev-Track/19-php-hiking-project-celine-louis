<?php $title = "Hike project"; ?>

<?php ob_start(); ?>

<main>
    <p>coucou</p>
    <!-- <h1><?= htmlspecialchars($hike->name); ?></h1>
    <p>Distance: <?= htmlspecialchars($hike->distance); ?> km</p>
    <p>Duration: <?= htmlspecialchars($hike->duration); ?> hours</p>
    <p>Elevation Gain: <?= htmlspecialchars($hike->elevationGain); ?> meters</p>
    <p>Description: <?= htmlspecialchars($hike->description); ?></p>
    <p>Created At: <?= htmlspecialchars($hike->createdAt); ?></p>
    <p>Updated At: <?= htmlspecialchars($hike->updatedAt); ?></p> -->

</main>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>
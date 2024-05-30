<?php $title = "Hike project"; ?>

<?php ob_start(); ?>

<?php ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<main>
    <section>
        <h1><?php echo htmlspecialchars($hike->name); ?></h1>
        <h2>Overview</h2>
        <ul>
            <li><strong>Distance:</strong> <?php echo htmlspecialchars($hike->distance); ?> km</li>
            <li><strong>Duration:</strong> <?php echo htmlspecialchars($hike->duration); ?> hours</li>
            <li><strong>Elevation Gain:</strong> <?php echo htmlspecialchars($hike->elevationGain); ?> meters</li>
        </ul>
    </section>
    <section>
        <h2>Description</h2>
        <p><?php echo (htmlspecialchars($hike->description)); ?></p>
    </section>

    <section>
        <h2>Info</h2>
        <?php if (!isset($hike->updatedAt)) : ?>
            <p>Added at <?php echo (htmlspecialchars($hike->createdAt)); ?></p>
        <?php else : ?>
            <p>Last edited: <?php echo (htmlspecialchars($hike->updatedAt)); ?></p>
        <?php endif ?>
        <?php if (isset($creator) && $creator != null) : ?>
            <p>Created by <?php echo (htmlspecialchars($creator['firstname'])); ?> <?php echo (htmlspecialchars($creator['lastname'])); ?></p>
        <?php endif ?>

        <?php if (isset($tags) && $tags['tag'] != null) : ?>
            <p><?php echo (htmlspecialchars($tags['tag'])); ?></p>
        <?php endif ?>
    </section>


</main>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>
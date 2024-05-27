<?php $title = "Hike project"; ?>

<?php ob_start(); ?>

<main>
    <p>coucou</p>
    <h1><?php echo htmlspecialchars($hike->name); ?></h1>
    <section>
        <h2>Overview</h2>
        <ul>
            <li><strong>Distance:</strong> <?php echo htmlspecialchars($hike->distance); ?> km</li>
            <li><strong>Duration:</strong> <?php echo htmlspecialchars($hike->duration); ?> hours</li>
            <li><strong>Elevation Gain:</strong> <?php echo htmlspecialchars($hike->elevationGain); ?> meters</li>
        </ul>
    </section>
    <section>
        <h2>Description</h2>
        <p><?php echo nl2br(htmlspecialchars($hike->description)); ?></p>
    </section>


</main>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>
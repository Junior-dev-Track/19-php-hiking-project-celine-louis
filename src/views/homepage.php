<?php $title = "Hike project"; ?>

<?php ob_start(); ?>
<main>
    <h1>Hike project</h1>

    <?php
    foreach ($hikes as $hike) : ?>
        <div>
            <h3>
                <a href="/19-php-hiking-project-celine-louis/hike/<?= urlencode($hike['id']) ?>">
                    <?= htmlspecialchars($hike['name']); ?>
                </a>
            </h3>
        </div>
    <?php
    endforeach
    ?>
</main>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>
<?php $title = "Hike project"; ?>

<?php ob_start(); ?>
<main>
    <h1>Hike project</h1>

    <?php
    foreach ($hikes as $hike) : ?>
        <div>
            <h3>

                <!-- TODO: add ?id in href -->
                <a href="index.php?action=hike&id=<?= urlencode($hike['id']) ?>">
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
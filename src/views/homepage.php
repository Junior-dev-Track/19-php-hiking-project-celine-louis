<?php
$title = "Hike project";
?>

<?php ob_start(); ?>
<main>
    <h1>Hike project</h1>

    <form action="/19-php-hiking-project-celine-louis/filter" method="post">
        <select name="filter_tag">
            <option value="">All Categories</option>
            <option value="mountain">Mountain</option>
            <option value="full nature">Full Nature</option>
            <option value="countryside">Countryside</option>
        </select>
        <button type="submit">Filter</button>
    </form>

    <?php if (!empty($hikes)) : ?>
        <?php foreach ($hikes as $hike) : ?>
            <div>
                <h3>
                    <a href="/19-php-hiking-project-celine-louis/hike/<?= urlencode($hike['id']) ?>">
                        <?= htmlspecialchars($hike['name']) ?>
                    </a>
                </h3>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>No hikes found.</p>
    <?php endif; ?>
</main>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>
<?php
$title = "Hike project";
?>

<?php ob_start(); ?>
<main class="w-100">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1>Hike Project</h1>
            </div>
            <div class="col-md-6">
                <form action="/19-php-hiking-project-celine-louis/filter" method="post">
                    <div class="d-flex justify-content-end">
                        <select class="form-select me-2" aria-label="Default select example" name="filter_tag">
                            <option selected value="">All Categories</option>
                            <option value="mountain">Mountain</option>
                            <option value="full nature">Full Nature</option>
                            <option value="countryside">Countryside</option>
                        </select>
                        <button class="btn btn-primary ms-2" type="submit">Filter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




    <div class="container mt-5">
        <div class="row justify-content-center align-items-center g-5">
            <?php if (!empty($hikes)) : ?>
                <?php foreach ($hikes as $hike) : ?>
                    <div class="col-md-4">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body w-100 d-flex flex-column align-items-center">
                                <h5 class="card-title">
                                    <?= htmlspecialchars($hike['name']) ?>
                                </h5>
                                <div class="d-flex flex-row gap-3 align-items-center justify-content-center p-2">
                                    <p>&#129406;<?= htmlspecialchars($hike['distance']) ?>km</p>
                                    <p>&#128337;<?= htmlspecialchars($hike['duration']) ?>h</p>
                                    <p>&#128200;<?= htmlspecialchars($hike['elevation_gain']) ?>m</p>
                                </div>
                                <a class="btn btn-primary w-50" href="/19-php-hiking-project-celine-louis/hike/<?= urlencode($hike['id']) ?>">Details</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No hikes found.</p>
            <?php endif; ?>
</main>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>
<?php
$title = "Hike project";
?>

<style>

</style>
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
                            <option value="">All Categories</option>
                            <?php foreach ($tags as $tag) : ?>
                                <option value='<?php echo htmlspecialchars($tag) ?>'><?php echo htmlspecialchars($tag) ?></option>
                            <?php endforeach ?>
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
                            <img src="https://images.pexels.com/photos/551851/pexels-photo-551851.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" class="card-img-top" alt="Mountain landscape">
                            <div class="card-body w-100 d-flex flex-column align-items-center">
                                <h5 class="card-title d-flex flex-row align-items-center gap-2">
                                    <?= htmlspecialchars($hike['name']) ?>
                                    <?php if (isset($hike['id_user'], $_SESSION['user']) && $hike['id_user'] == $_SESSION['user']['id'] || isset($_SESSION['user']) && $_SESSION['user']['isAdmin'] == 1) : ?>
                                        <a class="icon-link" href="/19-php-hiking-project-celine-louis/edit-hike/<?= urlencode($hike['id']) ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                            </svg>
                                        </a>
                                    <?php endif; ?>

                                </h5> 
                                <div class="d-flex flex-row gap-3 align-items-center justify-content-center pt-3">
                                    <p>&#129406;<?= htmlspecialchars($hike['distance']) ?>km</p>
                                    <p>&#128337;<?= htmlspecialchars($hike['duration']) ?>h</p>
                                    <p>&#128200;<?= htmlspecialchars($hike['elevation_gain']) ?>m</p>
                                </div>
                                <?php if (isset($tagsHikes)) : ?>
                                    <?php foreach ($tagsHikes as $tags) : ?>
                                        <?php if ($tags['id_hike'] == $hike['id']) : ?>
                                            <p class="pb-3">&#128278;<?= htmlspecialchars($tags['tag']) ?></p>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                <?php endif; ?>

                                <div class="d-flex flex-row align-items-center">
                                    <a class="btn btn-primary " href="/19-php-hiking-project-celine-louis/hike/<?= urlencode($hike['id']) ?>">Details</a>
                                </div>
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
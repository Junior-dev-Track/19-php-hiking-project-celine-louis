<?php $title = "Hike project - Edit hike"; ?>

<?php ob_start(); ?>

<?php ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<main>
    <h1><?php echo htmlspecialchars($hikesByUser->name); ?></h1>

    <?php if (isset($_SESSION['message'])) : ?>
        <div class="alert alert-info">
            <?= htmlspecialchars($_SESSION['message']) ?>
        </div>
    <?php endif; ?>

    <!-- <form action="edit-hike/<?= urlencode($id) ?>" method="post" class="edit-hike"> -->
    <form action="<?php echo BASE_PATH; ?>/edit-hike/<?= urlencode($id) ?>" method="post" class="edit-hike">
        <label for="name">Name of the hike: </label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($hikesByUser->name); ?>"><br>

        <label for="distance">Distance: </label>
        <input type="number" name="distance" value="<?php echo htmlspecialchars($hikesByUser->distance); ?>"><br>

        <label for="duration">Duration: </label>
        <input type="number" name="duration" value="<?php echo htmlspecialchars($hikesByUser->duration); ?>"><br>

        <label for="elevationGain">Elevation gain: </label>
        <input type="number" name="elevationGain" value="<?php echo htmlspecialchars($hikesByUser->elevationGain); ?>"><br>

        <label for="description">Description: </label>
        <textarea name="description" rows="7" cols="50"><?php echo htmlspecialchars($hikesByUser->description); ?></textarea><br>

        <!-- TODO -->
        <!-- <label for="tag">Tags: </label>
        <textarea name="tag" value="<?php echo htmlspecialchars($hikesByUser->description); ?>"><br> -->

        <input type="submit" value="Valid edited hike">
    </form>
    <!-- TODO -->
    <a href="">Delete hike</a>
</main>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>
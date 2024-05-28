<?php
$title = "Hike project - Add a hike";
?>

<?php ob_start(); ?>

<main>
    <h2>Add a hike</h2>
    <form id="addHikeForm" action="" method="post">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" placeholder="Name"><br>
        <label for="distance">Distance</label>
        <input type="text" id="distance" name="distance" placeholder="Distance in km"><br>
        <label for="duration">Duration</label>
        <input type="text" id="duration" name="duration" placeholder="Duration in hours"><br>
        <label for="elevationGain">Elevation Gain</label>
        <input type="text" id="elevationGain" name="elevationGain" placeholder="Elevation gain"><br>
        <label for="tags">Tags</label>
        <select name="tags" id="tags">
            <option value="Mountain">Mountain</option>
            <option value="Countryside">Countryside</option>
            <option value="Full nature">Full nature</option>
        </select><br>
        <label for="description">Description</label>
        <input type="text" id="description" name="description" placeholder="Description"><br>
        <button class="btn" type="submit">Add</button>

    </form>
</main>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>
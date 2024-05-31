<?php $title = "Hike project - Edit hike"; ?>

<?php ob_start(); ?>

<?php ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<main class="d-flex flex-column align-items-center w-100 gap-1 mb-3">
    <h1 class="p-2"><?php echo htmlspecialchars($hikesByUser->name); ?></h1>

    <?php if (isset($_SESSION['message'])) : ?>
        <div class="alert alert-info">
            <?= htmlspecialchars($_SESSION['message']) ?>
        </div>
    <?php endif; ?>

    <form action="<?php echo BASE_PATH; ?>/edit-hike/<?= urlencode($id) ?>" method="post" class="edit-hike w-50">
        <div class="input-group mb-3">
            <span class="input-group-text">&#128100;</span>
            <div class="form-floating">
                <input type="text" class="form-control" id="floatingInputGroup1" name="name" value="<?php echo htmlspecialchars($hikesByUser->name); ?>">
                <label for="name">Name of the hike: </label>

            </div>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">&#129406;</span>
            <div class="form-floating">
                <input type="number" class="form-control" id="floatingInputGroup1" name="distance" value="<?php echo htmlspecialchars($hikesByUser->distance); ?>">
                <label for="floatingInputGroup1" class="form-label">Distance: </label>

            </div>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">&#128337;</span>
            <div class="form-floating">
                <input type="number" class="form-control" id="floatingInputGroup1" name="duration" value="<?php echo htmlspecialchars($hikesByUser->duration); ?>">
                <label for="floatingInputGroup1" class="form-label">Duration: </label>

            </div>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">&#128200;</span>
            <div class="form-floating">
                <input type="number" class="form-control" id="floatingInputGroup1" name="elevationGain" value="<?php echo htmlspecialchars($hikesByUser->elevationGain); ?>">
                <label for="floatingInputGroup1" class="form-label">Elevation gain: </label>

            </div>
        </div>

        <?php foreach ($tagsOfHike as $index => $tagOfHike) : ?>
            <div class="input-group mb-3 mt-3">
                <span class="input-group-text">&#128507;</span>
                <!-- Append the index to the name attribute to make it unique -->
                <select name="tags[<?= $index; ?>]" id="inputGroupSelect03" class="form-select" aria-label="Example select with button addon">
                    <option value="">All Categories</option>
                    <?php foreach ($tags as $tag) : ?>
                        <?php if ($tag == $tagOfHike['tag']) : ?>
                            <option value='<?php echo htmlspecialchars($tag . "," . $tagOfHike['id_tag']) ?>' selected><?php echo htmlspecialchars($tag) ?></option>
                        <?php else : ?>
                            <option value='<?php echo htmlspecialchars($tag . "," . $tagOfHike['id_tag']) ?>'><?php echo htmlspecialchars($tag) ?></option>
                        <?php endif ?>
                    <?php endforeach ?>
                </select>
            </div>
        <?php endforeach ?>

        <div class="input-group mb-3">
            <span class="input-group-text">&#128278;</span>
            <div class="form-floating">
                <input type="text" class="form-control" id="floatingInputGroup5" name="newTag" placeholder="Add a new tag">
                <label for="floatingInputGroup5" class="form-label">New category</label>
            </div>
        </div>

        <!-- Other tags -->
        <button type="button" id="addTagButton" onclick="addTagField()">Add New Tag</button>
        <div id="dynamicTagsContainer"></div>

        <div class="input-group">
            <span class="input-group-text">&#128221;</span>
            <textarea name="description" class="form-control" aria-label="With textarea"><?php echo htmlspecialchars($hikesByUser->description); ?></textarea>
        </div>

        <div class="d-flex flex-row align-items-center justify-content-center gap-3 mt-2">
            <div class="d-flex justify-content-center mt-3">
                <input class="btn btn-primary" type="submit" value="Valid edited hike">
            </div>
            <div class="d-flex justify-content-center mt-3">
                <a class="btn btn-danger" href="/19-php-hiking-project-celine-louis/deleteHike/<?= urlencode($id) ?>">Delete hike</a>
            </div>
        </div>
    </form>

    <script>
        function addTagField() {
            const container = document.getElementById('dynamicTagsContainer');

            const newDiv = document.createElement('div');
            newDiv.className = "input-group mb-3";
            container.appendChild(newDiv);

            const newSpan = document.createElement('span');
            newSpan.className = "input-group-text";
            newSpan.textContent = '🔖';
            newDiv.appendChild(newSpan);


            const newTagField = document.createElement('input');
            newTagField.type = 'text';
            newTagField.className = 'form-control';
            newTagField.id = "floatingInputGroup5";
            newTagField.name = 'tags[]';
            newTagField.placeholder = 'New category';

            newDiv.appendChild(newTagField);
        }
    </script>

</main>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>
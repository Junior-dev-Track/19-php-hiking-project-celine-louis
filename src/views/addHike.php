<?php
$title = "Hike project - Add a hike";
?>

<?php ob_start(); ?>

<main class="d-flex flex-column align-items-center w-100 gap-1 mb-3">
    <h2 class="p-2">Add a hike</h2>
    <form id="addHikeForm" action="" method="post" class="w-50">
        <div class="input-group mb-3">
            <span class="input-group-text">&#128100;</span>
            <div class="form-floating">
                <input type="text" class="form-control" id="floatingInputGroup1" name="name" placeholder="Name">
                <label for="floatingInputGroup1" class="form-label">Name</label>
            </div>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">&#129406;</span>
            <div class="form-floating">
                <input type="text" class="form-control" id="floatingInputGroup2" name="distance" placeholder="Distance in km">
                <label for="floatingInputGroup2" class="form-label">Distance</label>
            </div>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">&#128337;</span>
            <div class="form-floating">
                <input type="text" class="form-control" id="floatingInputGroup3 " name="duration" placeholder="Duration in hours">
                <label for="floatingInputGroup3" class="form-label">Duration</label>
            </div>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">&#128200;</span>
            <div class="form-floating">
                <input type="text" class="form-control" id="floatingInputGroup4" name="elevationGain" placeholder="Elevation gain">
                <label for="floatingInputGroup4" class="form-label">Elevation Gain</label>
            </div>
        </div>
        <div class="input-group mb-3 mt-3">
            <span class="input-group-text">&#128507;</span>
            <select name="tags" id="inputGroupSelect03" class="form-select" aria-label="Example select with button addon">
                <option value="">All Categories</option>
                <?php foreach ($tags as $tag) : ?>
                    <option value='<?php echo htmlspecialchars($tag) ?>'><?php echo htmlspecialchars($tag) ?></option>
                <?php endforeach ?>
            </select>
        </div>
        
        <div class="input-group mb-3">
            <span class="input-group-text">&#128278;</span>
            <div class="form-floating">
                <input type="text" class="form-control" id="floatingInputGroup5" name="tags[]" placeholder="Add a new tag">
                <label for="floatingInputGroup5" class="form-label">New category</label>
            </div>
        </div>

        <!-- Other tags -->
        <button type="button" id="addTagButton" onclick="addTagField()">Add New Tag</button>
        <div id="dynamicTagsContainer"></div>

        <div class="input-group">
            <span class="input-group-text">&#128221;</span>
            <textarea class="form-control" aria-label="With textarea" name="description"></textarea>
        </div>
        <div class="d-flex justify-content-center mt-3">
            <button class="btn btn-primary" type="submit">Add a hike</button>
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

    <?php $content = ob_get_clean(); ?>

    <?php require('layout.php'); ?>
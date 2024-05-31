<?php $title = "Hike project - Login"; ?>

<?php ob_start(); ?>

<style>
    .message {
        color: #D8000C;
        width: 100%;
        height: 30px;
        text-align: center;
    }
</style>

<main class="d-flex flex-column align-items-center w-100 gap-1 mb-3">
    <h2 class="p-2">LOGIN</h2>
    <?php
    if (isset($_SESSION['message'])) {
        echo '<p class="message">&#9940;' . $_SESSION['message'] . '&#9940;</p>';
        unset($_SESSION['message']);
    }
    ?>
    <form id="loginForm" action="" method="post" class="w-50">
        <div class="input-group mb-3">
            <span class="input-group-text">&#128100;</span>
            <div class="form-floating">
                <input type="text" class="form-control" id="floatingInputGroup1" name="emailNickname" placeholder="Nickname or email">
                <label for="floatingInputGroup1" class="form-label">Nickname or email</label>
            </div>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">&#128274;</span>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingInputGroup2" name="password" placeholder="Password">
                <label for="floatingInputGroup2" class="form-label">Password</label>
            </div>
        </div>
        <button class="btn btn-primary w-100" type="submit">Login</button>
    </form>
</main>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>
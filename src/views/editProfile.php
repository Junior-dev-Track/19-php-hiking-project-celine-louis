<?php $title = "Hike project - Edit hike"; ?>

<?php ob_start(); ?>

<?php ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<style>
    .message {
        color: #D8000C;
        width: 100%;
        height: 30px;
        text-align: center;
    }
</style>

<main class="d-flex flex-column align-items-center w-100 gap-1">
    <h2 class="p-2">Edit your profile</h1>
        <?php
        if (isset($_SESSION['message'])) {
            echo '<p class="message">&#9940;' . $_SESSION['message'] . '&#9940;</p>';
            unset($_SESSION['message']);
        }
        ?>

        <form action="<?php echo BASE_PATH; ?>/profile/editProfile" method="post" class="w-50">
            <div class="input-group mb-3">
                <span class="input-group-text">&#128100;</span>
                <div class="form-floating">
                    <input class="form-control" id="floatingInputGroup1" type="text" name="firstname" value="<?php echo htmlspecialchars($_SESSION['user']['firstname']); ?>">
                    <label for="floatingInputGroup2" class="form-label">Firstname: </label>

                </div>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">&#128100;</span>
                <div class="form-floating">
                    <input class="form-control" id="floatingInputGroup1" type="text" name="lastname" value="<?php echo htmlspecialchars($_SESSION['user']['lastname']); ?>">
                    <label for="floatingInputGroup2" class="form-label">Lastname: </label>

                </div>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">&#128231;</span>
                <div class="form-floating">
                    <input class="form-control" id="floatingInputGroup1" type="email" name="email" value="<?php echo htmlspecialchars($_SESSION['user']['email']); ?>">
                    <label for="floatingInputGroup2" class="form-label">Email: </label>

                </div>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">&#128274;</span>
                <div class="form-floating">
                    <input class="form-control" id="floatingInputGroup1" type="password" id="password" name="password" placeholder="Password">
                    <label for="floatingInputGroup2" class="form-label">Enter your password to confirm your changes: </label>

                </div>
            </div>
            <div class="d-flex flex-column align-items-center gap-2">
                <input class="btn btn-primary w-30" type="submit" value="Valid edited profile">
            </div>
        </form>

        <section class="d-flex flex-column align-items-center w-100 gap-1 mt-5">
            <h2 class="p-2">Edit your password</h2>
            <form action="<?php echo BASE_PATH; ?>/profile/update-password" method="post" class="w-50">
                <div class="input-group mb-3">
                    <span class="input-group-text">&#128116;</span>
                    <div class="form-floating">
                        <input type="password" class="form-control" id="floatingInputGroup1" name="oldPassword" placeholder="Old password">
                        <label for="floatingInputGroup1" class="form-label">Old password: </label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">&#128118;</span>
                    <div class="form-floating">
                        <input type="password" class="form-control" id="floatingInputGroup2" name="newPassword" placeholder="New password">
                        <label for="floatingInputGroup2" class="form-label">New password: </label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">&#128269;</span>
                    <div class="form-floating">
                        <input type="password" class="form-control" id="floatingInputGroup3" name="newPasswordCheck" placeholder="Check new password">
                        <label for="floatingInputGroup3" class="form-label">Confirm password: </label>
                    </div>
                </div>
                <div class="d-flex flex-column align-items-center gap-2">
                    <input class="btn btn-primary w-30" type="submit" value="Valid new password">
                </div>
            </form>

            <section class="d-flex flex-column align-items-center w-100 gap-1 mt-5">
                <h2 class="p-2">Delete your account</h2>
                <form action="<?php echo BASE_PATH; ?>/profile/delete-account" method="post" class="w-50">
                    <div class="input-group mb-3">
                        <span class="input-group-text">&#128274;</span>
                        <div class="form-floating">
                            <input type="password" class="form-control" id="floatingInputGroup1" name="password" placeholder="Password">
                            <label for="floatingInputGroup1" class="form-label">Enter password: </label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">&#128269;</span>
                        <div class="form-floating">
                            <input type="password" class="form-control" id="floatingInputGroup2" name="passwordCheck" placeholder="Check password">
                            <label for="floatingInputGroup2" class="form-label">Confirm password: </label>
                        </div>
                    </div>
                    <div class="d-flex flex-column align-items-center gap-2">
                        <input class="btn btn-danger w-30" type="submit" value="Delete account">
                    </div>
                </form>
            </section>
</main>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>
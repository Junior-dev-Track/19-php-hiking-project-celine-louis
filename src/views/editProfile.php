<?php $title = "Hike project - Edit hike"; ?>

<?php ob_start(); ?>

<?php ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<main>
    <h1>Edit your profile</h1>

    <form action="<?php echo BASE_PATH; ?>/profile/editProfile" method="post" class="edit-hike">
        <label for="firstname">Firstname: </label>
        <input type="text" name="firstname" value="<?php echo htmlspecialchars($_SESSION['user']['firstname']); ?>"><br>

        <label for="lastname">Lastname: </label>
        <input type="text" name="lastname" value="<?php echo htmlspecialchars($_SESSION['user']['lastname']); ?>"><br>

        <label for="email">Email: </label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($_SESSION['user']['email']); ?>"><br>

        <label for="email">Enter your password to confirm your changes: </label>
        <input type="password" id="password" name="password" placeholder="Password"><br>

        <input type="submit" value="Valid edited profile">
    </form>

    <h2>Edit your password</h2>
    <form action="<?php echo BASE_PATH; ?>/profile/update-password" method="post">
        <input type="password" id="password" name="oldPassword" placeholder="Old password"><br>
        <input type="password" id="password" name="newPassword" placeholder="New password"><br>
        <input type="password" id="password" name="newPasswordCheck" placeholder="Check new password"><br>
        <input type="submit" value="Valid new email">
    </form>

    <h2>Delete your account</h2>
    <form action="<?php echo BASE_PATH; ?>/profile/delete-account" method="post">
        <input type="password" id="password" name="password" placeholder="Password"><br>
        <input type="password" id="password" name="passwordCheck" placeholder="Check password"><br>
        <input type="submit" value="Delete your account">
    </form>
</main>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>
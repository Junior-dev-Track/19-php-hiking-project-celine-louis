<?php $title = "Hike project"; ?>

<?php ob_start(); ?>

<main>
    <form id="registerForm" action="" method="post">
        <h2>Register</h2>
        <label for="firstname">First Name</label>
        <input type="text" id="firstname" name="firstname" placeholder="First Name"><br>
        <label for="lastname">Last Name</label>
        <input type="text" id="lastname" name="lastname" placeholder="Last Name"><br>
        <label for="nickname">Nickname</label>
        <input type="text" id="nickname" name="nickname" placeholder="Nickname"><br>
        <label for="email">Nickname</label>
        <input type="email" id="email" name="email" placeholder="Email"><br>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Password"><br>
        <button class="btn" type="submit">Register</button>
    </form>
</main>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>
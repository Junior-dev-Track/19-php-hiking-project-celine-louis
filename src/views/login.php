<?php $title = "Hike project - Login"; ?>

<?php ob_start(); ?>

<main>
    <h2>LOGIN</h2>
    <form id="loginForm" action="" method="post">
        <label for="emailNickname">Nickname or email</label>
        <input type="text" id="emailNickname" name="emailNickname" placeholder="Nickname or email"><br>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Password"><br>
        <button class="btn" type="submit">Login</button>
    </form>
</main>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>
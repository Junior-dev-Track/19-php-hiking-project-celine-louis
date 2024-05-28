<?php $title = "Hike project - Your profile"; ?>

<?php ob_start(); ?>

<main>
    <section class="info_user">
        <h2>Your user profile</h2>
        <table>
            <tr>
                <th>Firstname</th>
                <td><?= htmlspecialchars($_SESSION['user']['firstname']); ?></td>
                <!-- <td><button id='editFirstname'>Edit firstname</button></td> -->
            </tr>
            <tr>
                <th>Lastname</th>
                <td><?= htmlspecialchars($_SESSION['user']['lastname']); ?></td>
                <!-- <td><button id='editLastname'>Edit lastname</button></td> -->
            </tr>
            <tr>
                <th>Nickname</th>
                <td><?= htmlspecialchars($_SESSION['user']['nickname']); ?></td>
                <!-- <td>/</td> -->
            </tr>
            <tr>
                <th>Email</th>
                <td><?= htmlspecialchars($_SESSION['user']['email']); ?></td>
                <!-- <td><button id='editEmail'>Edit email</button></td> -->
            </tr>
        </table>
        <!-- <button id='editPassword'>Edit password</button> -->
    </section>

    <section class="hike-by-user">
        <h2>Your hikes</h2>
        <?php if (!empty($hikesByUser)) : ?>
            <ul>
                <?php foreach ($hikesByUser as $hikeByUser) : ?>
                    <li>
                        <a href="/19-php-hiking-project-celine-louis/hike/<?= urlencode($hikeByUser['id']) ?>">
                            <?= htmlspecialchars($hikeByUser['name']) ?>
                        </a>
                        <a href="/19-php-hiking-project-celine-louis/edit-hike/<?= urlencode($hikeByUser['id']) ?>">
                            Edit hike
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p>No hikes found. Add a new one!</p>
        <?php endif; ?>
    </section>

    <section class="edit_profile">
        <h1>Edit your profile</h1>
        <?php if (isset($_SESSION['message'])) : ?>
            <div class="alert alert-info">
                <?= htmlspecialchars($_SESSION['message']) ?>
            </div>
        <?php endif; ?>

        <h2>Edit your firstname</h2>
        <form action="profile/update-firstname" method="post">
            <input type="text" id="firstname" name="firstname" placeholder="New firstname"><br>
            <input type="password" id="password" name="password" placeholder="Password"><br>
            <input type="submit" value="Valid new firstname">
        </form>

        <?php if (isset($_SESSION['message'])) : ?>
            <p> <?php $_SESSION['message']; ?> </p>
        <?php endif; ?>

        <h2>Edit your lastname</h2>
        <form action="profile/update-lastname" method="post">
            <input type="text" id="lastname" name="lastname" placeholder="New lastname"><br>
            <input type="password" id="password" name="password" placeholder="Password"><br>
            <input type="submit" value="Valid new lastname">
        </form>

        <h2>Edit your email</h2>
        <form action="profile/update-email" method="post">
            <input type="email" id="email" name="email" placeholder="New email"><br>
            <input type="password" id="password" name="password" placeholder="Password"><br>
            <input type="submit" value="Valid new email">
        </form>

        <h2>Edit your password</h2>
        <form action="profile/update-password" method="post">
            <input type="password" id="password" name="oldPassword" placeholder="Old password"><br>
            <input type="password" id="password" name="newPassword" placeholder="New password"><br>
            <input type="password" id="password" name="newPasswordCheck" placeholder="Check new password"><br>
            <input type="submit" value="Valid new email">
        </form>

        <h2>Delete your account</h2>
        <form action="profile/delete-account" method="post">
            <input type="password" id="password" name="password" placeholder="Password"><br>
            <input type="password" id="password" name="passwordCheck" placeholder="Check password"><br>
            <input type="submit" value="Delete your account">
        </form>
    </section>

</main>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>
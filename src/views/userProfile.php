<?php $title = "Hike project - Your profile"; ?>

<?php ob_start(); ?>

<main>
    <section class="info_user">
        <h2>Your user profile</h2>
        <table>
            <tr>
                <th>Firstname</th>
                <td><?= htmlspecialchars($_SESSION['user']['firstname']); ?></td>
            </tr>
            <tr>
                <th>Lastname</th>
                <td><?= htmlspecialchars($_SESSION['user']['lastname']); ?></td>
            </tr>
            <tr>
                <th>Nickname</th>
                <td><?= htmlspecialchars($_SESSION['user']['nickname']); ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?= htmlspecialchars($_SESSION['user']['email']); ?></td>
            </tr>
        </table>
        <a href="/19-php-hiking-project-celine-louis/profile/editProfile">Edit your profile</a>
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

    <?php if (isset($_SESSION['message'])) : ?>
        <div class="alert alert-info">
            <?= htmlspecialchars($_SESSION['message']) ?>
        </div>
    <?php endif; ?>

</main>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>
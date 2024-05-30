<?php if (isset($hike['tag']) && $hike['tag'] != null) : ?>
    <p>&#128278;<?= htmlspecialchars($hike['tag']) ?></p>
    <?php endif; ?><?php $title = "Hike project - Your profile"; ?>

    <?php ob_start(); ?>


    <main class="d-flex flex-column  w-100 gap-1 mx-3">
        <div class="card d-flex flex-column align-items-center p-3 mb-3 gap-2" style="width: 18rem;">
            <h2>Your user profile</h2>
            <table>
                <tbody>
                    <tr>
                        <th class="px-3" scope="row">Firstname</th>
                        <td><?= htmlspecialchars($_SESSION['user']['firstname']); ?></td>
                    </tr>
                    <tr>
                        <th class="px-3" scope="row">Lastname</th>
                        <td><?= htmlspecialchars($_SESSION['user']['lastname']); ?></td>
                    </tr>
                    <tr>
                        <th class="px-3" scope="row">Nickname</th>
                        <td><?= htmlspecialchars($_SESSION['user']['nickname']); ?></td>
                    </tr>
                    <tr>
                        <th class="px-3" scope="row">Email</th>
                        <td><?= htmlspecialchars($_SESSION['user']['email']); ?></td>
                    </tr>
                </tbody>
            </table>
            <a type="button" class="btn btn-primary mt-3" href="/19-php-hiking-project-celine-louis/profile/editProfile">Edit your profile</a>
        </div>

        <section class="hike-by-user w-100">
            <h2>Your hikes</h2>
            <?php if (!empty($hikesByUser)) : ?>
                <div class="list-group w-25 gap-3">
                    <?php foreach ($hikesByUser as $hikeByUser) : ?>
                        <div class="d-flex flex-row align-items-center">
                            <a class="list-group-item list-group-item-action" href="/19-php-hiking-project-celine-louis/hike/<?= urlencode($hikeByUser['id']) ?>">
                                <?= htmlspecialchars($hikeByUser['name']) ?>
                            </a>
                            <a type="button" class="btn btn-primary btn-sm mx-3" href="/19-php-hiking-project-celine-louis/edit-hike/<?= urlencode($hikeByUser['id']) ?>" style="min-width: 100px;">Edit hike</a>

                        </div>
                    <?php endforeach; ?>
                </div>
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
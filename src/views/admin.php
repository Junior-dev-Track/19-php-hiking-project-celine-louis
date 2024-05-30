<?php $title = "Hike project - Admin"; ?>

<?php ob_start(); ?>

<?php ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<main>
    <h1>Admin pannel</h1>

    <section class="listUser">
        <h2>Manage users</h2>
        <table>
            <tr>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>nickname</th>
                <th>email</th>
                <th>Administrator</th>
                <th></th>
                <th></th>
            </tr>

            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?= $user['firstname']; ?></td>
                    <td><?= $user['lastname']; ?></td>
                    <td><?= $user['nickname']; ?></td>
                    <td><?= $user['email']; ?></td>
                    <td>
                        <?php echo $user['isAdmin'] == 1 ? 'Yes' : 'No'; ?>
                    </td>
                    <td><a href="">Delete User</a></td>
                    <td>
                        <?php if ($user['isAdmin'] == 1) : ?>
                            <a href="">Remove admin</a>
                        <?php else : ?>
                            <a href="">Add admin</a>
                        <?php endif ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </section>

    <section class="listTags">
        <h2>Manage tags</h2>
        <ul>
            <?php foreach ($tags as $tag) : ?>
                <li>
                    <?php echo $tag; ?>
                    <a href="">Delete tag</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
</main>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>
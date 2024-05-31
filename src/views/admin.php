<?php $title = "Hike project - Admin"; ?>

<?php ob_start(); ?>

<?php ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<main>
    <h2>Admin pannel</h2>
    <section class="listUser pt-3">
        <h3>Manage users</h3>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Firstname</th>
                    <th scope="col">Lastname</th>
                    <th scope="col">nickname</th>
                    <th scope="col">email</th>
                    <th scope="col">Administrator</th>
                    <th scope="col">Delete</th>
                    <th scope="col">Manage admin</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <th scope="row">&#127183;</th>
                        <td><?= $user['firstname']; ?></td>
                        <td><?= $user['lastname']; ?></td>
                        <td><?= $user['nickname']; ?></td>
                        <td><?= $user['email']; ?></td>
                        <td>
                            <?php echo $user['isAdmin'] == 1 ? 'Yes' : 'No'; ?>
                        </td>
                        <td><a class="btn btn-danger" href="<?php echo BASE_PATH; ?>/admin/deleteUser/<?= urlencode($user['id_user']) ?>">Delete User</a></td>
                        <td>
                            <?php if ($user['isAdmin'] == 1) : ?>
                                <a class="btn btn-warning" href="<?php echo BASE_PATH; ?>/admin/updateAdmin/<?= urlencode($user['id_user']) ?>/<?= urlencode($user['isAdmin']) ?>">Remove admin</a>
                            <?php else : ?>
                                <a class="btn btn-success px-3" href="<?php echo BASE_PATH; ?>/admin/updateAdmin/<?= urlencode($user['id_user']) ?>/<?= urlencode($user['isAdmin']) ?>">Add as admin</a>
                            <?php endif ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

    <section class="listTags pt-3">
        <h3>Manage tags</h3>
        <ul>
            <?php foreach ($tags as $tag) : ?>
                <?php if ($tag != null) : ?>
                    <li class=" p-2">
                        <?php echo $tag; ?>
                        <a class="btn btn-danger" href="<?php echo BASE_PATH; ?>/admin/deleteTag/<?= urlencode($tag) ?>">Delete tag</a>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </section>
</main>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>
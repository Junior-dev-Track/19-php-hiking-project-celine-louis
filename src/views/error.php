<?php $title = "My cookbook - Error"; ?>

<?php ob_start(); ?>
<h1>Welcome on my cookbook! </h1>
<p>Error: : <?= $errorMessage ?></p>
<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>
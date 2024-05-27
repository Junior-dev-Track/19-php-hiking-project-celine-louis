<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title><?= $title ?></title>
    <link rel="stylesheet" href="../output.css">
</head>

<header>
    <nav>
        <ul>
            <div class="left-nav">
                <li><a href="/19-php-hiking-project-celine-louis/">Home</a></li>
            </div>
            <div class="right-nav">
                <?php if (!isset($_SESSION['user']) || !$_SESSION['user']) : ?>
                    <li><a href="/19-php-hiking-project-celine-louis/register">Register</a></li>
                    <li><a href="/19-php-hiking-project-celine-louis/login">Login</a></li>
                <?php else : ?>
                    <li><a href="/19-php-hiking-project-celine-louis/logout">Logout</a></li>
                    <li><a href="/19-php-hiking-project-celine-louis/profile">User profile</a></li>
                    <li><a href="/19-php-hiking-project-celine-louis/addHike">Add a hike</a></li>
                <?php endif; ?>
            </div>
        </ul>
    </nav>
</header>

<body>
    <?= $content ?>
</body>

<footer class="bg-red-500">
    <p>I'm an amazing footer</p>
</footer>

</html>
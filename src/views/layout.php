<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="../style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<header>
    <nav class="p-2">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/19-php-hiking-project-celine-louis/">Home</a>
            </li>
            <?php if (!isset($_SESSION['user']) || !$_SESSION['user']) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="/19-php-hiking-project-celine-louis/register">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/19-php-hiking-project-celine-louis/login">Login</a>
                </li>
            <?php else : ?>
                <li class="nav-item">
                    <a class="nav-link" href="/19-php-hiking-project-celine-louis/logout" rel="noopener noreferrer">Logout</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/19-php-hiking-project-celine-louis/profile" rel="noopener noreferrer">User Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/19-php-hiking-project-celine-louis/addHike" rel="noopener noreferrer">Add Hike</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<body>
    <?= $content ?>
</body>

<footer>
    <p>I'm an amazing footer</p>
</footer>

</html>
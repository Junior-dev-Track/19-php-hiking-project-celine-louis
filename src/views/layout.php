<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="../style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .nav-link:hover {
            color: #0D6EFD;
        }

        .page-container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content-wrap {
            flex-grow: 1;
        }

        footer {
            width: 100%;
            z-index: 1030;
        }
    </style>
</head>

<body>
    <div class="page-container">
        <header class="mb-2">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand">Hike</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="/19-php-hiking-project-celine-louis/">Home</a>
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
                                    <a class="nav-link" href="/19-php-hiking-project-celine-louis/profile">User profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/19-php-hiking-project-celine-louis/addHike">Add Hike</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-danger border-danger" href="/19-php-hiking-project-celine-louis/logout">Logout</a>
                                </li>
                                <?php if ($_SESSION['user']['isAdmin'] == 1) : ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/19-php-hiking-project-celine-louis/admin">Admin</a>
                                    </li>
                                <?php endif ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <div class="content-wrap">
            <?= $content ?>
        </div>

        <footer class="bg-body-tertiary text-center text-lg-start mt-3">
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
                © 2024 Copyright: Celou website hiking
            </div>
        </footer>
    </div>
</body>

</html>
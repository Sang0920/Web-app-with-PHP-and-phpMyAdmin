<?php
$user = $_COOKIE['user'];
$user = unserialize($user);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Do The Sang">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    <script src="../includes/photo.preview.js"></script>
    <title><?= $title ?></title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">MyShoeShop</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <?php
                            if (isset($title) && $title == 'Admin') :
                            ?>
                                <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
                            <?php else : ?>
                                <a class="nav-link active" aria-current="page" href="../home">Home</a>
                            <?php endif; ?>
                        </li>
                        <li class="nav-item">
                            <?php
                            if (isset($title) && $title == 'Admin') :
                            ?>
                                <a class="nav-link" href="./products/">Manage products</a>
                            <?php else : ?>
                                <a class="nav-link active" aria-current="page" href="../products">Manage products</a>
                            <?php endif; ?>
                        </li>
                        <li class="nav-item">
                            <?php
                            if (isset($title) && $title == 'Admin') :
                            ?>
                                <a class="nav-link" href="./brands/">Manage brands</a>
                            <?php else : ?>
                                <a class="nav-link active" aria-current="page" href="../brands">Manage brands</a>
                            <?php endif; ?>
                        </li>
                        <li class="nav-item">
                            <?php
                            if (isset($title) && $title == 'Admin') :
                            ?>
                                <a class="nav-link" href="./categories/">Manage categories</a>
                            <?php else : ?>
                                <a class="nav-link active" aria-current="page" href="../categories">Manage categories</a>
                            <?php endif; ?>
                        </li>
                        <li class="nav-item">
                            <?php
                            if (isset($title) && $title == 'Admin') :
                            ?>
                                <a class="nav-link" href="./orders/">Manage orders</a>
                            <?php else : ?>
                                <a class="nav-link active" aria-current="page" href="../orders">Manage orders</a>
                            <?php endif; ?>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="logout.php">Logout</a>
                        </li>
                    </ul>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
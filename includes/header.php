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
    <link rel="shortcut icon" href="./photos/shoe.png" type="image/x-icon">
    <link rel="stylesheet" href="./includes/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <title><?= $title ?></title>
</head>

<body>
    <header>
        <div class="menu">
            <div class="bar"></div>
        </div>
        <div class="overlay"></div>
        <a href="index.php" class="brand none-display"><img src="./photos/shoe.png" alt="Our LOGO" width="70px"></a>
        <nav id="navbar">
            <a href="index.php" class="brand"><img src="./photos/shoe.png" alt="" width="70px"></a>
            <ul>
                <li class="my-nav-item">
                    <a class="my-nav-link" href="men.php" title="Men Products" data-text="Men">Men</a>
                </li>
                <li class="my-nav-item">
                    <a class="my-nav-link" href="women.php" title="Women Products" data-text="Women">Women</a>
                </li>
                <li class="my-nav-item">
                    <a class="my-nav-link" href="kids.php" title="Kids Products" data-text="Kids">Kids</a>
                </li>
                <?php if (isset($user->roleid)) : ?>
                    <?php if ($user->roleid == 0) : ?>
                        <li class="my-nav-item">
                            <a class="my-nav-link" href="new-product.php">Add new product</a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if (isset($user->username)) : ?>
                    <li class="my-nav-item">
                        <a class="my-nav-link active" aria-current="page" href="logout.php" data-text="Logout" title="Logout">Logout</a>
                    </li>
                <?php else : ?>
                    <li class="my-nav-item">
                        <a class="my-nav-link active" aria-current="page" href="login.php" data-text="Login" title="Login">Login</a>
                    </li>
                <?php endif; ?>
                <li class="my-nav-item">
                    <a href="cart.php" title="Your Bag"><i class="fa bi bi-bag-fill nav-icon fs-3"></i></a>
                </li>
            </ul>
            <form class=" d-flex fs-1" method="post" action="search.php">
                <input class="form-control me-2 fs-3" type="search" name="search" placeholder="Search..." aria-label="Search">
                <input class="btn btn-outline-success fs-3" type="submit" value="Search"></input>
            </form>
        </nav>
    </header>

    <script>
        selector(" .menu").addEventListener("click", function() {
            this.classList.toggle('open');
            selector('header').classList.toggle('open');
            selector('.overlay').classList.toggle('open');
        });

        function selector(s) {
            return document.querySelector(s);
        }
    </script>
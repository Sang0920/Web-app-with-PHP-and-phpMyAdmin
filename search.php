<?php
require './includes/init.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $search = $_POST['search'];
    $products = Product::searchByName($pdo, $search);
}
$title = "Search results";
include_once './includes/header.php';
?>

<div class="container">
    <h2>Search results</h2>

    <div class="row row-cols-1 row-cols-md-3 g-4" id="products">
        <?php foreach ($products as $item) : ?>
            <div class="col">
                <div class="card">
                    <img src="<?= '.'.$item->getFistImagePath($pdo) ?>" alt="<?= $item->productname ?>" class="card-img-top" />
                    <div class="card-body">
                        <h5 class="card-title"><?= $item->productname ?></h5>
                        <p class="card-text"><?= $item->shortdescription ?></p>
                        <p class="card-text"><?= number_format($item->price, 0, '', ',') ?>$</p>
                        <button class="btn btn-primary btn-lg shop" value="<?= $item->productid ?>">Shop</button>
                        <?php if ($item->countColors($pdo) > 1) : ?>
                            <p><?= $item->countColors($pdo) ?> Colors</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
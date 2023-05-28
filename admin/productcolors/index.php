<?php
require_once '../includes/init.php';
$title = 'Product Colors Management';
require_once '../includes/header.php';
$productid = $_GET['productid'];
$productcolors = ProductColor::getAll($pdo, $productid);
?>
<center>
    <h1>Product Colors Management</h1>
</center>

<?php if ($productid) : ?>
    <p>
        <a href="./create.php?productid=<?= $productid; ?>" class="btn btn-primary">Add new color for <b><?= Product::getById($pdo, $productid)->productname; ?></b></a>
    </p>
<?php endif; ?>
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Color</th>
                <th>Actions</th>
                <th>Manage Photos</th>
                <th>Manage Sizes</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productcolors as $item) : ?>
                <tr>
                    <td><?= Product::getById($pdo, $productid)->productname; ?></td>
                    <td><?= $item->color; ?></td>
                    <td>
                        <a class="btn btn-danger" href="<?= "delete.php?id={$item->productid}&color={$item->color}"; ?>">Delete</a>
                    </td>
                    <td>
                        <a href="../productphotos?id=<?= $item->productid; ?>&color=<?= $item->color; ?>">View Photos</a>
                    </td>
                    <td>
                        <a href="../productsizes?id=<?= $item->productid; ?>&color=<?= $item->color; ?>">View Sizes</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include_once "../includes/footer.php"; ?>
<?php
require_once '../includes/init.php';
$title = 'Product Photos Management';
require_once '../includes/header.php';
$productid = $_GET['id'];
$color = $_GET['color'];
$productphotos = ProductPhoto::getAll($pdo, $productid, $color);
?>
<center>
    <h1>Product Photos Management</h1>
</center>
<?php if ($productid) : ?>
    <p>
        <a href="./create.php?id=<?= $productid; ?>&color=<?= $color; ?>" class="btn btn-primary">Add new photo for <b><?= Product::getById($pdo, $productid)->productname; ?></b> with color: <b><?= $color; ?></b></a>
        <!-- Back to product colors management-->
        <a href="../productcolors?productid=<?= $productid; ?>" class="btn btn-secondary">Back to Product Colors Management</a>
    </p>
<?php endif; ?>

<table class="table">
    <tr>
        <th>
            Index
        </th>
        <th>
            Product name
        </th>
        <th>
            Color
        </th>
        <th>
            Photo
        </th>
        <th>Actions</th>
    </tr>
    <?php
    $i = 1;
    foreach ($productphotos as $item) : ?>
        <tr>
            <td>
                <?= $i++; ?>
            </td>
            <td>
                <?= Product::getById($pdo, $productid)->productname; ?>
            </td>
            <td>
                <?= $color; ?>
            </td>
            <td>
                <img src="<?= '../../' . $item->imagepath; ?>" alt="<?= $item->imagepath; ?>" class="figure-img" style="max-width: 15vw" />
            </td>
            <td>
                <a class="btn btn-danger" href="<?= "./delete.php?id={$item->id}"; ?>">Delete</a>
                <a class="btn btn-warning" href="<?= "./edit.php?id={$item->id}"; ?>">Edit</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
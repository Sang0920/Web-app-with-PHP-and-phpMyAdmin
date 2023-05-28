<?php
require_once '../includes/init.php';
$title = "Product Size Management";
require_once '../includes/header.php';
$productid = $_GET['id'];
$color = $_GET['color'];
$productsizes = ProductSize::getAll($pdo, $productid, $color);
?>
<center>
    <h1>Product Size Management</h1>
</center>

<?php if ($productid) : ?>
    <p>
        <a href="./create.php?id=<?= $productid; ?>&color=<?= $color; ?>" class="btn btn-primary">Add new size for <b><?= Product::getById($pdo, $productid)->productname; ?></b> with color: <b><?= $color; ?></b></a>
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
            Size
        </th>
        <th>
            Quantity
        </th>
        <th>Actions</th>
    </tr>
    <?php
    $i = 1;
    foreach ($productsizes as $item) : ?>
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
                <?= $item->size; ?>
            </td>
            <td>
                <?= $item->qty; ?>
            </td>
            <td>
                <a class="btn btn-danger" href="<?= "./delete.php?id={$item->id}"; ?>">Delete</a>
                <a class="btn btn-warning" href="<?= "./edit.php?id={$item->id}"; ?>">Edit</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php require_once '../includes/footer.php'; ?>
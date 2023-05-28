<?php
require_once '../includes/init.php';
$err_msg = '';
$productsize = ProductSize::getById($pdo, $_GET['id']);
if (!$productsize) {
    header('Location: ./index.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!$productsize->delete($pdo)) {
        $err_msg = 'Error deleting product size';
    } else {
        header('Location: ./index.php?id=' . $productsize->productid . '&color=' . $productsize->color);
    }
}
$title = 'Delete Product Size';
require_once '../includes/header.php';
?>
<h1>Delete Product Size</h1>
<small class="text-danger"><?= $err_msg; ?></small>
<h3>
    Are you sure you want to delete this?
</h3>
<div>
    <h4>Product Size</h4>
    <hr />
    <dl class="dl-horizontal">
        <dt>
            Product name
        </dt>
        <dd>
            <?= Product::getById($pdo, $productsize->productid)->productname; ?>
        </dd>
        <dt>
            Color
        </dt>
        <dd>
            <?= $productsize->color; ?>
        </dd>
        <dt>
            Size
        </dt>
        <dd>
            <?= $productsize->size; ?>
        </dd>
        <dt>
            Quantity
        </dt>
        <dd>
            <?= $productsize->qty; ?>
        </dd>
    </dl>
    <form method="post">
        <input type="submit" value="Delete" class="btn btn-danger">
        <a href="./index.php?id=<?= $productsize->productid; ?>&color=<?= $productsize->color; ?>" class="btn btn-secondary">Back to Product Size Management</a>
    </form>
</div>
<?php require_once '../includes/footer.php'; ?>
<?php
require_once '../includes/init.php';
$err_msg = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['productid'];
    $color = $_POST['color'];
    $productcolor = new ProductColor();
    $productcolor->productid = $id;
    $productcolor->color = $color;
    if ($productcolor->delete($pdo) === true) {
        header('location: ./index.php?productid=' . $id);
    } else {
        $err_msg = 'Delete failed!';
    }
}
$productid = $_GET['id'];
$color = $_GET['color'];
$productcolor = new ProductColor();
$productcolor->productid = $productid;
$productcolor->color = $color;
if ($productcolor->isExisted($pdo) === false) {
    echo '<h2 class="text-bg-warning">Access denied, please make sure your IDs for this action is not null and correct!</h2>';
    echo '<a href="/admin/products">Return to Products</a>';
} else {
    $title = "Delete";
    require_once '../includes/header.php';
?>

    <h2>Delete</h2>
    <small class="text-danger"><?= $err_msg ?></small>
    <h3 class="text-bg-danger text-center">Are you sure you want to delete this?</h3>
    <div>
        <h4>ProductsColor</h4>
        <hr />
        <dl class="dl-horizontal">
            <dt>
                <?= Product::getById($pdo, $productcolor->productid)->productname; ?>
            </dt>
            <dd>
                Color: <span><?= $productcolor->color; ?></span>
            </dd>
        </dl>

        <form method="post">
            <input type="hidden" name="productid" value="<?= $productcolor->productid; ?>">
            <input type="hidden" name="color" value="<?= $productcolor->color; ?>">

            <div class="form-actions no-color">
                <input type="submit" value="Delete" class="btn btn-default btn-outline-danger" /> |
                <a href="./index.php?productid=<?= $productcolor->productid ?>">Back to List</a>
            </div>
        </form>
    </div>
<?php
}
include_once '../includes/footer.php';
?>
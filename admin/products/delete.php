<?php
require_once '../includes/init.php';
$err_msg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product = Product::getById($pdo, $_POST['id']);
    if ($product) {
        $err_msg = $product->delete($pdo, $_POST['id']);
        if (!$err_msg) {
            header('Location: ./index.php');
            exit();
        }
    }
}

$product = Product::getById($pdo, $_GET['id']);
if (!$product) {
    echo '<h2 class="text-bg-warning">Access denied, please make sure your ID for this action is not null and correct!</h2>';
    echo '<a href="./index.php">Return to Products</a>';
} else {
    $title = "Delete";
    require_once '../includes/header.php';
?>

    <h2>Delete</h2>
    <small class="text-danger"><?= $err_msg ?></small>
    <h3 class="text-bg-danger text-center">Are you sure you want to delete this?</h3>

    <dl class="dl-horizontal">
        <dt>
            <?= htmlspecialchars('Product ID'); ?>
        </dt>

        <dd>
            <?= htmlspecialchars($product->productid); ?>
        </dd>
        <dt>
            <?= htmlspecialchars('Brand Name'); ?>
        </dt>

        <dd>
            <?= htmlspecialchars(Brand::getById($pdo, $product->brandid)->brandname); ?>
        </dd>

        <dt>
            <?= htmlspecialchars('Category Name'); ?>
        </dt>

        <dd>
            <?php
            $category = Category::getById($pdo, $product->categoryid);
            echo htmlspecialchars($category->categoryname . ' - ' . $category->categorysubname);
            ?>
        </dd>

        <dt>
            <?= htmlspecialchars('Product Name'); ?>
        </dt>

        <dd>
            <?= htmlspecialchars($product->productname); ?>
        </dd>

        <dt>
            <?= htmlspecialchars('Price'); ?>
        </dt>

        <dd>
            <?= htmlspecialchars($product->price); ?>
        </dd>

        <dt>
            <?= htmlspecialchars('Discount'); ?>
        </dt>

        <dd>
            <?= htmlspecialchars($product->discount); ?>
        </dd>

        <dt>
            <?= htmlspecialchars('Product Short Description'); ?>
        </dt>

        <dd>
            <?= htmlspecialchars($product->shortdescription); ?>
        </dd>

        <dt>
            <?= htmlspecialchars('Product Description'); ?>
        </dt>

        <dd>
            <?= htmlspecialchars($product->description); ?>
        </dd>

        <dt>
            <?= htmlspecialchars('Gender'); ?>
        </dt>
        <dd>
            <?php
            if ($product->gender == 0) {
                echo htmlspecialchars('Male');
            } elseif ($product->gender == 1) {
                echo htmlspecialchars('Female');
            } else {
                echo htmlspecialchars('Unisex');
            }
            ?>
        </dd>
        <dt>
            <?= htmlspecialchars('Size Type'); ?>
        </dt>

        <dd>
            <?= htmlspecialchars($product->sizetype); ?>
        </dd>

    </dl>
    <form method="post" class="text-center">
        <input type="hidden" name="id" value="<?= $product->productid ?>">
        <button type="submit" class="btn btn-danger">Delete</button>
        <a href="./index.php" class="btn btn-secondary">Cancel</a>
    </form>
<?php
}
include_once '../includes/footer.php';
?>
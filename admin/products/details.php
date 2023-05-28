<?php
require_once '../includes/init.php';
$product = Product::getById($pdo, $_GET['id']);

if (!$product) {
    echo '<h2 class="text-bg-warning">Access denied, please make sure your ID for this action is not null and correct!</h2>';
    echo '<a href="./index.php">Return to Products</a>';
} else {
    $title = "Details";
    require_once '../includes/header.php';
?>

    <h2>Details</h2>

    <div>
        <h4>Product</h4>
        <hr />
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
    </div>
    <p>
        <a href="edit.php?id=<?= htmlspecialchars($product->productid); ?>">Edit</a> |
        <a href="delete.php?id=<?= $product->productid; ?>">Delete</a> |
        <a href="/admin/productscolors?productId=<?= $product->productid; ?>">View Colors</a> |
        <a href="index.php">Back to List</a>
    </p>
<?php
}
include_once '../includes/footer.php';
?>
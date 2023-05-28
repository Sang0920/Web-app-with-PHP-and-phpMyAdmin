<?php
require_once '../includes/init.php';
$productid = $_GET['productid'];

if (!$productid) {
    header('Location: ./index.php');
    exit();
}

$err_msg = '';
$product_id_err = '';
$color_err = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productid = $_POST['productid'];
    $color = $_POST['color'];
    if (!$productid) {
        $product_id_err = 'Product is required';
    }
    if (!$color) {
        $color_err = 'Color is required';
    }
    if (empty($product_id_err) && empty($color_err)) {
        $productcolor = new ProductColor();
        $productcolor->productid = $productid;
        $productcolor->color = $color;
        $err_msg = $productcolor->create($pdo);
        if ($err_msg === true) {
            header('Location: ./index.php?productid=' . $productid);
            exit();
        }
    }
}

$title = 'Create Product Color';
require_once '../includes/header.php';
?>
<h2>Create new product color</h2>
<small class="text-danger"><?= $err_msg ?></small>

<form method="post">
    <div class="form-group">
        <label for="productid">Product</label>
        <select name="productid" id="productid" class="form-control">
            <option value="">Please chose product...</option>
            <?php
            $products = Product::getAll($pdo);
            foreach ($products as $product) {
                if ($product->productid == $productid) {
                    echo '<option value="' . $product->productid . '" selected>' . $product->productname . '</option>';
                } else {
                    echo '<option value="' . $product->productid . '">' . $product->productname . '</option>';
                }
            }
            ?>
        </select>
        <small class="text-danger"><?= $product_id_err ?></small>
    </div>

    <div class="form-group">
        <label for="color">Color</label>
        <input type="text" id="color" name="color" class="form-control" required>
        <small class="text-danger"><?= $color_err ?></small>
    </div>

    <button type="submit" class="btn btn-primary">Create</button>
</form>
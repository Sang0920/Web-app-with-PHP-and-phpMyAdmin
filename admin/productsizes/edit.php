<?php
require_once '../includes/init.php';
$err_msg = '';
$productid_err = '';
$color_err = '';
$size_err = '';
$qty_err = '';

$productsizeid = $_GET['id'];
$productsize = ProductSize::getById($pdo, $productsizeid);
$productid = $productsize->productid;
$color = $productsize->color;
$size = $productsize->size;
$qty = $productsize->qty;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productid = $_POST['productid'];
    $color = $_POST['color'];
    $size = $_POST['size'];
    $qty = $_POST['qty'];

    if (empty($productid)) {
        $productid_err = 'Please choose a product';
    }

    if (empty($color)) {
        $color_err = 'Please choose a color';
    }

    if (empty($size)) {
        $size_err = 'Please enter a size';
    }

    if ($qty==null) {
        $qty_err = 'Please enter a quantity';
    }

    if (empty($productid_err) && empty($color_err) && empty($size_err) && empty($qty_err)) {
        $productsize->productid = $productid;
        $productsize->color = $color;
        $productsize->size = $size;
        $productsize->qty = $qty;
        if ($productsize->update($pdo)) {
            header('Location: ./index.php?id=' . $productid . '&color=' . $color);
        } else {
            $err_msg = 'Error creating product size';
        }
    }
}

$productid = $_GET['id'];
$products = Product::getAll($pdo);
$colors = ProductColor::getAll($pdo, $productsize->productid);

$title = 'Update Product Size';
require_once '../includes/header.php';
?>
<h1>Update Product Size</h1>
<small class="text-danger"><?= $err_msg; ?></small>

<form method="post">
    <div class="form-horizontal">
        <div class="form-group">
            <label for="productid" class="control-label col-md-2">Product</label>
            <div class="col-md-10">
                <select name="productid" id="productid" class="form-control">
                    <option value="">Choose a product</option>
                    <?php foreach ($products as $item) : ?>
                        <option value="<?= $item->productid; ?>" <?= $item->productid == $productsize->productid ? 'selected' : ''; ?>><?= $item->productname; ?></option>
                    <?php endforeach; ?>
                </select>
                <small class="text-danger"><?= $productid_err; ?></small>
            </div>
        </div>
        <div class="form-group">
            <label for="color" class="control-label col-md-2">Color</label>
            <div class="col-md-10">
                <select name="color" id="color" class="form-control">
                    <option value="">Choose a color</option>
                    <?php foreach ($colors as $item) : ?>
                        <option value="<?= $item->color; ?>" <?= $item->color == $productsize->color ? 'selected' : ''; ?>><?= $item->color; ?></option>
                    <?php endforeach; ?>
                </select>
                <small class="text-danger"><?= $color_err; ?></small>
            </div>
        </div>
        <div class="form-group">
            <label for="size" class="control-label col-md-2">Size</label>
            <div class="col-md-10">
                <input type="text" name="size" id="size" class="form-control" value="<?= $size; ?>">
                <small class="text-danger"><?= $size_err; ?></small>
            </div>
        </div>
        <div class="form-group">
            <label for="qty" class="control-label col-md-2">Quantity</label>
            <div class="col-md-10">
                <input type="number" name="qty" id="qty" class="form-control" value="<?= $qty; ?>">
                <small class="text-danger"><?= $qty_err; ?></small>
            </div>
        </div>
        <div class="form-group">
            <input type="submit" value="Update" class="btn btn-primary">
        </div>
    </div>
</form>

<?php include_once '../includes/footer.php'; ?>
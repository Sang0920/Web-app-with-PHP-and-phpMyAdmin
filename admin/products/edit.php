<?php
require '../includes/init.php';

$err_msg = '';
$product_name_err = '';
$price_err = '';
$discount_err = '';
$short_description_err = '';
$description_err = '';
$gender_err = '';
$size_type_err = '';
$brand_id_err = '';
$category_id_err = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['productId'];
    $product_name = $_POST['productName'];
    $price = $_POST['price'];
    $discount = $_POST['discount'];
    $short_description = $_POST['shortDescription'];
    $description = $_POST['description'];
    $size_type = $_POST['sizeType'];
    $brand_id = $_POST['brandId'];
    $category_id = $_POST['categoryId'];

    if (empty($product_name)) {
        $product_name_err = 'Product name is required';
    }

    if (empty($price)) {
        $price_err = 'Price is required';
    }

    if ($discount == null || $discount == '') {
        $discount_err = 'Discount is required';
    }

    if (empty($short_description)) {
        $short_description_err = 'Short description is required';
    }

    if (empty($description)) {
        $description_err = 'Description is required';
    }

    if (empty($size_type)) {
        $size_type_err = 'Size type is required';
    }

    if (empty($brand_id)) {
        $brand_id_err = 'Brand is required';
    }

    if (empty($category_id)) {
        $category_id_err = 'Category is required';
    }

    if (empty($product_name_err) && empty($price_err) && empty($discount_err) && empty($description_err) && empty($gender_err) && empty($size_type_err) && empty($brand_id_err) && empty($category_id_err)) {
        $product = Product::getById($pdo, $product_id);
        if ($product) {
            $product->productname = $product_name;
            $product->price = $price;
            $product->discount = $discount;
            $product->shortdescription = $short_description;
            $product->description = $description;
            $product->sizetype = $size_type;
            $product->brandid = $brand_id;
            $product->categoryid = $category_id;
            $err_msg = $product->update($pdo);
            if (!$err_msg) {
                header('Location: ./index.php');
                exit();
            }
        } else {
            $err_msg = 'Product not found';
        }
    }
} else {
    $product_id = $_GET['id'];
    $product = Product::getById($pdo, $product_id);
    if (!$product) {
        $err_msg = 'Product not found';
    } else {
        $product_name = $product->productname;
        $price = $product->price;
        $discount = $product->discount;
        $short_description = $product->shortdescription;
        $description = $product->description;
        $gender = $product->gender;
        $size_type = $product->sizetype;
        $brand_id = $product->brandid;
        $category_id = $product->categoryid;
    }
}

$title = "Edit Product";
require_once '../includes/header.php';
?>

<h2>Edit product</h2>
<small class="text-danger"><?= $err_msg ?></small>
<form method="post" class="mx-5">
    <input type="hidden" name="productId" value="<?= $product_id ?>">

    <div class="form-group">
        <label for="productName">Product Name</label>
        <input type="text" class="form-control <?= (!empty($product_name_err)) ? 'is-invalid' : '' ?>" id="productName" name="productName" value="<?= $product_name ?>">
        <small class="text-danger"><?= $product_name_err ?></small>
    </div>

    <div class="form-group">
        <label for="price">Price</label>
        <input type="number" class="form-control <?= (!empty($price_err)) ? 'is-invalid' : '' ?>" id="price" name="price" value="<?= $price ?>">
        <small class="text-danger"><?= $price_err ?></small>
    </div>

    <div class="form-group">
        <label for="discount">Discount</label>
        <input type="number" class="form-control <?= (!empty($discount_err)) ? 'is-invalid' : '' ?>" id="discount" name="discount" value="<?= $discount ?>">
        <small class="text-danger"><?= $discount_err ?></small>
    </div>

    <div class="form-group">
        <label for="shortDescription">Short Description</label>
        <input type="text" class="form-control <?= (!empty($short_description_err)) ? 'is-invalid' : '' ?>" id="shortDescription" name="shortDescription" value="<?= $short_description ?>">
        <small class="text-danger"><?= $short_description_err ?></small>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control <?= (!empty($description_err)) ? 'is-invalid' : '' ?>" id="description" name="description" rows="4"><?= $description ?></textarea>
        <small class="text-danger"><?= $description_err ?></small>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="gender">Gender</label>
            <select id="gender" name="gender" class="form-control" required>
                <?php if ($gender == 0) : ?>
                    <option value="0" selected>Male</option>
                <?php else : ?>
                    <option value="0">Male</option>
                <?php endif; ?>
                <?php if ($gender == 1) : ?>
                    <option value="1" selected>Female</option>
                <?php else : ?>
                    <option value="1">Female</option>
                <?php endif; ?>
                <?php if ($gender == 2) : ?>
                    <option value="2" selected>Unisex</option>
                <?php else : ?>
                    <option value="2">Unisex</option>
                <?php endif; ?>
            </select>
            <small class="text-danger"><?= $gender_err ?></small>
        </div>

        <div class="form-group col-md-6">
            <label for="sizeType">Size Type</label>
            <input type="text" id="sizeType" name="sizeType" class="form-control" required value="<?= $size_type ?>">
            <small class="text-danger"><?= $size_type_err ?></small>
        </div>
    </div>

    <div class="form-group">
        <label for="brandId">Brand</label>
        <select id="brandId" name="brandId" class="form-control" required>
            <option value>Choose brand...</option>
            <?php
            $brands = Brand::getAll($pdo);
            foreach ($brands as $brand) :
            ?>
                <?php if ($brand->brandid == $brand_id) : ?>
                    <option value="<?= $brand->brandid ?>" selected><?= $brand->brandname ?></option>
                <?php else : ?>
                    <option value="<?= $brand->brandid ?>"><?= $brand->brandname ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
        <small class="text-danger"><?= $brand_id_err ?></small>
    </div>

    <div class="form-group">
        <label for="categoryId">Category</label>
        <select id="categoryId" name="categoryId" class="form-control" required>
            <option value>Choose category...</option>
            <?php
            $categories = Category::getAll($pdo);
            foreach ($categories as $category) :
            ?>
                <?php if ($category->categoryid == $category_id) : ?>
                    <option value="<?= $category->categoryid ?>" selected><?= $category->categoryname . ' - ' . $category->categorysubname ?></option>
                <?php else : ?>
                    <option value="<?= $category->categoryid ?>"><?= $category->categoryname . ' - ' . $category->categorysubname ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
        <small class="text-danger"><?= $category_id_err ?></small>
    </div>

    <button type="submit" class="btn btn-primary">Update Product</button>
</form>

<div class="mx-5">
    <a href="./index.php">Back to List</a>
</div>

<?php include_once '../includes/footer.php'; ?>
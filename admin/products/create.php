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

$product_name = '';
$price = 0;
$discount = 0;
$short_description = '';
$description = '';
$gender = 0;
$size_type = '';
$brand_id = '';
$category_id = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = $_POST['productName'];
    $price = $_POST['price'];
    $discount = $_POST['discount'];
    $short_description = $_POST['shortDescription'];
    $description = $_POST['description'];
    $size_type = $_POST['sizeType'];
    $brand_id = $_POST['brandId'];
    $category_id = $_POST['categoryId'];
    $gender = $_POST['gender'];

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

    if($gender == null){
        $gender_err = 'Gender is required';
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
        $product = new Product();
        $product->productname = $product_name;
        $product->price = $price;
        $product->discount = $discount;
        $product->shortdescription = $short_description;
        $product->description = $description;
        $product->gender = $gender;
        $product->sizetype = $size_type;
        $product->brandid = $brand_id;
        $product->categoryid = $category_id;
        $err_msg = $product->create($pdo);
        if(!$err_msg){
            header('Location: ./index.php');
            exit();
        }
    }
}

$title = "Add New Product";
require_once '../includes/header.php';
?>

<h2>Create new product</h2>
<small class="text-danger"><?= $err_msg ?></small>
<form method="post" class="mx-5">
    <div class="form-group">
        <label for="productName">Product Name</label>
        <input type="text" id="productName" name="productName" class="form-control" required value="<?= $product_name ?>">
        <small class="text-danger"><?= $product_name_err ?></small>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="price">Price</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                </div>
                <input type="number" id="price" name="price" class="form-control" step="1.0" required value="<?= $price ?>">
            </div>
            <small class="text-danger"><?= $price_err ?></small>
        </div>

        <div class="form-group col-md-6">
            <label for="discount">Discount</label>
            <div class="input-group">
                <input type="number" id="discount" name="discount" class="form-control" step="1.0" required value="<?= $discount ?>">
                <div class="input-group-append">
                    <span class="input-group-text">%</span>
                </div>
            </div>
            <small class="text-danger"><?= $discount_err ?></small>
        </div>
    </div>

    <div class="form-group">
        <label for="shortDescription">Short Description</label>
        <textarea id="shortDescription" name="shortDescription" class="form-control" required><?= $short_description ?></textarea>
        <small class="text-danger"><?= $short_description_err ?></small>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" name="description" class="form-control" required><?= $description ?></textarea>
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

    <button type="submit" class="btn btn-primary">Create</button>
</form>

<div class="mx-5">
    <a href="index.php">Back to List</a>
</div>
<?php
include_once '../includes/footer.php';
?>
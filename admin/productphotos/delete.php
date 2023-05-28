<?php
require_once '../includes/init.php';
$err_msg = '';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $productphotoid = $_POST['productphotoid'];
    $productphoto = ProductPhoto::getById($pdo, $productphotoid);
    if($productphoto->delete($pdo)){
        header('Location: ./index.php?id='.$productphoto->productid.'&color='.$productphoto->color);
        exit();
    }else{
        $err_msg = 'Error deleting product photo';
    }
}
$productphotoid = $_GET['id'];
$productphoto = ProductPhoto::getById($pdo, $productphotoid);
if (!$productphoto) {
    header('Location: ./index.php');
}
$title = 'Product Photos Management';
require_once '../includes/header.php';
?>
<center>
    <h1>Product Photos Management</h1>
</center>
<small class="text-danger"><?= $err_msg; ?></small>
<h3>Are you sure you want to delete this?</h3>
<hr />
<dl class="dl-horizontal">
    <dt>Product name</dt>
    <dd><?= Product::getById($pdo, $productphoto->productid)->productname; ?></dd>
    <dt>Color</dt>
    <dd><?= $productphoto->color; ?></dd>
    <dt>Photo</dt>
    <dd>
        <img src="<?= '../../' . $productphoto->imagepath; ?>" alt="<?= $productphoto->imagepath; ?>" class="figure-img" style="max-width: 15vw" />
    </dd>
</dl>

<form method="post">
    <input type="hidden" name="productphotoid" value="<?= $productphotoid; ?>">
    <div class="form-group">
        <input type="submit" value="Delete" class="btn btn-danger">
        <a href="./index.php?id=<?= $productphoto->productid; ?>&color=<?= $productphoto->color; ?>" class="btn btn-secondary">Back to Product Photos Management</a>
    </div>
</form>
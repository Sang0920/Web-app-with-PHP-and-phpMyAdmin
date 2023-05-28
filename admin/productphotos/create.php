<?php
require '../includes/init.php';
$err_msg = '';
$productid_err = '';
$color_err = '';
$imagepath_err = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productid = $_POST['productid'];
    $color = $_POST['color'];

    if (empty($productid)) {
        $productid_err = 'Please choose a product';
    }

    if (empty($color)) {
        $color_err = 'Please choose a color';
    }
    try {
        if (empty($_FILES['_image'])) {
            $imagepath_err = 'Please choose an image';
        }
        switch ($_FILES['_image']['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                throw new Exception('No file uploaded');
            case UPLOAD_ERR_FORM_SIZE:
                throw new Exception('Exceeded filesize limit');
            default:
                throw new Exception('Unknown errors');
        }

        $_20MB = 20 * 1024 * 1024;
        if ($_FILES['_image']['size'] > $_20MB) {
            throw new Exception('Exceeded filesize limit');
        }

        $file_info = new finfo(FILEINFO_MIME_TYPE);
        $mime_type = $file_info->file($_FILES['_image']['tmp_name']);

        $mime_types = ['image/gif', 'image/png', 'image/jpeg', 'image/jpg', 'image/bmp', 'image/webp', 'image/tiff'];
        if (!in_array($mime_type, $mime_types)) {
            throw new Exception('Invalid file type');
        }

        $pathinfo = pathinfo($_FILES['_image']['name']);
        $file_extension = $pathinfo['extension'];
        $file_name = uniqid() . '.' . $file_extension;
        $destination = "../../photos/products/{$file_name}";
        $_image_path = "/photos/products/{$file_name}";
        if (!move_uploaded_file($_FILES['_image']['tmp_name'], $destination)) {
            throw new Exception('File could not be uploaded');
        }
    } catch (Exception $ex) {
        $imagepath_err = $ex->getMessage();
    }

    if (empty($productid_err) && empty($color_err) && empty($imagepath_err)) {
        $productphoto = new ProductPhoto();
        $productphoto->productid = $productid;
        $productphoto->color = $color;
        $productphoto->imagepath = $_image_path;
        if ($productphoto->create($pdo)) {
            header('Location: ./index.php?id=' . $productid.'&color='.$color);
        } else {
            $err_msg = 'Error creating product photo';
        }
    }
}

$productid = $_GET['id'];
$color = $_GET['color'];
$products = Product::getAll($pdo);
$colors = ProductColor::getAll($pdo, $productid);
$title = 'Create Product Photo';
require_once '../includes/header.php';
?>

<h1>Create Product Photo</h1>
<small class="text-danger"><?= $err_msg; ?></small>
<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="productid">Product</label>
        <select name="productid" id="productid" class="form-control">
            <option value="">Choose a product</option>
            <?php foreach ($products as $item) : ?>
                <option value="<?= $item->productid; ?>" <?= $item->productid == $productid ? 'selected' : ''; ?>><?= $item->productname; ?></option>
            <?php endforeach; ?>
        </select>
        <small class="text-danger"><?= $productid_err; ?></small>
    </div>
    <div class="form-group">
        <label for="color">Color</label>
        <select name="color" id="color" class="form-control">
            <option value="">Choose a color</option>
            <?php foreach ($colors as $item) : ?>
                <option value="<?= $item->color; ?>" <?= $item->color == $color ? 'selected' : ''; ?>><?= $item->color; ?></option>
            <?php endforeach; ?>
        </select>
        <small class="text-danger"><?= $color_err; ?></small>
    </div>
    <div class="form-group">
        <label for="_image">Image</label>
        <input type="file" name="_image" id="_image" class="form-control" onchange="loadFile(event)">
        <small class=" text-danger"><?= $imagepath_err; ?></small>
    </div>
    <div class="form-group">
        <img src="" alt="" id="img_preview" style="max-width: 25vw">
    </div>
    <div class="form-group">
        <input type="submit" value="Create" class="btn btn-primary">
    </div>
</form>
<a href="./index.php?id=<?= $productid; ?>&color=<?= $color ?>" class="btn btn-secondary">Back to Product Photos Management</a>
<?php require_once '../includes/footer.php'; ?>
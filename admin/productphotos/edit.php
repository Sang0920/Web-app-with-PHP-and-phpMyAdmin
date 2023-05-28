<?php
require '../includes/init.php';
$err_msg = '';
$imagepath_err = '';

$productphotoid = $_GET['id'];
$productphoto = ProductPhoto::getById($pdo, $productphotoid);
$_image_path = $productphoto->imagepath;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productid = $_POST['productid'];
    $color = $_POST['color'];
    if (!empty($_FILES['_image'])) {
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

            unlink('../../' . $productphoto->imagepath);

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
    }
    if (empty($imagepath_err)) {
        $productphoto->imagepath = $_image_path;
        if ($productphoto->update($pdo)) {
            header('Location: ./index.php?id=' . $productphoto->productid . '&color=' . $productphoto->color);
        } else {
            $err_msg = 'Error creating product photo';
        }
    }
}

$title = 'Edit Product Photo';
require_once '../includes/header.php';
?>

<h1>Edit Product Photo</h1>
<small class="text-danger"><?= $err_msg; ?></small>
<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="productid">Product</label>
        <select name="productid" id="productid" class="form-control">
            <option>Choose a product</option>
            <option selected><?= Product::getById($pdo, $productphoto->productid)->productname; ?></option>
        </select>
    </div>
    <div class="form-group">
        <label for="color">Color</label>
        <select name="color" id="color" class="form-control">
            <option value="">Choose a color</option>
            <option selected><?= $productphoto->color; ?></option>
        </select>
    </div>
    <div class="form-group">
        <label for="_image">Image</label>
        <input type="file" name="_image" id="_image" class="form-control" onchange="loadFile(event)">
        <small class="text-danger"><?= $imagepath_err; ?></small>
    </div>
    <div class="form-group">
        <img src="<?= '../../' . $productphoto->imagepath ?>" alt="" id="img_preview" style="max-width: 25vw">
    </div>
    <div class="form-group">
        <input type="submit" value="Update" class="btn btn-primary">
    </div>
</form>
<a href="./index.php?id=<?= $productid; ?>&color=<?= $color ?>" class="btn btn-secondary">Back to Product Photos Management</a>
<?php require_once '../includes/footer.php'; ?>
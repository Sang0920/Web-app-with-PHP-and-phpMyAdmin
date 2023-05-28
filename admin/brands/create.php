<?php
require_once "../includes/init.php";

$brand_name_err = "";
$brand_image_err = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $brand_name = $_POST['brand_name'];
    $brand_image = $_FILES['brand_image'];

    if (empty($brand_name)) {
        $brand_name_err = "Brand name is required";
    }

    try {
        if (empty($_FILES['brand_image'])) {
            $brand_image_err = "Brand image is required";
        }
        switch ($_FILES['brand_image']['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                throw new Exception('No file uploaded');
            case UPLOAD_ERR_FORM_SIZE:
                throw new Exception('Exceeded filesize limit');
            default:
                throw new Exception('Unknown errors');
        }

        $_3MB = 3 * 1024 * 1024;
        if ($_FILES['brand_image']['size'] > $_3MB) {
            throw new Exception('Exceeded filesize limit');
        }

        $file_info = new finfo(FILEINFO_MIME_TYPE);
        $mime_type = $file_info->file($_FILES['brand_image']['tmp_name']);

        $mime_types = ['image/gif', 'image/png', 'image/jpeg', 'image/jpg', 'image/bmp', 'image/webp', 'image/tiff'];
        if (!in_array($mime_type, $mime_types)) {
            throw new Exception('Invalid file type');
        }

        $pathinfo = pathinfo($_FILES['brand_image']['name']);
        $file_extension = $pathinfo['extension'];
        $file_name = uniqid() . '.' . $file_extension;
        $destination = "../../photos/brands/{$file_name}";
        $brand_image_path = "/photos/brands/{$file_name}";
        if (!move_uploaded_file($_FILES['brand_image']['tmp_name'], $destination)) {
            throw new Exception('File could not be uploaded');
        }
    } catch (Exception $ex) {
        $brand_image_err = $ex->getMessage();
    }

    if (empty($brand_name_err) && empty($brand_image_err)) {
        try {
            $brand = new Brand();
            $brand->brandname = $brand_name;
            $brand->brandimagepath = $brand_image_path;
            if(!$brand->create($pdo)){
                throw new Exception('Brand could not be created');
            }
            header("Location: ./index.php");
            exit();
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
}

$title = "Create new brand";
require_once "../includes/header.php";
?>

<h2>Create</h2>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="brand_name">Brand name</label>
        <input type="text" name="brand_name" id="brand_name" class="form-control" placeholder="Brand name" aria-describedby="helpId">
        <small id="vadiation" class="text-danger"><?= $brand_name_err ?></small>
    </div>
    <div class="form-group">
        <label for="brand_image">Brand image</label>
        <input type="file" name="brand_image" id="brand_image" class="form-control" placeholder="Brand image" aria-describedby="helpId" accept=".png, .jpg, .jpeg, .gif, .tiff, .web, .bmp">
        <small id="vadiation" class="text-danger"><?= $brand_image_err ?></small>
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>

<div>
    <a href="./index.php">Back to List</a>
</div>
<?php include_once "../includes/footer.php"; ?>
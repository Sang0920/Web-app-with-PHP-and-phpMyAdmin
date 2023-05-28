<?php
require_once '../includes/init.php';

$brand = Brand::getById($pdo, $_GET['id']);
if (!$brand) {
    header('location: ./index.php');
    exit();
}

$img_src = '../../' . $brand->brandimagepath;
$brand_name_err = "";
$brand_image_err = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $brand_name = $_POST['brand_name'];
    $brand_image = $_FILES['brand_image'];
    $brand_image_path = $brand->brandimagepath;

    if (empty($brand_name)) {
        $brand_name_err = "Brand name is required";
    }

    if (!empty($_FILES['brand_image'])) {
        try {
            switch ($_FILES['brand_image']['error']) {
                case UPLOAD_ERR_OK:
                    break;
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

            unlink('../../' . $brand->brandimagepath);

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
    }

    if (empty($brand_name_err) && empty($brand_image_err)) {
        try {
            $brand = new Brand();
            $brand->brandid = $_GET['id'];
            $brand->brandname = $brand_name;
            $brand->brandimagepath = $brand_image_path;
            if ($brand->update($pdo)) {
                header('location: ./index.php');
                exit();
            } else {
                throw new Exception('Brand could not be updated');
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
}

$title = 'Edit Brand';
require_once '../includes/header.php';
?>

<h2>Edit</h2>
<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="brand_name">Brand name</label>
        <input type="text" name="brand_name" id="brand_name" class="form-control" placeholder="Brand name" aria-describedby="helpId" value="<?= $brand->brandname ?>">
        <small id="vadiation" class="text-danger"><?= $brand_name_err ?></small>
    </div>
    <div class="form-group">
        <label for="brand_image">Brand image</label>
        <input type="file" name="brand_image" id="brand_image" class="form-control" placeholder="Brand image" aria-describedby="helpId" accept=".png, .jpg, .jpeg, .gif, .webp" onchange="loadFile(event)">
        <img id="img_preview" src="<?= $img_src ?>" alt="<?= $brand->name ?>" class="figure-img" style="max-width: 15vw" />
        <small id="vadiation" class="text-danger"><?= $brand_image_err ?></small>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<div>
    <a href="./index.php">Back to list</a>
</div>
<?php include_once "../includes/footer.php"; ?>
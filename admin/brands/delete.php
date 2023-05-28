<?php
require_once "../includes/init.php";
$brand = Brand::getById($pdo, $_GET['id']);
if (!$brand) {
    header('location: ./index.php');
    exit();
}
$err_msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $brand_id = $_POST['brand_id'];
    $brand_image_path = $brand->brandimagepath;
    unlink('../../' . $brand->brandimagepath);
    if (!$brand->delete($pdo)) {
        $err_msg = "Error deleting brand";
    } else {
        // echo '<script>alert("Brand deleted successfully")</script>';
        header('location: ./index.php');
        exit();
    }
}
$title = "Delete brand";
require_once "../includes/header.php";

?>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Delete</h2>
                    <small class="text-danger"><?= $err_msg ?></small>
                    <h3 class="card-subtitle mb-3 text-danger text-center">Are you sure you want to delete this?</h3>

                    <div class="brand-details">
                        <h4 class="text-center">Brand</h4>
                        <hr />
                        <dl class="row">
                            <dt class="col-sm-4">Brand ID</dt>
                            <dd class="col-sm-8"><?= $brand->brandid; ?></dd>

                            <dt class="col-sm-4">Brand Name</dt>
                            <dd class="col-sm-8"><?= $brand->brandname; ?></dd>

                            <dt class="col-sm-4">Brand Image</dt>
                            <dd class="col-sm-8">
                                <?php
                                $image_info = getimagesize('../../' . $brand->brandimagepath);
                                $ratio = $image_info[0] / $image_info[1];
                                $width = 100;
                                $height = 100 / $ratio;
                                ?>
                                <img src="<?= '../../' . $brand->brandimagepath; ?>" alt="<?= $brand->brandname; ?>" width="<?= $width ?>" height="<?= $height ?>" class="img-fluid">
                            </dd>
                        </dl>
                    </div>

                    <form method="post">
                        <input type="hidden" name="brand_id" value="<?= $brand->brandid; ?>">
                        <div class="form-actions no-color text-center">
                            <input type="submit" value="Delete" class="btn btn-danger" />
                            <a href="./index.php" class="btn btn-secondary">Back to List</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once "../includes/footer.php"; ?>
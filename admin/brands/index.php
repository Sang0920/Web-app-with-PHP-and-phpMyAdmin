<?php
require_once '../includes/init.php';
$title = 'Brands Management';
require_once '../includes/header.php';
$brands = Brand::getAll($pdo);
?>

<center>
    <h1>Brands Management</h1>
</center>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="./create.php" class="btn btn-primary">Add New Brand</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table id="brandsTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Brand ID</th>
                        <th>Brand Name</th>
                        <th>Brand Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($brands as $brand) : ?>
                        <tr>
                            <td><?= $brand->brandid; ?></td>
                            <td><?= $brand->brandname; ?></td>
                            <?php
                            $image_info = getimagesize('../../' . $brand->brandimagepath);
                            $ratio = $image_info[0] / $image_info[1];
                            $width = 100;
                            $height = 100 / $ratio;
                            ?>
                            <td><img src="<?= '../../' . $brand->brandimagepath; ?>" alt="<?= $brand->brandname; ?>" width="<?= $width ?>" height="<?= $height ?>"></td>
                            <td>
                                <a href="edit.php?id=<?= $brand->brandid; ?>" class="btn btn-warning">Edit</a>
                                <a href="delete.php?id=<?= $brand->brandid; ?>&action=delete" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include_once "../includes/footer.php"; ?>
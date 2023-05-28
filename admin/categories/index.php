<?php
require_once '../includes/init.php';
$title = 'Categories Management';
require_once '../includes/header.php';
$categories = Category::getAll($pdo);
?>
<center>
    <h1>Categories Management</h1>
</center>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="./create.php" class="btn btn-primary">Add New Category</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table id="categoriesTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Category ID</th>
                        <th>Category Name</th>
                        <th>Category Subname</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category) : ?>
                        <tr>
                            <td><?= $category->categoryid; ?></td>
                            <td><?= $category->categoryname; ?></td>
                            <td><?= $category->categorysubname; ?></td>
                            <td>
                                <a href="edit.php?id=<?= $category->categoryid; ?>" class="btn btn-warning">Edit</a>
                                <a href="delete.php?id=<?= $category->categoryid; ?>&action=delete" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
include_once '../includes/footer.php';
?>
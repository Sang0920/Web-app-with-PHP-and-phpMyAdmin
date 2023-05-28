<?php
require_once '../includes/init.php';
$category = Category::getById($pdo, $_GET['id']);
if(!$category) {
    header('Location: ./index.php');
}
$err_msg = "";
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_id = $_POST['category_id'];
    if(!$category->delete($pdo)) {
        $err_msg = "Error deleting category";
    } else {
        // echo '<script>alert("Category deleted successfully")</script>';
        header('Location: ./index.php');
        exit();
    }
}
$title = "Delete category";
require_once "../includes/header.php";
?>
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2 class="text-center">Delete</h2>
            <small class="text-danger"><?= $err_msg ?></small>
            <h3 class="text-danger text-center">Are you sure you want to delete this?</h3>
            <div class="category-details">
                <h4 class="text-center">Category</h4>
                <hr />
                <dl class="row">
                    <dt class="col-sm-4">Category ID</dt>
                    <dd class="col-sm-8"><?= $category->categoryid; ?></dd>
                    <dt class="col-sm-4">Category Name</dt>
                    <dd class="col-sm-8"><?= $category->categoryname; ?></dd>
                    <dt class="col-sm-4">Category Subname</dt>
                    <dd class="col-sm-8"><?= $category->categorysubname; ?></dd>
                </dl>
            </div>
            <form method="post">
                <input type="hidden" name="category_id" value="<?= $category->categoryid; ?>">
                <div class="form-actions no-color text-center">
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <a href="./index.php" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include_once "../includes/footer.php"; ?>
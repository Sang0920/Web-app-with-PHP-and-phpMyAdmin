<?php
require_once '../includes/init.php';
$category = Category::getById($pdo, $_GET['id']);
if(!$category) {
    header('Location: ./index.php');
}
$category_name_err = "";
$category_subname_err = "";
$category_err = "";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_name = $_POST['category_name'];
    $category_subname = $_POST['category_subname'];

    if(empty($category_name)) {
        $category_name_err = "Category name is required";
    }

    if(empty($category_subname)) {
        $category_subname_err = "Category subname is required";
    }

    if(empty($category_name_err) && empty($category_subname_err)) {
        try {
            $category->categoryname = $category_name;
            $category->categorysubname = $category_subname;
            if(!$category->update($pdo)) {
                throw new Exception('Category could not be updated');
            }
            header('Location: ./index.php');
        } catch(Exception $ex) {
            $category_err = $ex->getMessage();
        }
    }
}

$title = 'Edit Category';
require_once '../includes/header.php';
?>

<center>
    <h1>Edit Category</h1>
</center>
<small class="text-danger"><?= $category_err; ?></small>
<form method="post">
    <div class="form-group">
        <label for="category_name">Category Name</label>
        <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Enter category name" value="<?= $category->categoryname; ?>">
        <span class="text-danger"><?= $category_name_err; ?></span>
    </div>
    <div class="form-group">
        <label for="category_subname">Category Subname</label>
        <input type="text" class="form-control" id="category_subname" name="category_subname" placeholder="Enter category subname" value="<?= $category->categorysubname; ?>">
        <span class="text-danger"><?= $category_subname_err; ?></span>
    </div>
    <button type="submit" class="btn btn-primary">Edit Category</button>
    <span class="text-danger"><?= $category_err; ?></span>
</form>
<?php include_once "../includes/footer.php"; ?>
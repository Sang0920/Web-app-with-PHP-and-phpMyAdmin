<?php
require_once '../includes/init.php';
$products = Product::getAll($pdo);
$title = 'Products';
require_once '../includes/header.php';
?>
<h2>All products</h2>
<p><a href="./create.php" class="btn btn-primary">Create New Product</a></p>
<table class="table">
    <tr>
        <th>Id</th>
        <th>Product Name</th>
        <th>Price</th>
        <th>Actions</th>
        <th>Notes</th>
    </tr>

    <?php foreach ($products as $product) : ?>
        <tr>
            <td><?=$product->productid ?></td>
            <td><?= $product->productname; ?></td>
            <td><?= $product->price ?>
                <span>$</span>
            </td>
            <td>
                <a href="edit.php?id=<?= $product->productid; ?>">Edit</a> |
                <a href="details.php?id=<?= $product->productid; ?>">Details</a> |
                <a href="delete.php?id=<?= $product->productid; ?>">Delete</a> |
                <a href="../productcolors?productid=<?= $product->productid; ?>">View Colors</a>
            </td>
            <td></td>
        </tr>
    <?php endforeach; ?>
</table>
<?php include_once '../includes/footer.php'; ?>
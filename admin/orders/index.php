<?php
require_once '../includes/init.php';
$id = isset($_GET['id']) ? $_GET['id'] : null;
$action = isset($_GET['action']) ? $_GET['action'] : null;
if ($action == 'deliver') {
    $cart = Cart::getById($pdo, $id);
    $cart->isdelivered = 1;
    $cart->update($pdo);
    header('Location: index.php');
} elseif ($action == 'undo') {
    $cart = Cart::getById($pdo, $id);
    $cart->isdelivered = 0;
    $cart->update($pdo);
    header('Location: index.php');
} elseif ($action == 'delete') {
    $cart = Cart::getById($pdo, $id);
    $cart->delete($pdo);
    header('Location: index.php');
}
$title = 'Orders Management';
require_once '../includes/header.php';
$orders = Cart::getAllByIsCheckout($pdo, 1);
?>
<center>
    <h1>Orders Management</h1>
</center>
<table class="table">
    <tr>
        <th>
            Order ID
        </th>
        <th>
            Product Name
        </th>
        <th>
            Username
        </th>
        <th>
            Quantity
        </th>
        <th>
            Is Checked Out
        </th>
        <th>
            Done
        </th>
        <th></th>
    </tr>
    <?php foreach ($orders as $order) :
        $productsize = ProductSize::getById($pdo, $order->productsizeid);
    ?>
        <tr>
            <td>
                <?= $order->cartid; ?>
            </td>
            <td>
                <?= Product::getById($pdo, $productsize->productid)->productname; ?>
            </td>
            <td>
                <?= User::getById($pdo, $order->userid)->username ?>
            </td>
            <td>
                <?= $order->qty; ?>
            </td>
            <td>
                <?= $order->ischeckout; ?>
            </td>
            <td>
                <?= $order->isdelivered; ?>
            </td>
            <td>
                <a href="./index.php?id=<?= $order->cartid . '&action=deliver'; ?>" class="btn btn-success">Delivered</a>
                <a href="./index.php?id=<?= $order->cartid . '&action=undo'; ?>" class="btn btn-warning">Undo</a>
                <a href="./index.php?id=<?= $order->cartid . '&action=delete'; ?>" class="btn btn-danger">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
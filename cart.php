<?php
require_once './includes/init.php';
$id = isset($_GET['id']) ? $_GET['id'] :null;
$action = isset($_GET['action']) ? $_GET['action'] :null;
if ($action == 'delete' && $id != null) {
    $cart = Cart::getById($pdo, $id);
    var_dump($cart);
    if ($cart->delete($pdo)) {
        echo "<script>alert('Deleted successfully')</script>";
        header('Location: cart.php');
    }
}
$user = $_COOKIE['user'];
$user = unserialize($user);
$cartitems = Cart::getCart($pdo, User::getUserByUsername($pdo, $user->username)->id);
$title = 'Cart';
require_once './includes/header.php';
?>

<h2 style="margin-top:15vh">Your cart</h2>

<table class="table fs-3">
    <tr class="fs-3">
        <th>
            Name
        </th>
        <th>
            Size
        </th>
        <th>
            Color
        </th>
        <th>Actions</th>
    </tr>

    <?php
    foreach ($cartitems as $item) :
        $productsize = ProductSize::getById($pdo, $item->productsizeid);
    ?>
        <?php if ($item->ischeckout == 0) : ?>
            <tr>
                <td class="fs-3">
                    <?= Product::getById($pdo, $productsize->productid)->productname ?>
                </td>
                <td class="fs-3">
                    <?= $productsize->size ?>
                </td>
                <td class="fs-3">
                    <?= $productsize->color ?>
                </td>
                <td class="fs-3">
                    <a class="fs-3" href="./checkout.php?id=<?= $item->cartid ?>">Checkout</a> |
                    <a class="fs-3" href="./cart.php?id=<?= $item->cartid . '&action=delete' ?>">Delete</a>
                </td>
            </tr>
        <?php endif; ?>
    <?php endforeach; ?>

</table>

<h2>Shipping</h2>
<h5>Your order(s) is being delivered</h5>

<table class="table fs-3">
    <tr class="fs-3">
        <th>
            Name
        </th>
        <th>
            Size
        </th>
        <th>
            Color
        </th>
        <th>
            Quantity
        </th>
    </tr>

    <?php foreach ($cartitems as $item) : ?>
        <?php if ($item->ischeckout == 1 && $item->isdelivered == 0) :
            $productsize = ProductSize::getById($pdo, $item->productsizeid);
        ?>
            <tr>
                <td>
                    <?= Product::getById($pdo, $productsize->productid)->productname ?>
                </td>
                <td>
                    <?= $productsize->size ?>
                </td>
                <td>
                    <?= $productsize->color ?>
                </td>
                <td>
                    <?= $item->qty ?>
                </td>
            </tr>
        <?php endif; ?>
    <?php endforeach; ?>

</table>

<h2>Your payment history</h2>
<table class="table fs-3">
    <tr class="fs-3">
        <th>
            Name
        </th>
        <th>
            Size
        </th>
        <th>
            Color
        </th>
        <th>
            Quantity
        </th>
    </tr>

    <?php foreach ($cartitems as $item) : ?>
        <?php if ($item->isdelivered == 1) :
            $productsize = ProductSize::getById($pdo, $item->productsizeid);
        ?>
            <tr>
                <td>
                    <?= Product::getById($pdo, $productsize->productid)->productname ?>
                </td>
                <td>
                    <?= $productsize->size ?>
                </td>
                <td>
                    <?= $productsize->color ?>
                </td>
                <td>
                    <?= $item->qty ?>
                </td>
            </tr>
        <?php endif; ?>
    <?php endforeach; ?>
</table>

<?php
require_once './includes/footer.php';
?>
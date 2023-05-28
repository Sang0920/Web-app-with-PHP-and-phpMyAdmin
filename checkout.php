<?php
require_once './includes/init.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cart = Cart::getById($pdo, $_POST['cartid']);
    $cart->qty = $_POST['qty'];
    $cart->ischeckout = 1;
    if ($cart->update($pdo)) {
        Cart::decreaseProductSizeQty($pdo, $cart->productsizeid, $cart->qty);
        echo "<script>alert('Checkout successfully');</script>";
        header('location: cart.php');
        exit();
    } else {
        die('Something went wrong, can\'t checkout');
    }
}
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
$cart = Cart::getById($pdo, $id);
$title = 'Checkout';
require_once './includes/header.php';
?>
<h2 style="margin-top: 150px">Checkout</h2>

<form method="post">
    <input type="hidden" name="cartid" value="<?= $cart->cartid ?>">
    <table class="table fs-2">
        <tr class="fs-2">
            <th>
                Name
            </th>
            <th>
                Size
            </th>
            <th>
                Color
            </th>
            <th>Quantity</th>
        </tr>
        <tr>
            <td>
                <?php
                $productsize = ProductSize::getById($pdo, $cart->productsizeid);
                echo Product::getById($pdo, $productsize->productid)->productname ?>
            </td>
            <td>
                <?= $productsize->size ?>
            </td>
            <td>
                <?= $productsize->color ?>
            </td>
            <td>
                <input type="number" min="1" max="<?= $productsize->qty ?>" name="qty" value="<?= $cart->qty ?>" required step="1" />
            </td>
        </tr>
    </table>
    <fieldset for="address">
        <h1>Enter your address:</h1>
        <input type="text" name="" id="" class="fs-2" placeholder="Addres Line 1">
        <input type="text" name="" id="" class="fs-2" placeholder="Addres Line 2">
        <input type="text" name="" id="" class="fs-2" placeholder="Passcode">
        <input type="text" name="" id="" class="fs-2" placeholder="City">
    </fieldset>
    <fieldset for="payment" class="fs-2">
        <h1>Enter your payment details:</h1>
        <input type="text" placeholder="Name on card">
        <input type="text" placeholder="Card number">
        <input type="text" placeholder="MM/YY">
        <input type="text" placeholder="CVV">
    </fieldset>

    <input type="submit" class="fs-2 btn btn-outline-primary" value="Order" />
</form>

<?php include_once './includes/footer.php'; ?>
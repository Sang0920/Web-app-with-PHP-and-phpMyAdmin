<?php
require_once './includes/init.php';
$user = $_COOKIE['user'];
$user = unserialize($user);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cart = new Cart();
    $cart->userid = User::getUserByUsername($pdo, $user->username)->id;
    $cart->productsizeid = $_POST['size'];
    $cart->qty = 1;
    $cart->ischeckout = 0;
    $cart->isdelivered = 0;
    if ($cart->create($pdo)) {
        echo "<script>alert('Product added to cart');</script>";
    } else {
        die("Something went wrong, can't add product to cart");
    }
}
$productid = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
$color = isset($_GET['color']) ? $_GET['color'] : null;

$colors = ProductColor::getAllByProduct($pdo, $productid);
$color = isset($color) ? $color : $colors[0]->color;
$sizes = ProductSize::getAllByProductColor($pdo, $productid, $color);
$photos = ProductPhoto::getAllByProductColor($pdo, $productid, $color);
$product = Product::getById($pdo, $productid);
$title = "Product details";
include './includes/header.php';
?>

<h2 style="margin-top: 150px">Product details</h2>
<div class="container-fluid row" style="font-size:large">
    <div class="col-8 bg-info">
        <div class="container row">
            <?php foreach ($photos as $photo) : ?>
                <div class="col-sm-6 my-2">
                    <img src="<?= '.' . $photo->imagepath ?>" alt="<?= $product->productname ?>" class="card-img-top" />
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="col-4">
        <h3><?= $product->productname ?></h3>
        <h5><?= $product->shortdescription ?></h5>
        <fieldset>
            <legend>Choose color to display</legend>
            <?php foreach ($colors as $item) : ?>
                <div>
                    <input type="radio" id="color" name="color" value="<?= $item->color ?>" <?= $item->color == $color ? 'checked' : '' ?>>
                    <label for="scales"><?= $item->color ?></label>
                </div>
            <?php endforeach; ?>
        </fieldset>
        <p><?= $product->description ?></p>

        <?php if (isset($user->username)) : ?> <!-- if user is logged in -->
            <form method="post">
                <fieldset>
                    <legend>Choose your size</legend>
                    <?php foreach ($sizes as $item) : ?>
                        <?php if ($item->qty == 0) : ?>
                            <div>
                                <input type="radio" id="size" name="size" value="<?= $item->id ?>" disabled>
                                <label for="size"><?= $item->size ?> - <span class="text-info"><?= $item->qty ?> product left</span></label>
                            </div>
                        <?php else : ?>
                            <div>
                                <input type="radio" id="size" name="size" value="<?= $item->id ?>">
                                <label for="size"><?= $item->size ?> - <span class="text-info"><?= $item->qty ?> products left</span></label>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <input type="submit" value="Add to your cart" class="btn btn-default btn-outline-primary" disabled style="font-size:medium">
                    <script>
                        $(document).ready(function() {
                            $('input[name="size"]').change(function() {
                                $('input[type="submit"]').prop('disabled', false);
                            });
                        });
                    </script>
                </fieldset>
            </form>
        <?php else : ?>
            <fieldset>
                <legend>Choose your size</legend>
                <?php foreach ($sizes as $item) : ?>
                    <?php if ($item->qty == 0) : ?>
                        <div>
                            <input type="radio" id="size" name="size" value="<?= $item->id ?>" disabled>
                            <label for="size"><?= $item->size ?> - <span class="text-info"><?= $item->qty ?> product(s)</span></label>
                        </div>
                    <?php else : ?>
                        <div>
                            <input type="radio" id="size" name="size" value="<?= $item->id ?>" required>
                            <label for="size"><?= $item->size ?> - <span class="text-info"><?= $item->qty ?> product(s)</span></label>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </fieldset>
            <button class="btn btn-lg btn-outline-primary" id="login">Log in first to buy</button>
            <script>
                $(document).ready(function() {
                    $('#login').click(function() {
                        window.location.href = './login.php';
                    });
                });
            </script>
        <?php endif; ?>
    </div>
</div>
<input type="hidden" id="modelId" value="<?= $product->productid ?>" />
<script>
    $(document).ready(function() {
        $('input[name="color"]').change(function() {
            var productId = $('#modelId').val();
            var color = $(this).val();
            window.location.replace('./product.php?id=' + productId + '&color=' + color);
        });
    });
</script>
<?php
include './includes/footer.php';
?>
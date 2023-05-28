<?php
require './includes/init.php';
$WOMAN = 1;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$perPage = 3; // Number of products per page
isset($_GET['brands']) ? $_brands_ = $_GET['brands'] : $_brands_ = '';
isset($_GET['categories']) ? $_categories_ = $_GET['categories'] : $_categories_ = '';
isset($_GET['sortCol']) ? $_sortCol_ = $_GET['sortCol'] : $_sortCol_ = '';

$_brands_ = explode(',', $_brands_);
$_categories_ = explode(',', $_categories_);

if (count($_brands_) > 0 && $_brands_[0] != '') {
    $products = array();
    foreach ($_brands_ as $brand) {
        $products = array_merge($products, Product::getAllByBrand($pdo, Product::getAllByGender($pdo, $WOMAN), $brand));
    }
} else {
    $products = Product::getAllByGender($pdo, $WOMAN);
}

$ps = array();
if (count($_categories_) > 0 && $_categories_[0] != '') {
    foreach ($_categories_ as $category) {
        $ps = array_merge($ps, array_filter($products, function ($product) use ($category) {
            return $product->categoryid == $category;
        }));
    }
    $products = $ps;
}

if ($_sortCol_ == 'name') {
    usort($products, function ($a, $b) {
        return strcmp($a->productname, $b->productname);
    });
} else if ($_sortCol_ == 'price') {
    usort($products, function ($a, $b) {
        return $a->price - $b->price;
    });
}

$totalProducts = count($products);
$products = array_slice($products, ($page - 1) * $perPage, $perPage);

$brands = Brand::getAll($pdo);
$categories = Category::getAllByCategoryName($pdo, "Women");
$title = "Women products";
require './includes/header.php';
?>

<div class="row" style="margin-top: 155px">
    <div class="col-4 fs-3">
        <hr>
        <fieldset>
            <legend>Choose your brands</legend>
            <?php foreach ($brands as $item) : ?>
                <div>
                    <input type="checkbox" class="brand" name="<?= $item->brandname ?>" value="<?= $item->brandid ?>">
                    <label for="scales"><?= $item->brandname ?></label>
                </div>
            <?php endforeach; ?>
        </fieldset>
        <hr />
        <fieldset>
            <legend>Choose your categories</legend>
            <?php foreach ($categories as $item) : ?>
                <div>
                    <input type="checkbox" class="category" value="<?= $item->categoryid ?>">
                    <label for="scales"><?= $item->categoryname . ' - ' . $item->categorysubname; ?></label>
                </div>
            <?php endforeach; ?>
        </fieldset>
        <hr />
        <fieldset>
            <legend>Sort by</legend>
            <div>
                <input type="radio" id="sortCol" name="sortCol" value="name">
                <label for="scales">Name</label>
            </div>
            <div>
                <input type="radio" id="sortCol" name="sortCol" value="price">
                <label for="scales">Price</label>
            </div>
        </fieldset>
        <hr />
        <button class="btn btn-outline-primary submit fs-3">Go</button>
    </div>

    <div class="container col-8">
        <h2>Women's shoes</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4" id="products">
            <?php foreach ($products as $item) : ?>
                <div class="col">
                    <div class="card">
                        <img src="<?= '.' . $item->getFistImagePath($pdo) ?>" alt="<?= $item->productname ?>" class="card-img-top" />
                        <div class="card-body">
                            <h5 class="card-title fs-1"><?= $item->productname ?></h5>
                            <p class="card-text fs-4"><?= $item->shortdescription ?></p>
                            <p class="card-text fs-3"><?= number_format($item->price, 0, '', ',') ?>$</p>
                            <a class="btn btn-primary btn-lg shop" href="./product.php?id=<?= $item->productid ?>">Shop</a>
                            <?php if ($item->countColors($pdo) > 1) : ?>
                                <p class="fs-2"><?= $item->countColors($pdo) ?> Colors</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- Pagination -->
        <ul class="pagination justify-content-center mt-4">
            <?php
            $totalPages = ceil($totalProducts / $perPage);
            $prevPage = $page - 1;
            $nextPage = $page + 1;
            ?>
            <?php if ($page > 1) : ?>
                <li class="page-item">
                    <a class="page-link fs-3" href="?page=<?= $prevPage ?>">Previous</a>
                </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                    <a class="page-link fs-3" href="?page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($page < $totalPages) : ?>
                <li class="page-item">
                    <a class="page-link fs-3" href="?page=<?= $nextPage ?>">Next</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
    <?php require './includes/footer.php'; ?>
</div>

<script>
    $('button.submit').click(function() {
        var selectedBrands = $('input[class="brand"]:checked').map(function() {
            return $(this).val();
        }).get().join(',');
        var selectedCategories = $('input[class="category"]:checked').map(function() {
            return $(this).val();
        }).get().join(',');
        var sortCol = $('input[name="sortCol"]:checked').val();
        window.location.replace('./men.php?brands=' + selectedBrands + '&categories=' + selectedCategories + '&sortCol=' + sortCol);
    });

    $(document).ready(function() {
        $('.shop').on('click', function() {
            var itemId = $(this).attr('value');
            window.location.href = './product/?id=' + itemId;
        });
    });
</script>
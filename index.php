<?php
require_once './includes/init.php';
$title = 'Home';
require_once './includes/header.php';
?>

<section class="welcome-section" id="welcome-section">
    <h1>Hi there! Welcome to MyShoeShop Store!</h1>
</section>
<section id="featured">
    <h1>Featured</h1>
    <div class="container-2">
        <figure class="men">
            <a href="jordan.html" title="The latest Dunk & Air Jordan 1 Sneakers">
                <img src="./photos/nike-just-do-it.jpg" class="img-link">
            </a>
            <figcaption>
                <caption>The latest Dunk & Air Jordan 1 Sneakers</caption>
                <a href="jordan.html" title="Go to Jordan page" class="btn-link"><button>Shop</button></a>
            </figcaption>
        </figure>
        <figure class="women">
            <a href="women.html" title="Style to Inspire Dreamers">
                <img src="./photos/nike-just-do-it-2.jpg" class="img-link">
            </a>
            <figcaption>
                <caption>Style to Inspire Dreamers</caption>
                <a href="women.html" title="Go to Look of Play page" class="btn-link"><button>Shop</button></a>
            </figcaption>
        </figure>
    </div>
</section>
<section id="whats-hot">
    <h1>What's hot</h1>
    <div id="carouselExampleCaptions" class="carousel slide w-auto" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="5000">
                <img src="./photos/fw21-pw-sichona-blue-onsite-pdp-story-d_tcm207-743134.jpg" class="d-block w-100" alt="HUMANRACE SICHONA" width="70vw">
                <div class="carousel-caption">
                    <h5 class="fs-1">HUMANRACE SICHONA</h5>
                    <p class="fs-3 d-none d-md-block">Informed by Pharrell's vision. Inspired by the Dakota way of life. Created with the best of adidas innovation.</p>
                </div>
            </div>
            <div class="carousel-item" data-bs-interval="3000">
                <img src="./photos/lace-triple-black-phase-2-plc-mh-t_tcm207-888278.jpg" class="d-block w-100" alt="TRIPLE BLACK COLLECTION">
                <div class="carousel-caption">
                    <h5 class="fs-1">TRIPLE BLACK COLLECTION</h5>
                    <p class="fs-3 d-none d-md-block">Dark mode enabled</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="./photos/01-ss22-ivp-5-75-educate-cp-d_tcm207-884064.jpg" class="d-block w-100" alt="IVY PARK STAN SUMMER">
                <div class="carousel-caption">
                    <h5 class="fs-1">IVY PARK STAN SUMMER</h5>
                    <p class="fs-3 d-none d-md-block">Comming soon.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>
<section id="more">
    <h1>Who are you shopping for?</h1>
    <div class="container-3">
        <figure class="men">
            <a href="men.html" title="Men's">
                <img src="./photos/nike-just-do-it-men's.png" class="img-link">
            </a>
            <figcaption>
                <a href="men.html" title="Go to Men's page" class="btn-link"><button>Men's</button></a>
            </figcaption>
        </figure>
        <figure class="women">
            <a href="women.html" title="Women's">
                <img src="./photos/nike-just-do-it-women's.jpg" class="img-link">
            </a>
            <figcaption>
                <a href="women.html" title="Go to Women's page" class="btn-link"><button>Women's</button></a>
            </figcaption>
        </figure>
        <figure class="kids">
            <a href="kids.html" title="Kid's">
                <img src="./photos/dri-fit-tempo-older-printed-running-shorts-MCm2VW.jpg" class="img-link">
            </a>
            <figcaption>
                <a href="kids.html" title="Go to Kids' page" class="btn-link"><button>Kids'</button></a>
            </figcaption>
        </figure>
    </div>
</section>

<?php include_once './includes/footer.php'; ?>
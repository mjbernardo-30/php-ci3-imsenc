<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?= APP_NAME; ?> - The Product</title>
        <link rel="icon" type="image/x-icon" href="<?= ASSETS_URL; ?>img/favicon-2.png">
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,800">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.1/css/all.min.css" integrity="sha512-3M00D/rn8n+2ZVXBO9Hib0GKNpkm8MSUU/e2VNthDyBYxKWG+BftNYYcuEjXlyrSO637tidzMBXfE7sQm0INUg==" crossorigin="anonymous" />
        <link href="<?= ASSETS_URL; ?>css/custom-bootstrap.css" rel="stylesheet">
        <link href="<?= ASSETS_URL; ?>css/custom-style.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <style>
        span {
            font-size: 19px;
        }
    </style>
    <body id="page-top" style="border: 2px solid;">
        <nav id="navbar_top" class="navbar navbar-expand-sm navbar-light mr-auto home-nav">
            <a class="navbar-brand" href="<?= base_url(); ?>">
                <img src="<?= ASSETS_URL; ?>img/Logo-1-md1.png" alt="Emperador Brandy Logo" class="home-logo mx-auto d-block d-sm-block ml-3 w-75">
            </a>
            <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <i class="fas fa-fw fa-bars text-white"></i>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item px-3 mt-1 mb-1 mt-sm-0 mb-sm-0">
                        <a class="nav-link" href="<?= base_url(); ?>">Home</a>
                    </li>
                    <li class="nav-item px-3 mt-1 mb-1 mt-sm-0 mb-sm-0">
                        <a class="nav-link" href="<?= base_url(); ?>register">Register</a>
                    </li>
                    <li class="nav-item px-3 mt-1 mb-1 mt-sm-0 mb-sm-0">
                        <a class="nav-link" href="<?= base_url(); ?>how">How to Win</a>
                    </li>
                    <li class="nav-item px-3 mt-1 mb-1 mt-sm-0 mb-sm-0">
                        <a class="nav-link active" href="<?= base_url(); ?>product">The Product</a>
                    </li>
                    <li class="nav-item px-3 mt-1 mb-1 mt-sm-0 mb-sm-0">
                        <a class="nav-link" href="<?= base_url(); ?>faq">FAQs</a>
                    </li>
                </ul>
            </div>
        </nav>
        <section class="text-white default-long-bg font-weight-light">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-6 mt-5 mb-3">
                        <div class="row">
                            <div class="col-6 col-sm-8 font-weight-light text-right">
                                <h3><strong class="font-weight-bold">EMPERADOR</strong> ORIGINAL</h3>
                                <span>
                                    Our original classic, cherished throughout the years,
                                    derives its superb character from a delicate blending
                                    process and the solera system of aging. The result is
                                    a brandy of distinctive aroma, flavor, and consisently
                                    mellow quality - a timeless Filipino favorite.
                                </span> <br>
                                <img src="<?= ASSETS_URL; ?>img/shot.jpeg" alt="Emperador Original - Shot" class="img-fluid d-block ml-auto w-75">
                            </div>
                            <div class="col-6 col-sm-4">
                                <img src="<?= ASSETS_URL; ?>img/emp-orig.png" alt="Emperador Original" class="d-block img-fluid w-50">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 mt-5 mb-3">
                        <div class="row">
                            <div class="col-6 col-sm-4">
                                <img src="<?= ASSETS_URL; ?>img/emp-light.png" alt="Emperador Light" class="img-fluid d-block ml-auto w-50">
                            </div>
                            <div class="col-6 col-sm-8 font-weight-light text-left">
                                <h3><strong class="font-weight-bold">EMPERADOR</strong> LIGHT</h3>
                                <span>
                                    Meticulously blended premium brandy to attain an
                                    extra smooth character, full body, and notably
                                    distinctive aroma, boasting a bouquet of fruit and
                                    raising with hints of refreshing peach.
                                    The perfect partner to celebrate everyday success.
                                </span> <br>
                                <img src="<?= ASSETS_URL; ?>img/hand-shot.jpg" alt="Emperador Light - Shot" class="img-fluid d-block w-75">
                            </div>
                        </div>
                    </div>
                </div> <br>
                <div class="row text-white">
                    <div class="col-12 col-sm-12 mt-5 mb-2 text-center"><h2 class="font-weight-bold">ABOUT US</h2></div>
                    <div class="col-12 col-sm-8 mx-auto mt-2 mb-2 text-justify">
                        <span>
                            <strong>Emperador Inc. (EMI)</strong> is a renowned holding company, steering an integrated venture in manufacturing, bottling, and distributing premium distilled spirits across the globe. Under <strong>Emperador Distillers, Inc. (EDI), EMI</strong> has established itself as a producer of world-class spirits whose products refresh customers around the world, across its markets in over 100 countries.
                        </span> <br> <br>
                        <span>
                            This legacy of excellence extends to our commitment to education and creativity, exemplified by the Nationwide Univesity
                            Cocktail Showdown. Beyond the realms of brandy, this initiative empowers aspiring talents with scholarships, opening doors
                            to a world of possibilites.
                        </span> <br> <br>
                        <span>
                            Emperador's vision goes beyond crafting exceptional libations; it's about shaping a future where innovation,
                            education, and imagination converge. Cheers to a bold tomorrow with <strong>Emperador!</strong>
                        </span>
                    </div>
                </div>
                <div class="row vh-100">
                    <div class="col-12 col-sm-12 col-md-11 col-lg-10 col-xl-8 mx-auto my-auto">
                        <div class="row text-center text-white">
                            <div class="col-12 col-sm-12 mt-3 mb-3">
                                <h4>Stay connected</h4>
                                <h5>Follow us on our social media accounts to get even more tasty content.</h5>
                            </div>
                        </div>
                        <div class="row text-center text-white">
                            <div class="col-12 col-sm-4 mx-auto mt-3 mb-3">
                                <a href="https://www.facebook.com/emperadoracademy/" target="_blank" class="text-decoration-none text-white">
                                    <h5><i class="fab fa-fw fa-facebook-square"></i> @EmperadorAcademy</h5>
                                </a>
                            </div>
                            <div class="col-12 col-sm-4 mx-auto mt-3 mb-3">
                                <a href="https://www.instagram.com/emperadoracademy/" target="_blank" class="text-decoration-none text-white">
                                    <h5><i class="fab fa-fw fa-instagram"></i> @EmperadorAcademy</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row h-25">
                    <div class="col-12 col-sm-12 col-md-11 col-lg-10 col-xl-8 mx-auto my-auto">
                        <div class="row text-center text-white">
                            <div class="col-12 col-sm-12 mt-2">
                                <span>PER DOH-FDA-CFRR PERMIT NO. 1706 vs. 2023 <br> DRINK RESPONSIBLY <br> PROMO DURATION: JANUARY 15, 2024 - April 30, 2024 <br> ONLY FOR 18 YEARS OLD AND ABOVE</span>
                            </div>
                            <div class="col-12 col-sm-12 mt-2">
                                <span>COPYRIGHT EMPERADOR DISTILLERS, INC. 2024</span>
                            </div>
                        </div>
                        <hr class="w-75" style="height: 2px; border-width: 0; color: white; background-color: white;">
                        <div class="row text-center text-white">
                            <div class="col-12 col-sm-4 mt-3">
                                <a href="<?= BASE_URL(); ?>privacy" target="_blank" class="text-decoration-none text-white">
                                    PRIVACY POLICY
                                </a>
                            </div>
                            <div class="col-12 col-sm-4 mt-3">
                                <a href="<?= BASE_URL(); ?>terms" target="_blank" class="text-decoration-none text-white">
                                    TERMS & CONDITIONS
                                </a>
                            </div>
                            <div class="col-12 col-sm-4 mt-3">
                                <a href="#" class="text-decoration-none text-white">
                                    CONTACT US
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <br>
        </section>
    </body>
    <script>
        window.addEventListener("scroll", function () {
            if (window.scrollY > 50) {
                document.getElementById('navbar_top').classList.add('fixed-top');
                // add padding top to show content behind navbar
                navbar_height = document.querySelector('.navbar').offsetHeight;
                document.body.style.paddingTop = navbar_height + 'px';
            } else {
                document.getElementById('navbar_top').classList.remove('fixed-top');
                // remove padding top from body
                document.body.style.paddingTop = '0';
            } 
        }, false);
    </script>
</html>
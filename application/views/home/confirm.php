<?php
$minTime = strtotime("-18 year", time());
$minDate = date("Y-m-d", $minTime);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?= APP_NAME; ?> - Registration Confirmation</title>
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
        <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css' rel='stylesheet'>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    </head>
    <body id="page-top">
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
                        <a class="nav-link active" href="<?= base_url(); ?>register">Register</a>
                    </li>
                    <li class="nav-item px-3 mt-1 mb-1 mt-sm-0 mb-sm-0">
                        <a class="nav-link" href="<?= base_url(); ?>how">How to Win</a>
                    </li>
                    <li class="nav-item px-3 mt-1 mb-1 mt-sm-0 mb-sm-0">
                        <a class="nav-link" href="<?= base_url(); ?>product">The Product</a>
                    </li>
                    <li class="nav-item px-3 mt-1 mb-1 mt-sm-0 mb-sm-0">
                        <a class="nav-link" href="<?= base_url(); ?>faq">FAQs</a>
                    </li>
                </ul>
            </div>
        </nav>
        <section id="registration_container" class="register-bg vh-100">
            <div class="row h-100">
                <div class="col-11 col-sm-8 mx-auto my-auto">
                    <div class="card border-0 register-confirm-card">
                        <div class="card-body text-center">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 col-sm-10 mx-auto mt-5 mb-3">
                                        <h4>Thank you for joining the <br>Emperador's Nationwide University Cocktail Showdown!</h4>
                                    </div>
                                    <div class="col-12 col-sm-10 mx-auto mt-3 mb-3">
                                        <span>
                                            Your registration is now in our records. <br>
                                            Our team will verify your details, and we'll be reaching out to you shortly to <br>
                                            confirm your participation.
                                        </span>
                                    </div>
                                    <div class="col-12 col-sm-10 mx-auto mt-3 mb-3">
                                        <span class="text-italized">
                                            <i>Keep an eye on your inbox!</i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="stay_connected" class="home-bg-image-1-conn vh-100">
            <div class="row h-75">
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
        </section>
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
    </body>
</html>
<?php
$browser    = $this->agent->platform();
$homeBG     = "home-bg-image-3";
$homeBGTran = "home-bg-transparent";

if (strtolower($browser) == "ios") {
    /*$homeBG     = "home-bg-image-3-1";
    $homeBGTran = "home-bg-transparent-1";*/
}

$maxTime = strtotime("-18 year", time());
$minTime = strtotime("-75 year", time());
$maxYr = date("Y", $maxTime);
$minYr = date("Y", $minTime);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?= APP_NAME; ?></title>
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
        .home-bg-transparent-1 {
	        border-radius: 0px;
	        color: white;
	        letter-spacing: 1px;
        }

        .home-bg-image-3-1 {
            background-image: url("<?= ASSETS_URL; ?>img/BG-3.png");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            background-attachment: fixed;
        }
        
        .custom-home-register-btn {
            background-color: #000000;
            color: white;
            border-radius: 0px;
        }

        @media only screen and (max-width: 575px) {
            .stackedLogo {
                height: 87.5%;
            }
        }
    </style>
    <body id="page-top">
        <section id="age_gate" class="home-bg-image vh-100 d-none">
            <div class="row h-100">
                <div class="col-11 col-sm-6 mx-auto my-auto">
                    <div class="card border-0 register-confirm-card">
                        <div class="col-11 mx-auto col-sm-6 mt-5 mb-2">
                            <img src="<?= ASSETS_URL; ?>img/EMP-Academy.png" alt="Emperador Brandy Logo" class="w-100 img-fluid mx-auto d-block">
                        </div>
                        <div class="col-12 col-sm-8 mx-auto text-center mt-4 mb-3 text-white">
                            <span class="h3 font-weight-bold text-uppercase" id="gate_label">
                                ARE YOU OF LEGAL DRINKING AGE IN YOUR COUNTRY?
                            </span>
                        </div>
                        <div class="col-12 col-sm-5 mx-auto text-center mt-3 mb-3 text-white" id="form_container">
                            <div class="row">
                                <div class="col-5 col-sm-6 mx-auto mt-3 mb-3">
                                    <button type="button" class="btn btn-block btn-lg btn-outline-light" onclick="ConfirmAgeYes()">YES</button>
                                </div>
                                <div class="col-5 col-sm-6 mx-auto mt-3 mb-3">
                                    <button type="button" class="btn btn-block btn-lg btn-outline-light" onclick="ConfirmAgeNo()">NO</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div id="content_container" class="d-none">
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
                            <a class="nav-link active" href="<?= base_url(); ?>">Home</a>
                        </li>
                        <li class="nav-item px-3 mt-1 mb-1 mt-sm-0 mb-sm-0">
                            <a class="nav-link" href="<?= base_url(); ?>register">Register</a>
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
            <section class="home-bg-image vh-100">
                <div class="row h-100">
                    <div class="col-12 col-sm-6 text-center text-white">
                        <br>
                        <div class="col-12 mb-3 h-25 d-flex">
                            <img src="<?= ASSETS_URL; ?>img/EMP-Academy.png" alt="Emperador Academy" class="card-img-bottom w-75 mx-auto mt-auto">
                        </div>
                        <div class="col-12 mt-3 mb-3 h-75">
                            <img src="<?= ASSETS_URL; ?>img/HRM.png" alt="Emperador Academy - HRM Cocktail Contest" class="img-fluid mx-auto d-block" style="width: 90%;">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 ml-auto">
                        <div class="card h-100 bg-transparent border-0">
                            <div class="card-body text-center text-white">
                                <div class="col-12 col-sm-12 mt-5 mb-3">
                                    <label class="text-white font-weight-bold h1 d-sm-block d-none" style="letter-spacing: 2px;">GET A CHANCE TO</label>
                                    <label class="text-white font-weight-bold h3 d-block d-sm-none" style="letter-spacing: 2px;">GET A CHANCE TO</label>
                                    <img src="<?= ASSETS_URL; ?>img/WIN.png" alt="Emperador Academy - WIN" class="mx-auto d-block img-fluid" style="width: 90%;">
                                </div>
                                <div class="col-12 col-sm-12 mt-3 mb-4">
                                    <span class="h3 text-uppercase font-weight-bold">10 winners of P100,000 each</span>
                                </div>
                                <div class="col-12 col-sm-12 mt-4">
                                    <img src="<?= ASSETS_URL; ?>img/2bottle.png" alt="Emperador Bottles" class="mx-auto d-block img-fluid w-25">
                                </div>
                                <div class="row mb-3 text-center">
                                    <div class="col-6 col-sm-4 mx-auto">
                                        <a href="<?= base_url(); ?>register" class="text-decoration-none mx-auto">
                                            <button class="btn btn-block custom-home-register-btn mx-auto">REGISTER HERE</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="<?= $homeBG; ?>">
                <div class="row">
                    <div class="col-12">
                        <div class="card bg-transparent m-0 border-0 text-white">
                            <div class="card-body mt-3 mb-5">
                                <div class="container-fluid">
                                    <div class="col-12 col-sm-12 mt-3 mb-4"><h3 class="font-weight-bold text-warning">10 Winners will win P100,000 worth of scholarship each!</h3></div>
                                    <div class="col-12 col-sm-5 mt-4 mb-2">
                                        <span class="h5 font-weight-bold">
                                            Bring prestige to your school: Winning school will also receive P100,000 worth of scholarship each for another student of their choice. <br> <br>
                                            Inviting all HRM students aged 18 years old and above. Take part in the nationwide online cocktail competition by simply creating your own EMPERADOR cocktail video recipe online.
                                        </span>
                                    </div>
                                    <div class="col-12 col-sm-12 mt-2 mb-2">
                                        <div class="row">
                                            <div class="col-6 col-sm-2 mx-auto mt-2 mb-2 text-center">
                                                <img src="<?= ASSETS_URL; ?>img/icon-1.png" alt="Emperador Academy - Icons" class="mx-auto d-block img-fluid">
                                                <br>
                                                <span class="text-xs text-white text-uppercase font-weight-bold">1. Conceptualize</span>
                                            </div>
                                            <div class="col-6 col-sm-2 mx-auto mt-2 mb-2 text-center">
                                                <img src="<?= ASSETS_URL; ?>img/icon-2.png" alt="Emperador Academy - Icons" class="mx-auto d-block img-fluid">
                                                <br>
                                                <span class="text-xs text-white text-uppercase font-weight-bold">2. Shoot a Video</span>
                                            </div>
                                            <div class="col-6 col-sm-2 text-center mx-auto mt-2 mb-2">
                                                <img src="<?= ASSETS_URL; ?>img/icon-3.png" alt="Emperador Academy - Icons" class="mx-auto d-block img-fluid">
                                                <br>
                                                <span class="text-xs text-white text-uppercase font-weight-bold">3. Upload on Facebook</span>
                                            </div>
                                            <div class="col-6 col-sm-2 text-center mx-auto mt-2 mb-2">
                                                <img src="<?= ASSETS_URL; ?>img/icon-4.png" alt="Emperador Academy - Icons" class="mx-auto d-block img-fluid">
                                                <br>
                                                <span class="text-xs text-white text-uppercase font-weight-bold">4. Register at emperadoracademy.com</span>
                                            </div>
                                            <div class="col-6 col-sm-2 text-center mx-auto mt-2 mb-2">
                                                <img src="<?= ASSETS_URL; ?>img/icon-5.png" alt="Emperador Academy - Icons" class="mx-auto d-block img-fluid">
                                                <br>
                                                <span class="text-xs text-white text-uppercase font-weight-bold">5. Share your video</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-3 mt-2 mb-2">
                                        <a href="<?= base_url(); ?>register" class="text-decoration-none">
                                            <button class="btn btn-block btn-lg btn-outline-light">JOIN THE CONTEST NOW!</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="home-bg-image-1">
                <img src="<?= ASSETS_URL; ?>img/cocktails.png" alt="Emperador Academy - Cocktails" class="img-fluid mx-auto d-block">
                <div class="container">
                    <div class="row text-white">
                        <div class="col-12 col-sm-12 mt-5 mb-2 text-center"><h1 class="font-weight-bold">CONTEST MECHANICS</h1></div>
                        <div class="col-12 col-sm-12 mt-2 mb-2 font-weight-bold" style="font-size: 22px;">
                            <ul>
                                <li>Top 10 winners will win P100,000 worth of scholarship</li>
                                <li>Winning school will also receive of P100,000 worth of scholarship to another student of their choice.</li>
                                <li>Submission of entries starts on <u>January 15, 2024</u></li>
                                <li>Deadline of submission is on <u>April 30, 2024</u></li>
                                <li>Participants must create a video of their own mix using Emperador Light or Original with up to five (5) ingredients.</li>
                                <li>Record the whole process while you share the ingredients and explain the unique story about why you chose that cocktail mix. Upload your video on Facebook as a public post with our official hashtag and register on this website. You may check out the sample video reference here.</li>
                                <li>The participant must upload their official video entry to their own social media profile as public post (Facebook) and register through this site.</li>
                                <li>
                                    Criteria for Judging
                                    <ol style="list-style-type: lower-alpha;">
                                        <li>Story and storytelling behind the mix - 30 pts</li>
                                        <li>Ease of preparation - 20 pts</li>
                                        <li>Presentation - 30 pts</li>
                                        <li>Social media impact - 20 pts</li>
                                    </ol>
                                </li>
                            </ul>
                            <span>
                                Winners will be announced online through our social media pages. <br> <br>
                                Read the full details of the contest mechanics <a href="<?= base_url(); ?>how">here</a>.
                            </span>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="col-12 col-sm-9 mx-auto mt-3">
                        <div class="col-12 mt-3 mb-3"><label class="h5 text-white font-weight-bold">Sample Reference Video Entry</label></div>
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/pcuH3PZMPfo?rel=0" allowfullscreen></iframe>
                        </div>
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
                </div> <br>
            </section>
        </div>
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

        $(document).ready(function() {
            var x = sessionStorage.getItem("AgeConfirm");
            if (x != null) {
                document.getElementById('age_gate').classList.add('d-none');
                document.getElementById('content_container').classList.remove('d-none');
            } else {
                document.getElementById('age_gate').classList.remove('d-none');
                document.getElementById('content_container').classList.add('d-none');
            }
        });

        function ConfirmAge() {
            let minAge  = '<?= ELIGIBLE_AGE; ?>';
            var ageMM   = document.getElementById('ageMM').value;
            var ageDD   = document.getElementById('ageDD').value;
            var ageYY   = document.getElementById('ageYY').value;
            var dob     = ageYY + "-" + ageMM + "-" + ageDD;
            var convDOB = new Date(dob);

            var month_diff = Date.now() - convDOB.getTime();
            var age_dt = new Date(month_diff);
            var year = age_dt.getUTCFullYear();
            var age = Math.abs(year - 1970);

            if (age >= minAge) {
                var x = sessionStorage.getItem("AgeConfirm");
                if (x != null) {
                    sessionStorage.clear();
                    sessionStorage.setItem("AgeConfirm", true);
                } else {
                    sessionStorage.setItem("AgeConfirm", true);
                }

                document.getElementById('age_gate').classList.add('d-none');
                document.getElementById('content_container').classList.remove('d-none');
            } else {
                document.getElementById('form_container').classList.add('d-none');
                document.getElementById('gate_label').innerHTML = "You must be 18 years old and above to access this website.";
            }

            return false;
        }

        function ConfirmAgeYes() {
            document.getElementById('age_gate').classList.add('d-none');
            var x = sessionStorage.getItem("AgeConfirm");
            if (x != null) {
                sessionStorage.clear();
                sessionStorage.setItem("AgeConfirm", true);
            } else {
                sessionStorage.setItem("AgeConfirm", true);
            }
            document.getElementById('content_container').classList.remove('d-none');
        }

        function ConfirmAgeNo() {
            document.getElementById('form_container').classList.add('d-none');
            document.getElementById('gate_label').innerHTML = "You must be of legal drinking age to enter this site.";
        }

        function CalculateLength(value, id, event) {
            var input = document.getElementById(id).value;
            if (input.length >= value) {
                return event.preventDefault();
            }
        }
    </script>
</html>
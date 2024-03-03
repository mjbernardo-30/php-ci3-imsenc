<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?= APP_NAME; ?> - FAQs</title>
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
        li {
            margin-top: 1em;
            margin-bottom: 1em;
            font-size: 19px;
        }

        span {
            font-size: 20px;
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
                        <a class="nav-link" href="<?= base_url(); ?>product">The Product</a>
                    </li>
                    <li class="nav-item px-3 mt-1 mb-1 mt-sm-0 mb-sm-0">
                        <a class="nav-link active" href="<?= base_url(); ?>faq">FAQs</a>
                    </li>
                </ul>
            </div>
        </nav>
        <section class="text-white default-long-bg font-weight-light">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 mx-auto mt-5 mb-2">
                        <h4 class="m-0 font-weight-bold mb-2">Cheers to Victory:
                        </h4>
                        <span class="font-weight-light">Emperador's Nationwide University Cocktail Showdown</span>
                    </div>
                    <div class="col-12 col-sm-12 mt-2 mb-2">
                        <h4 class="m-0 font-weight-bold mb-2">FREQUENTLY-ASKED QUESTIONS</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-12 mt-2 mb-2">
                        <ol style="list-style-type:decimal;" class="font-weight-bold">
                            <li>
                                Who is eligible to participate in the competition?
                                <ul class="font-weight-light" style="list-style-type: none;">
                                    <li>Currently enrolled students in Hotel Management/Hotel Restaurant Management in any Philippine school, university, or college are eligible to join.</li>
                                </ul>
                            </li>
                            <li>
                                Can participants from other academic disciplines join?
                                <ul class="font-weight-light" style="list-style-type: none;">
                                    <li>No, the competition is exclusively open to currently enrolled students in Hotel Management/Hotel Restaurant Management. Other academic disciplines are not eligible.</li>
                                </ul>
                            </li>
                            <li>
                                How long should the video be, and what should it include?
                                <ul class="font-weight-light" style="list-style-type: none;">
                                    <li>The video should be a minimum of 30 seconds and a maximum of 5 minutes. Showcase your mixing prowess by narrating your mixing story, featuring Emperador Original or Emperador Light as the main mixing liquor. Highlight up to 5 ingredients and conclude with a winning shot of your final cocktail mix. Get creative and let your unique style shine!</li>
                                </ul>
                            </li>
                            <li>
                                Can participants from any location in the Philippines join?
                                <ul class="font-weight-light" style="list-style-type: none;">
                                    <li>Yes, students from any school, university, or college in the Philippines offering Hotel Management/Hotel Restaurant Management programs are welcome to participate.</li>
                                </ul>
                            </li>
                            <li>
                                Is there a registration fee to join the Emperador's Nationwide Cocktail Showdown?
                                <ul class="font-weight-light" style="list-style-type: none;">
                                    <li>No, participation is free for eligible students. No registration fee is required.</li>
                                </ul>
                            </li>
                            <li>
                                How long does the Emperador's Nationwide Cocktail Showdown contest run?
                                <ul class="font-weight-light" style="list-style-type: none;">
                                    <li>The contest spans 5 months, providing participants with ample time to craft, showcase, and celebrate their unique cocktail creations.</li>
                                </ul>
                            </li>
                            <li>
                                Where should participants upload their official video entry?
                                <ul class="font-weight-light" style="list-style-type: none;">
                                    <li>Participants are required to upload their official video entry as a public post on their social media profile on Facebook.</li>
                                </ul>
                            </li>
                            <li>
                                How do participants submit their video entry link during registration?
                                <ul class="font-weight-light" style="list-style-type: none;">
                                    <li>During the registration stage, participants will be prompted to provide the URL of their uploaded video entry on Facebook. Ensure the link is accurate to complete the submission process.</li>
                                </ul>
                            </li>
                            <li>
                                How will participants know if their video entry submission is successful?
                                <ul class="font-weight-light" style="list-style-type: none;">
                                    <li>Once the video entry is uploaded using the provided link, participants will receive a confirmation, indicating the successful submission of their complete official entry. This confirmation ensures that your entry is in the running for the competition.</li>
                                </ul>
                            </li>
                            <li>
                                How will participants be notified if they qualify for the semifinal round?
                                <ul class="font-weight-light" style="list-style-type: none;">
                                    <li>The Organizers of the Competition will contact the 30 qualified participants directly, informing them of their eligibility for the semifinal round. Additionally, the list of qualified semifinalists will be announced on the organizers' social channels, such as Facebook.</li>
                                </ul>
                            </li>
                            <li>
                                What happens after the evaluation of the semifinal entries?
                                <ul class="font-weight-light" style="list-style-type: none;">
                                    <li>The top 10 entries will be selected for the final round based on the scoring criteria and will be declared as winners. After choosing the 10 entries, the Organizers of the Competition will contact the 10 qualified participants, officially declaring them as the Top 10 winners of the competition.</li>
                                </ul>
                            </li>
                        </ol>
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
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?= APP_NAME; ?> - How to Win</title>
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
            font-size: 21px;
        }

        span {
            font-size: 21px;
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
                        <a class="nav-link active" href="<?= base_url(); ?>how">How to Win</a>
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
        <section class="text-white default-long-bg text-center font-weight-light">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-10 mx-auto mt-5 mb-3">
                        <h2 class="m-0 font-weight-bold mb-4">THE CONTEST:
                            <br>
                            Mix, Capture, Win in Emperador's Cocktail Showdown
                        </h2>
                        <span class="mt-4 mb-2">
                            Join the competition tailored for Hotel Restaurant Management/HRM students. Mix up a captivating cocktail video with Emperador Original or Emperador Light as a central ingredient, master up to 5 ingredients(for a total of 6 ingredients). Capture your winning shot and aim for mixology greatness. This is your moment - embrace the challenge and sip your way to victory!
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-10 mx-auto mt-5 mb-3 text-center">
                        <h4 class="m-0 font-weight-bold">Top 10 Winners:</h4>
                        <h4 class="m-0 font-weight-bold">100,000 Pesos Scholarship Each!</h4>
                        <span>Elevate your mixology game and secure a dazzling P100,000 scholarship.</span>
                    </div>
                    <div class="col-12 col-sm-10 mx-auto mt-3 mb-3 text-center">
                        <h4 class="m-0 font-weight-bold">School Bonus:</h4>
                        <h4 class="m-0 font-weight-bold">100,000 Pesos Scholarship!</h4>
                        <span>Your school wins too! A P100,000 scholarship shall be granted to another HRM student of the school's choice.</span>
                    </div>
                    <div class="col-12 col-sm-10 mx-auto mt-3 mb-3 text-center">
                        <span class="font-weight-bold">Ignite your Future: Sip, Shake, and Scholarly Success Await!</span> <br>
                        <span>This isn't just a contest; it's your ticket to academic and mixology greatness. Don't miss out - sip, shake, and win big!</span>
                    </div>
                </div> <br>
                <div class="row">
                    <div class="col-12 col-sm-10 mx-auto mt-5 mb-2">
                        <h3 class="m-0 font-weight-bold">ENTRY SUBMISSION</h3>
                    </div>
                    <div class="col-12 col-sm-10 mx-auto mt-2">
                        <ol style="list-style-type:lower-alpha" class="text-left">
                            <li>Participant must create a video (30 seconds to 5 minutes) showcasing how they create their own unique cocktail mix. The video must show their mixing story, using Emperador Original or Emperador Light as main mixing liquor, and a maximum of 5 more ingredients (total of 6 ingredients), and a shot of their final produced cocktail mix ("winning shot"). They can create their video entry as creatively as they can.</li>
                            <li>The participant will upload their official video entry to their own social media profile as public post. (Facebook).</li>
                            <li>Participants must provide URL of their uploaded video entry (URL of Facebook) to the link provided during the registration stage.</li>
                            <li>Once the video entry submission is uploaded in the link provided, participants will receive a confirmation for their successful video entry submission, this confirms that they have submitted their complete official entry.</li>
                        </ol>
                    </div>
                </div> <br>
                <div class="row">
                    <div class="col-12 col-sm-10 mx-auto mt-5 mb-2">
                        <h3 class="m-0 font-weight-bold">THE QUALIFYING ROUND</h3>
                    </div>
                    <div class="col-12 col-sm-10 mx-auto mt-2">
                        <ol style="list-style-type:lower-alpha" class="text-left">
                            <li>
                                Participants' video entries will be filtered during the qualifying round, and will be based on the following scoring and requirements:
                                <div class="col-12 col-sm-8 mx-auto mt-2 mb-2 text-left font-weight-bold">
                                    <div class="row mt-2 mb-2">
                                        <div class="col-12 col-sm-7">Story and storytelling behind the mix</div>
                                        <div class="col-12 col-sm-5">30 pts</div>
                                    </div>
                                    <div class="row mt-2 mb-2">
                                        <div class="col-12 col-sm-7">Ease of Preparation <br><small class="font-weight-light">(maximum of 6 ingredients including Emperador Original and Emperador Light as Base liquor)</small></div>
                                        <div class="col-12 col-sm-5">20 pts</div>
                                    </div>
                                    <div class="row mt-2 mb-2">
                                        <div class="col-12 col-sm-7">Presentation</div>
                                        <div class="col-12 col-sm-5">30 pts</div>
                                    </div>
                                    <div class="row mt-2 mb-2">
                                        <div class="col-12 col-sm-7">Social Media Impact <br><small class="font-weight-light">(Total number of reach e.g. likes, views, reacts, & comments)</small></div>
                                        <div class="col-12 col-sm-5">20 pts</div>
                                    </div>
                                </div>
                            </li>
                            <li>Videos should have a minimum length of 30 seconds and a maximum of 5 minutes. It should be uploaded on the participants' own personal Facebook page together with the hashtags <strong class="font-weight-bold">#EmperadorAcademy</strong> and <strong class="font-weight-bold">#ECC2024</strong>.</li>
                            <li>The Organizers of the Competition and an FDA representative will review all successful video Competition Participants based on the scoring above and will shortlist 30 entries.</li>
                            <li>The Organizers of the Competition will contact the 30 qualified particiants and will let them know that they are now eligible for the semifinal round. The Organizers of the Competition will also post the qualified Semifinals participants' announcements on their own social channels (e.g. Facebook).</li>
                        </ol>
                    </div>
                </div> <br>
                <div class="row">
                    <div class="col-12 col-sm-10 mx-auto mt-5 mb-2">
                        <h3 class="m-0 font-weight-bold">THE SEMI-FINAL ROUND</h4>
                    </div>
                    <div class="col-12 col-sm-10 mx-auto mt-2">
                        <ol style="list-style-type:lower-alpha" class="text-left">
                            <li>The Organizers of the Competition will request each of the qualified participants to send their complete ingredients and instructions for making their mix entry, as well as the name of the mix.</li>
                            <li>
                                The Organizers of the Competition and an FDA representative will then choose 10 entries that will be included in the final round based on the following scoring:
                                <div class="col-12 col-sm-8 mx-auto mt-2 mb-2 text-left font-weight-bold">
                                    <div class="row mt-2 mb-2">
                                        <div class="col-8 col-sm-7">Name of the Mix</div>
                                        <div class="col-4 col-sm-5">10 pts</div>
                                    </div>
                                    <div class="row mt-2 mb-2">
                                        <div class="col-8 col-sm-7">Balance</div>
                                        <div class="col-4 col-sm-5">20 pts</div>
                                    </div>
                                    <div class="row mt-2 mb-2">
                                        <div class="col-8 col-sm-7">Taste</div>
                                        <div class="col-4 col-sm-5">25 pts</div>
                                    </div>
                                    <div class="row mt-2 mb-2">
                                        <div class="col-8 col-sm-7">Originality</div>
                                        <div class="col-4 col-sm-5">25 pts</div>
                                    </div>
                                    <div class="row mt-2 mb-2">
                                        <div class="col-8 col-sm-7">Presentation</div>
                                        <div class="col-4 col-sm-5">20 pts</div>
                                    </div>
                                </div>
                            </li>
                        </ol>
                    </div>
                </div> <br>
                <div class="row">
                    <div class="col-12 col-sm-10 mx-auto mt-5 mb-2">
                        <h3 class="m-0 font-weight-bold">THE FINAL ROUND</h3>
                    </div>
                    <div class="col-12 col-sm-10 mx-auto mt-2">
                        <ol style="list-style-type:lower-alpha" class="text-left">
                            <li>From the 30 participants in the qualifying round, 10 will be chosen.</li>
                            <li>After choosing the 10 entries, the Organizers of the Competition will contact the 10 qualified participants and will let them know that they are officially the Top 10 winners of the competition.</li>
                            <li>The Organizers of the Competition reserves the right to validate the Competition Participant's eligibility status at any time, and to disqualify/block/ban him/her should there be a well-founded belief that there are irregularities or fraud in the use of the submitted entry and/or participation in the Competition.</li>
                            <li>Official awarding of the prizes to the winners, both the student and one (1) authorized school representative will be invited to the grand awarding ceremony that will be held at one of Megaworld Hotels & Resorts (final venue will announce prior to the awarding ceremony) on April 25, 2024.</li>
                            <li>The Top 10 Competition Participants will recreate and showcase their winning cocktail mixes during the grand award ceremony event.</li>
                            <li>Emperador Distillers Inc. ("EDI") will cover all the expenses such as hotel accommodation, food, and transportation of the student and school representative.</li>
                            <li>The Competition winners will be announced through the official website to be held on 2nd week of April 2024. Visit the <span class="font-weight-bold">www.emperadoracademy.com</span> for more details.</li>
                            <li>The winners of the Grand Finals will be notified by email, phone call, and through SMS. The instructions for claiming their prizes shall be discussed with them separately.</li>
                            <li>
                                All Competition winners both the students and the authorized school representative shall be required to bring:
                                <ul style="list-style-type:disc" class="font-weight-bold">
                                    <li>Two (2) government-issued IDs to claim their prize.</li>
                                    <li>An authorization letter from the Department Head or equivalent that the school representative claiming the prize is the authorized representative of the school.</li>
                                </ul> <br>
                                If the winner is unable to present a valid government-issued ID, he/she must submit:
                                <ul style="list-style-type:disc" class="font-weight-bold">
                                    <li>An Affidavit of two (2) disinterested persons (i.e., not a relative within the 3rd degree of consanguinity or affinity), attesting to his/her identity and age; and</li>
                                    <li>A Barangay Certification from the Chairperson of the barangay where he resides, certifying that the winner is a resident of the barangay and attesting to his/her identity and age.</li>
                                </ul>
                            </li>
                            <li>
                                Should the Competition winner be unavailable to claim his/her prize due to a well founded reason that is subject for the consent of the Organizers of the Competition, he/she may send an adult representative (18 years old and above) who shall claim the prize and must present the following:                            
                                <ul style="list-style-type:disc" class="font-weight-bold">
                                    <li>Special Power of Attorney (in the format acceptable to the EDI) originally signed by the winner;</li>
                                    <li>Winner's two (2) original valid government-issued IDs; and</li>
                                    <li>Representative's two (2) original valid government-issued IDs.</li>
                                </ul>
                                EDI shall not be responsible for any loss, damage, or injury to the prize or document representing the prize arising out of the fault, negligence, or any action/inaction of the winner's authorized representative.
                                <br> <br>
                                This Competition is run on an "As-Is" and "as available" basis and the Organizers of the Competition gives no warranties of any kind, whether express, implied, statutory, or otherwise including warranties or representations that the materials found in the Website will be complete, accurate, reliable, timely, non-infringing to third parties; that access to the links found therein, will be uninterrupted, error-free, and/or secure; or that any opinion obtained from links found in the Website, including those provided by the contestants, is accurate or to be relied upon.
                            </li>
                            <li>Unredeemed Grand Prizes as of June 30, 2024 shall be deemed forfeited.</li>
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
                </div> <br>
            </div>
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

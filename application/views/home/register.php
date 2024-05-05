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
        <title><?= APP_NAME; ?> - Registration</title>
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
        <section id="registration_container" class="register-bg">
            <div class="container text-white">
                <?php
                if (!empty($this->input->get("type", true)) && !empty($this->input->get("reference", true))) {
                    if ($this->input->get("type", true) == "1") {
                        ?>
                        <div class="modal animated--grow-in show" id="add_user" tabindex="-1" aria-labelledby="addUserModal" aria-modal="true" role="dialog">
                            <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content border-0">
                                    <div class="modal-body">
                                        <div class="container-fluid">
                                            <div class="col-12 col-sm-12 mx-auto text-center mt-2 mb-2">
                                                <h6 class="m-0">Thank you for joining the Emperador's Nationwide Univerity Cocktail Showdown!</h6>
                                            </div>
                                            <div class="col-12 col-sm-12 mx-auto text-center text-sm mt-2 mb-2">
                                                <label class="m-0">
                                                Your registration is now in our records. <br>
                                                Our team will verify your details, and we'll be reaching out to you shortly to confirm your participation.
                                                </label>
                                            </div>
                                            <div class="col-12 col-sm-12 mx-auto text-center text-sm mt-2 mb-2">
                                                <label class="m-0">Keep an eye on your inbox!</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }

                if (!empty(validation_errors())) {
                    ?> <br>
                    <div class="alert alert-danger border-danger alert-dismissible mt-3 mb-3 fade show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Error!</strong> <?= validation_errors(); ?>
                    </div>
                    <?php
                }

                if (!empty($this->session->flashdata('error'))) {
                    ?> <br>
                    <div class="alert alert-danger border-danger alert-dismissible mt-3 mb-3 fade show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Error!</strong> <?= $this->session->flashdata('error'); ?>
                    </div>
                    <?php
                }
                ?>
                <div class="row">
                    <div class="col-12 col-sm-12 mt-3 mb-2">
                        <h3 class="m-0">REGISTRATION</h3>
                    </div>
					<div class="col-12 col-sm-12 mt-2 mb-3" id="notice_form">
						<span class="h5">
							This is a registration portal for Emperador's Nationwide University Cocktail Showdown exclusively for Hotel and Restaurant Management (HRM) Students! Craft a creative video showcasing your mixology skills with Emperador Original or Emperador Light. Capture your winning shots and be part of the ultimate sip, shake, and win experience.
							<br> <br>
							Join now and let the cocktail showdown begin!
							<br> <br>
							Please read our Privacy Notice carefully and provide the requested information. When you provide another person’s information, you hereby attest that you have obtained their consent to allow us to process and/or disclose such information in accordance with our policy.
							<br> <br>
							<h5 class="font-weight-bold">Privacy Notice</h5>
							The organizers (Emperador Distillers, Inc. and its service provider, RedBalloon Creatives Inc.) value the confidentiality of data you have entrusted to us.
							<br> <br>
							For this competition, we will collect the following personal information: name, gender, date of birth, mobile number, email address, home address, school name, name of official school mentor/representative, school address, contact number of school mentor/representative, school ID or proof of enrollment, and government-issued ID with photo & birthday.
							<br> <br>
							The personal information will be used to enable the organizers to run the Emperador Academy: HRM Students Cocktail Competition, as well as for internal documentation, accounting, recording and auditing purposes. The organizers may also take photos and videos of the prize redemption which they may also use for publicity and advertising purposes. You may review how Emperador Distillers, Inc. process your personal information, how long we store the same, the scope of our processing, details of our data protection officer and how you can exercise your rights as a data subject by using this link <a href="https://emperadorinc.com/privacy-policy/" target="_blank">https://emperadorinc.com/privacy-policy/</a>
							<br> <br>
							RedBalloon Creatives Inc, the service provider hired to run the competition, will also have access to your personal information.  In order to find out how the service provider will process the personal information shared to them, please review their privacy policy using this link <a href="https://bit.ly/4akiRxR" target="_blank">https://bit.ly/4akiRxR</a>.
						</span>
					</div>
					<div class="col-12 col-sm-12 mt-2 mb-2" id="consent_form">
						<h4 class="m-0">Declaration of Consent</h4>
						<div class="custom-control custom-radio mt-3 mb-3">
							<input type="radio" class="custom-control-input consentChoice" id="radioYes" name="consent" value="Yes">
							<label class="custom-control-label font-weight-bold" for="radioYes">I consent</label>
						</div>
						<div class="custom-control custom-radio mt-3 mb-3">
							<input type="radio" class="custom-control-input consentChoice" id="radioNo" name="consent" value="No">
							<label class="custom-control-label font-weight-bold" for="radioNo">I do not consent</label>
						</div>
					</div>
                </div>
				<div id="reg_form" class="d-none">
					<div class="row col-12 col-sm-12 mt-2 mb-2">
						<span class="h5">
							<h5 class="font-weight-bold">Personal Information</h5>
							The following personal information are required for us to process your registration. Please note that you are responsible for ensuring that all such personal information you submit to us are accurate, complete and up-to-date.
						</span>
					</div>
					<?= form_open_multipart(); ?>
						<div class="form-row">
							<div class="col-12 col-sm-4 mt-1 mb-1 form-group">
								<label class="font-weight-bold">FULL NAME</label>
								<input type="text" class="form-control form-control-sm text-capitalize" name="Name" value="<?= set_value("Name"); ?>" minlength="2" maxlength="150" required>
							</div>
							<div class="col-8 col-sm-4 mt-1 mb-1 form-group">
								<label class="font-weight-bold">GENDER</label>
								<select class="custom-select custom-select-sm" required name="Gender">
									<option value="" disabled selected>Select Gender</option>
									<option value="M" <?= set_value("Gender") == "M" ? 'selected' : '' ?>>Male</option>
									<option value="F">Female</option>
								</select>
							</div>
							<div class="col-8 col-sm-4 mt-1 mb-1 form-group">
								<label class="font-weight-bold" for="datepicker">DATE OF BIRTH</label>
								<input type="text" id="datepicker" readonly value="<?= set_value("DOB"); ?>" placeholder="Click here to enter DOB" class="form-control form-control-sm" required name="DOB">
								<!--<input type="date" class="form-control form-control-sm" name="DOB" value="<?= set_value("DOB"); ?>" max="<?= $minDate; ?>" required>-->
							</div>
							<div class="col-8 col-sm-4 mt-3 mb-3 form-group">
								<label for="MobileNumber" class="font-weight-bold">MOBILE NUMBER</label>
								<input id="MobileNumber" type="tel" onkeypress="return isInputNumber(event)" class="form-control form-control-sm" name="Mobile" value="<?= set_value("Mobile"); ?>" placeholder="9xxxxxxxxx" pattern="[0-9]{10}" minlength="10" maxlength="10" required>
							</div>
							<div class="col-8 col-sm-4 mt-3 mb-3 form-group">
								<label class="font-weight-bold">EMAIL ADDRESS</label>
								<input type="email" class="form-control form-control-sm" name="Email" value="<?= set_value("Email"); ?>" required>
							</div>
							<div class="col-12 col-sm-4 mt-3 mb-3 form-group">
								<label class="font-weight-bold">HOME ADDRESS</label>
								<input type="text" class="form-control form-control-sm text-capitalize" name="Address" value="<?= set_value("Address"); ?>" minlength="2" maxlength="250" required>
							</div>
							<div class="col-12 col-sm-6 mt-3 mb-3 form-group">
								<label class="font-weight-bold">NAME OF SCHOOL</label>
								<input type="text" class="form-control form-control-sm text-capitalize" name="SchoolName" value="<?= set_value("SchoolName"); ?>" minlength="2" maxlength="250" required>
							</div>
							<div class="col-12 col-sm-6 mt-3 mb-3 form-group">
								<label class="font-weight-bold">NAME OF OFFICIAL SCHOOL MENTOR / REPRESENTATIVE</label>
								<input type="text" class="form-control form-control-sm text-capitalize" name="SchoolRep" value="<?= set_value("SchoolRep"); ?>" minlength="2" maxlength="250" required>
							</div>
						</div>
						<div class="form-row">
							<div class="col-12 col-sm-6 mt-3 mb-3 form-group">
								<div class="h-100">
									<label class="font-weight-bold">SCHOOL ADDRESS</label>
									<textarea name="SchoolAddress" class="form-control form-control-sm text-capitalize" rows="5" required><?= set_value("SchoolAddress"); ?></textarea>
								</div>
							</div>
							<div class="col-12 col-sm-6">
								<div class="h-100">
									<div class="col-12 col-sm-12 mt-3 mb-3 form-group reg-pad">
										<label class="font-weight-bold">CONTACT NUMBER OF SCHOOL MENTOR / REPRESENTATIVE</label>
										<input type="text" onkeypress="return isInputNumber(event)" required class="form-control form-control-sm text-capitalize" name="SchoolRepContact" value="<?= set_value("SchoolRepContact"); ?>" minlength="8" maxlength="13">
									</div>
									<div class="col-12 col-sm-12 mt-3 mb-3 form-group reg-pad">
										<label class="font-weight-bold">EMAIL ADDRESS OF SCHOOL MENTOR / REPRESENTATIVE</label>
										<input type="email" class="form-control form-control-sm" name="SchoolEmail" value="<?= set_value("SchoolEmail"); ?>" required>
									</div>
								</div>
							</div>
						</div>
						<span class="font-weight-bold">UPLOAD THE FOLLOWING:</span> <br>
						<div class="form-row">
							<div class="col-8 col-sm-6 mt-3 mb-3 form-group">
								<span>YOUR SCHOOL ID / PROOF OF ENROLLMENT</label>
								<input type="file" class="form-control" id="customFile" accept="image/*" name="SchoolID" />
								<!-- <label class="small" for="customFile">School ID and Proof of Enrollment</label> -->
							</div>
							<div class="col-8 col-sm-6 mt-3 mb-3 form-group">
								<span>GOVERNMENT-ISSUED ID WITH PHOTO AND BIRTHDAY</label>
								<input type="file" class="form-control" id="gid" accept="image/*" name="GovID" />
								<!-- <label class="custom-file-label small" for="gid">Government ID</label> -->
							</div>
						</div>
						<div class="form-row">
							<div class="col-12 col-sm-12 mt-3 mb-3 form-group">
								<label class="font-weight-bold">STORY BEHIND YOUR COCKTAIL</label>
								<textarea name="Story" class="form-control form-control-sm" rows="3" required><?= set_value("Story"); ?></textarea>
							</div>
							<div class="col-12 col-sm-12 mt-3 mb-3 form-group">
								<label class="font-weight-bold">INGREDIENTS USED</label>
								<textarea name="Ingredients" class="form-control form-control-sm" rows="3" required><?= set_value("Ingredients"); ?></textarea>
							</div>
							<div class="col-12 col-sm-12 mt-3 mb-3 form-group">
								<label class="font-weight-bold">VIDEO LINK</label>
								<input type="url" class="form-control form-control-sm" name="Link" value="<?= set_value("Link"); ?>" required>
							</div>
						</div>
						<div class="form-row">
							<div class="col-12 col-sm-12 mt-3 mb-3 form-group">
								<button type="submit" class="btn btn-sm btn-danger" id="btn_submit">SUBMIT REGISTRATION NOW</button>
							</div>
						</div>
					</form>
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
        <script>
            function AgreeCheck() {
                if (document.getElementById('agree_chck').checked) {
                    document.getElementById('btn_submit').disabled = false;
                } else {
                    document.getElementById('btn_submit').disabled = true;
                }
            }

            $(".custom-file-input").on("change", function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });

            $(document).ready(function() {
				$("#reg_form").hide();
                var dateToday = new Date();
                var eligible = dateToday.getYear() - 18;
                $(function() {
                    $("#datepicker").datepicker({
                        changeMonth: true,
                        changeYear: true,
                        dateFormat: 'yy-mm-dd',
                        defaultDate: "<?= $minDate; ?>",
                        maxDate: "<?= $minDate; ?>",
                        showAnim: "fadeIn"
                    });
                });

				$(".consentChoice").click(function(){
					var radioValue = $("input[name='consent']:checked").val();
					if (radioValue == "Yes") {
						window.scrollTo(0, 0);
						$("#consent_form").fadeOut(1000);
						$("#notice_form").fadeOut(1000);
						document.getElementById('consent_form').classList.add('d-none');
						document.getElementById('notice_form').classList.add('d-none');
						document.getElementById('reg_form').classList.remove('d-none');
						$("#reg_form").fadeIn(1000);
					} else {
						window.scrollTo(0, 0);
						$("#reg_form").fadeOut(1000);
						document.getElementById('reg_form').classList.add('d-none');
						$("#consent_form").fadeIn(1000);
						document.getElementById('consent_form').classList.remove('d-none');
						$("#notice_form").fadeIn(1000);
						document.getElementById('notice_form').classList.remove('d-none');
					}
				});
            })

            $("#add_user").modal();

            function isInputNumber(event) {
                var ch = String.fromCharCode(event.which);
                if (!(/[0-9]/.test(ch))) {
                    event.preventDefault();
                }
            }

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

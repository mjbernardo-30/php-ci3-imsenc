<?php
$theme = APP_THEME;
?>
<nav class="navbar navbar-expand navbar-<?= $theme; ?> topbar mb-4 static-top shadow topbar-setting text-primary">
	<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    <ul class="navbar-nav ml-auto">
        <div class="topbar-divider d-none d-sm-block"></div>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            	<span class="mr-2 d-lg-inline font-weight-bold small custom-color">
                    <?= $data["UserData"]["Information"]["UserName"]; ?>
                </span>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in nav-menu-setting" aria-labelledby="userDropdown">
                <a class="dropdown-item text-gray-400" href="#" data-toggle="modal" data-target="#changePasswordModal">
                	<i class="fas fa-key fa-sm fa-fw mr-2"></i> Change Password
                </a>
                <!--<div class="dropdown-divider dropdown-divider-theme"></div>-->
                <a class="dropdown-item text-gray-400" href="<?= base_url(); ?>login/logout">
                	<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i> Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
<div class="modal animated--grow-in" id="changePasswordModal" tabindex="-1" aria-labelledby="changePWModal" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content border-0 modal-theme">
            <div class="modal-body">
                <?= form_open('AdminUsers/ChangePassword'); ?>
                    <div class="form-row">
                        <div class="col-12 col-sm-12 text-center mt-2 mb-2 form-group">
                            <h5 class="m-0">Change Password</h5>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-12 col-sm-12 mt-2 mb-2 form-group">
                            <label class="small font-weight-bold">Old Password</label>
                            <input type="password" class="form-control form-control-sm text-capitalize custom-input" name="OldPw" value="<?= set_value("OldPw"); ?>" required minlength="6" maxlength="12">
                        </div>
                        <div class="col-12 col-sm-12 mt-2 mb-2 form-group">
                            <label class="small font-weight-bold">New Password</label>
                            <input type="password" class="form-control form-control-sm text-capitalize custom-input" name="Password" value="<?= set_value("Password"); ?>" required minlength="6" maxlength="12" id="pw">
                        </div>
                        <div class="col-12 col-sm-12 mt-2 mb-2 form-group">
                            <label class="small font-weight-bold">Confirm Password</label>
                            <input type="password" class="form-control form-control-sm text-capitalize custom-input" name="ConfirmPassword" value="<?= set_value("ConfirmPassword"); ?>" required minlength="6" maxlength="12" id="confirm_pw" onkeyup="check_password()">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-12 col-sm-5 mx-auto mt-2 mb-2 form-group">
                            <button type="submit" disabled id="btn_submit" class="btn btn-block btn-success btn-sm"><i class="fas fa-fw fa-save"></i> Save</button>
                        </div>
                        <div class="col-12 col-sm-5 mx-auto mt-2 mb-2 form-group">
                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-block btn-outline-danger"><i class="fas fa-fw fa-ban"></i> Cancel</button>
                        </div>
                    </div>
                    <input type="hidden" name="Url" value="<?= current_url(); ?>">
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row mt-5 mb-5">
    <div class="col-12 col-sm-4 mx-auto">
        <div class="card border-0" style="border-radius: 10px;">
            <div class="card-body bg-gradient-dark sign-body">
                <div class="row text-center">
                    <div class="col-12">
                        <h4 class="text-uppercase">Login</h4>
                    </div>
                </div>
                <?= validation_errors(); ?>
                <?= form_open('login/index'); ?>
                    <div class="form-row text-white">
                        <div class="col-12 col-sm-10 mx-auto mt-2 mb-2 form-group">
                            <label class="small font-weight-bold" for="Email">Email Address</label>
                            <input value="<?= set_value('Email'); ?>" type="email" id="Email" name="Email" class="custom-input form-control form-control-sm" minlength="3" maxlength="150" required>
                        </div>
                        <div class="col-12 col-sm-10 mx-auto mt-2 mb-2 form-group">
                            <label class="small font-weight-bold" for="Password">Password</label>
                            <input type="password" id="Password" name="Password" class="form-control form-control-sm custom-input" required>
                        </div>
                        <div class="col-12 col-sm-4 mx-auto mt-2 mb-2 form-group">
                            <button type="submit" class="btn btn-sm btn-block btn-primary">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
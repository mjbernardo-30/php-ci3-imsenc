<?php
$theme = APP_THEME;
/*if ($this->session->has_userdata("LoginData") && ($data['PageDetails']['Page'] != "Login")) {
    if (empty($data["UserData"]["Setting"]["Theme"])) {
        redirect(base_url()."admin/login?ErrorMessage=You must login first before you can proceed.&ContentType=string");
    } else {
        $theme = strtolower($data["UserData"]["Setting"]["Theme"]);
    }
}*/
?>
<!DOCTYPE html>
<html lang="en" data-theme="<?= $theme; ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?= $data['PageDetails']['Title']; ?> - <?= APP_NAME; ?></title>
        <link rel="icon" type="image/x-icon" href="<?= ASSETS_URL; ?>img/favicon-2.png">
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,800">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.1/css/all.min.css" integrity="sha512-3M00D/rn8n+2ZVXBO9Hib0GKNpkm8MSUU/e2VNthDyBYxKWG+BftNYYcuEjXlyrSO637tidzMBXfE7sQm0INUg==" crossorigin="anonymous" />
        <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" rel="stylesheet">
        <link href="<?= ASSETS_URL; ?>css/custom-bootstrap.css" rel="stylesheet">
        <link href="<?= ASSETS_URL; ?>css/custom-style.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <?php
        if ($data['PageDetails']['Page'] == "Dashboard") { ?>
            <!-- HighCharts -->
            <script src="https://code.highcharts.com/highcharts.js"></script>
            <script src="https://code.highcharts.com/modules/exporting.js"></script>
            <script src="https://code.highcharts.com/modules/export-data.js"></script>
            <script src="https://code.highcharts.com/modules/accessibility.js"></script>
            <script src="https://code.highcharts.com/modules/drilldown.js"></script>
            <?php
        }
        ?>
    </head>
    <body id="page-top" class="sign-container">
        <!-- Alert notifications -->
        <?php
        if ((!empty($this->input->get("Message", true))) && !empty($this->input->get("Type", true))) {
            if (in_array(strtolower($this->input->get("Type", true)), array("success", "error"))) {
                ?>
                <div class="toast mt-3 mr-3 border-0 d-none d-sm-block" role="alert" id="toast_message" data-delay="20000">
                    <div class="toast-header bg-<?= (strtolower($this->input->get("Type", true)) == "error") ? 'danger' : 'success'; ?>">
                        <strong class="mr-auto text-white"><i class="fa fa-<?= ($this->input->get("Type", true) == "Error") ? 'exclamation-circle' : 'check-circle'; ?>"></i> <?= ucfirst($this->input->get("Type", true)); ?></strong>
                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="toast-body text-dark"><?= $this->input->get("Message", true); ?></div>
                </div>
                <div class="container d-sm-none d-block">
                    <div class="alert alert-danger mt-2 text-xs">
                        <strong class="mr-auto"><i class="fa fa-exclamation-circle"></i> Error:</strong> <?= $this->input->get("ErrorMessage", true); ?>
                    </div>
                </div>
                <?php
            }
        } elseif (!empty(validation_errors())) { ?>
            <div class="toast mt-3 mr-3 border-0 d-none d-sm-block" role="alert" aria-live="assertive" aria-atomic="true" id="toast_message" data-delay="2000">
                <div class="toast-header bg-danger">
                    <strong class="mr-auto text-white"><i class="fa fa-exclamation-circle"></i> Validation Error</strong>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="toast-body text-dark">
                    <ul>
                        <?= validation_errors('<li>', '</li>'); ?>
                    </ul>
                </div>
            </div>
            <div class="container d-sm-none d-block">
                <div class="alert alert-danger mt-2 text-xs">
                    <strong class="mr-auto"><i class="fa fa-exclamation-circle"></i> Error:</strong>
                    <ul>
                        <?= validation_errors('<li>', '</li>'); ?>
                    </ul>
                </div>
            </div>
            <?php
        } elseif (!empty($this->session->flashdata('error'))) { ?>
            <div class="toast mt-3 mr-3 border-0 d-none d-sm-block" role="alert" aria-live="assertive" aria-atomic="true" id="toast_message" data-delay="2000" data-autohide="false">
                <div class="toast-header bg-danger">
                    <strong class="mr-auto text-white"><i class="fa fa-exclamation-circle"></i> Error</strong>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="toast-body text-dark"><?= $this->session->flashdata('error'); ?></div>
            </div>
            <div class="container d-sm-none d-block">
                <div class="alert alert-danger mt-2 text-xs">
                    <strong class="mr-auto"><i class="fa fa-exclamation-circle"></i> Error:</strong> <?= $this->session->flashdata('error'); ?>
                </div>
            </div>
            <?php
        } elseif (!empty($this->session->flashdata('success'))) { ?>
            <div class="toast mt-3 mr-3 border-0 d-none d-sm-block" role="alert" aria-live="assertive" aria-atomic="true" id="toast_message" data-delay="2000" data-autohide="false">
                <div class="toast-header bg-success">
                    <strong class="mr-auto text-white"><i class="fa fa-check-circle"></i> Success</strong>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="toast-body text-dark"><?= $this->session->flashdata('success'); ?></div>
            </div>
            <div class="container d-sm-none d-block">
                <div class="alert alert-danger mt-2 text-xs">
                    <strong class="mr-auto"><i class="fa fa-check-circle"></i> Success:</strong> <?= $this->session->flashdata('success'); ?>
                </div>
            </div>
            <?php
        } 
        ?>
        <div id="wrapper">
            <?php
            if ($data["PageDetails"]["Function"] == "Admin" && $data["PageDetails"]["Page"] != "Login") {
                $this->load->view('templates/admin_sidebar', $data);
            }
            ?>
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content" class="<?= ($data["PageDetails"]["Function"] == "Admin" && $data["PageDetails"]["Page"] == "Login") ? 'sign-container' : 'theme-setting' ?>">
                    <?php
                    if ($data["PageDetails"]["Function"] == "Admin" && $data["PageDetails"]["Page"] != "Login") {
                        $this->load->view('templates/admin_topbar', $data);
                    }
                    ?>
                    <div class="container-fluid">
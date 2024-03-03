<?php
//print_r($data["PageData"]["ChartData"]);
?>
<div class="d-sm-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0"><?= $data["PageDetails"]["Title"]; ?></h1>
</div>
<button class="btn btn-sm btn-outline-primary mt-3 mb-3" data-target="#add_user" data-toggle="modal"><i class="fas fa-fw fa-download"></i> Download</button>
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="font-weight-bold text-primary text-uppercase mb-1">Total Registrants</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($data["PageData"]['TileData']['TotalRegistrant']); ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-500"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="font-weight-bold text-primary text-uppercase mb-1">Pending</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($data["PageData"]['TileData']['TotalPending']); ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-clock fa-2x text-gray-500"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="font-weight-bold text-primary text-uppercase mb-1">Approved</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($data["PageData"]['TileData']['TotalApprove']); ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-check fa-2x text-gray-500"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="font-weight-bold text-primary text-uppercase mb-1">Rejected</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($data["PageData"]['TileData']['TotalReject']); ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-times fa-2x text-gray-500"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-sm-12 mt-3 mb-3">
        <div class="card border-0 shadow-sm h-100 py-2">
            <div class="card-body" id="line_chart_cashout" width="100%"></div>
        </div>
    </div>
</div>
<div class="modal animated--grow-in" id="add_user" tabindex="-1" aria-labelledby="addUserModal" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content border-0 modal-theme">
            <div class="modal-body">
                <?= form_open("AdminDashboard/Download"); ?>
                    <div class="form-row">
                        <div class="col-12 col-sm-12 text-center mt-2 mb-2 form-group">
                            <h5 class="m-0">Download Registration Data</h5>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-12 col-sm-12 mt-2 mb-2 form-group">
                            <label class="small font-weight-bold">Date From:</label>
                            <input type="date" class="form-control form-control-sm custom-input" value="<?= REG_STARTDATE; ?>" min="<?= REG_STARTDATE; ?>" max="<?= REG_ENDDATE; ?>" name="DateFrom" value="<?= set_value("DateFrom"); ?>" required>
                        </div>
                        <div class="col-12 col-sm-12 mt-2 mb-2 form-group">
                            <label class="small font-weight-bold">Date To:</label>
                            <input type="date" class="form-control form-control-sm custom-input" value="<?= date("Y-m-d"); ?>" min="<?= REG_STARTDATE; ?>" max="<?= REG_ENDDATE; ?>" name="DateTo" value="<?= set_value("DateTo"); ?>" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-12 col-sm-4 mx-auto mt-2 mb-2 form-group">
                            <button type="submit" class="btn btn-sm btn-block btn-primary">Download</button>
                        </div>
                        <div class="col-12 col-sm-4 mx-auto mt-2 mb-2 form-group">
                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-block btn-outline-danger">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    Highcharts.chart('line_chart_cashout', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'line'
        },
        title: {
            text: 'Registration'
        },
        subtitle: {
            text: 'per Date'
        },
        xAxis: {
            categories: [
                <?php
                if (count($data["PageData"]["ChartData"]['RegistrationByDate']) > 0) {
                    for ($i=0; $i < count($data["PageData"]["ChartData"]['RegistrationByDate']); $i++) { 
                        if ($i == array_key_last($data['PageData']['ChartData']['RegistrationByDate'])) { ?>
                            '<?= date("M d y", strtotime($data['PageData']['ChartData']['RegistrationByDate'][$i]->date_receive)); ?>'
                            <?php
                        } else { ?>
                            '<?= date("M d y", strtotime($data['PageData']['ChartData']['RegistrationByDate'][$i]->date_receive)); ?>',
                            <?php
                        }
                    }
                }
                ?>
            ]
        },
        yAxis: {
            title: {
                text: 'Count'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        series: [
            {
                name: 'Registration',
                data: [
                    <?php
                    if (count($data["PageData"]["ChartData"]['RegistrationByDate']) > 0) {
                        for ($i=0; $i < count($data["PageData"]["ChartData"]['RegistrationByDate']); $i++) { 
                            if ($i == array_key_last($data['PageData']['ChartData']['RegistrationByDate'])) { ?>
                                <?= $data["PageData"]["ChartData"]['RegistrationByDate'][$i]->total_count; ?>
                                <?php
                            } else { ?>
                                <?= $data["PageData"]["ChartData"]['RegistrationByDate'][$i]->total_count; ?>,
                                <?php
                            }
                        }
                    }
                    ?>
                ]
            }
        ]
    });
</script>
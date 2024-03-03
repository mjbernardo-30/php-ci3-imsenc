<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0"><?= $data["PageDetails"]["Title"]; ?></h1>
</div>
<div class="row mt-3 mb-3">
    <div class="col-12 col-sm-12 mx-auto">
        <div class="card border-0 bg-white">
            <div class="card-body text-black">
                <div class="mt-2 mb-2">
                    <a data-target="#add_user" data-toggle="modal" type="button">
                        <button class="btn btn-sm btn-outline-primary shadow-sm"><i class="fas fa-fw fa-user-plus fa-sm text-dark-50"></i> Create User</button>
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless table-striped table-hover small text-black" id="tbl_acc" width="100%" cellspacing="0">
                        <thead class="text-center">
                            <tr>
                                <th>User</th>
                                <th>Total Report</th>
                                <th>Timestamp</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal animated--grow-in" id="add_user" tabindex="-1" aria-labelledby="addUserModal" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content border-0 modal-theme">
            <div class="modal-body">
                <?= form_open(); ?>
                    <div class="form-row">
                        <div class="col-12 col-sm-12 text-center mt-2 mb-2 form-group">
                            <h5 class="m-0">Create User</h5>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-12 col-sm-12 mt-2 mb-2 form-group">
                            <label class="small font-weight-bold">Name</label>
                            <input type="text" class="form-control form-control-sm text-capitalize custom-input" name="Name" value="<?= set_value("Name"); ?>" required>
                        </div>
                        <div class="col-12 col-sm-12 mt-2 mb-2 form-group">
                            <label class="small font-weight-bold">Email</label>
                            <input type="email" class="form-control form-control-sm custom-input" name="Email" value="<?= set_value("Email"); ?>" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-12 col-sm-4 mx-auto mt-2 mb-2 form-group">
                            <button type="submit" class="btn btn-sm btn-block btn-primary">Create</button>
                        </div>
                        <div class="col-12 col-sm-4 mx-auto mt-2 mb-2 form-group">
                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-block btn-outline-danger">Cancel</button>
                        </div>
                    </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#tbl_acc").DataTable({
            "processing": true,
            "serverSide": true,
            "pageLength": 10,
            "responsive": true,
            "orderMulti": false,
            "order": [[2, "desc"]],
            "ajax": {
                "url": "<?= base_url(); ?>admin/users/datatable",
                "type": 'POST'
            },
            "language": {
                "search": "",
                "searchPlaceholder": "Search...",
                "emptyTable": "No record found.",
                "processing":
                    '<i class="fa fa-spinner fa-spin fa-3x fa-fw" style="color:#2a2b2b;"></i><span class="sr-only">Loading...</span> '
            },
            "columnDefs": [{
                'targets': [1, 3],
                "orderable": false
            }]
        });
    });
</script>
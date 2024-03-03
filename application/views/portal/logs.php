<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0"><?= $data["PageDetails"]["Title"]; ?></h1>
</div>
<div class="row mt-3 mb-3">
    <div class="col-12 col-sm-12 mx-auto">
        <div class="card border-0 text-black">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless table-striped table-hover small text-black" id="tbl_siteactlogs" width="100%" cellspacing="0">
                        <thead class="text-center">
                            <tr>
                                <th>User</th>
                                <th>Category</th>
                                <th>Message</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#tbl_siteactlogs").DataTable({
            "processing": true,
            "serverSide": true,
            "pageLength": 10,
            "responsive": true,
            "orderMulti": false,
            "order": [[3, "desc"]],
            "ajax": {
                "url": "<?= base_url(); ?>admin/logs/datatable",
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
                'targets': [3],
                "orderable": false
            }]
        });
    });
</script>
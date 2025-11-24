<?= $this->include('/dashboard/layouts/header') ?>
<?= $this->include('/dashboard/layouts/sidebar') ?>

<!--begin::App Main-->
<main class="app-main">

    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Visitor Request List</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Visitor Request</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!--end::App Content Header-->

    <div class="app-content">
        <div class="container-fluid">

            <div class="row d-flex justify-content-center">
        

                <!-- Satart view Visitor Request Form Pop-Up  -->
                    <div class="modal fade" id="visitorModal">
                    <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Visitor Details</h5>
                        <!-- <button type="button" class="close" data-bs-dismiss="modal">&times;</button> -->
                        </div>

                        <div class="modal-body">

                        <table class="table table-bordered">
                            <tr><th>Name</th><td id="v_name"></td></tr>
                            <tr><th>Email</th><td id="v_email"></td></tr>
                            <tr><th>Phone</th><td id="v_phone"></td></tr>
                            <tr><th>Purpose</th><td id="v_purpose"></td></tr>
                            <tr><th>ID Type</th><td id="v_id_type"></td></tr>
                            <tr><th>ID Number</th><td id="v_id_number"></td></tr>
                            <tr><th>Visit Date</th><td id="v_date"></td></tr>
                            <tr><th>Description</th><td id="v_desc"></td></tr>
                            <tr>
                            <th>QR Code</th>
                            <td><img id="v_qr" src="" width="150"></td>
                            </tr>
                        </table>

                        </div>

                        <div class="modal-footer">
                        <button class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                    </div>
                    </div>

                <!-- End view Visitor Request Form Pop-Up  -->

                    <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                        <h3 class="card-title">Visitor Request List</h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                            <!-- <input type="button" name="add" class="form-control float-right" placeholder="Search"> -->
                            
                            <a href="<?= base_url('visitorequest') ?>" class="btn btn-warning mt-1"> New Request</a>
                            </div>
                        </div>
                        </div>
                        <!-- /.card-header -->
                         <!-- /.card-body -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap" id="visitorTable">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>S No</th>
                                            <th>Visitor</th>
                                            <th>Visit Date</th>
                                            <th>Purpose</th>
                                            <th>Phone</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <?php if($_SESSION['role_id'] == '1' || $_SESSION['role_id'] == '2'){?>
                                            <th style="width:150px;">Actions</th>
                                             <?php }?>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>

                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>

        </div>
    </div>
</main>
<!--end::App Main-->

<?= $this->include('/dashboard/layouts/footer') ?>

<script>
// Handle Approve / Reject buttons
$(document).on("click", ".approvalBtn", function () {
    let id = $(this).data("id");
    let status = $(this).data("status");

    approval(id, status);
});

function approval(id, status) {

    $.ajax({
        url: "<?= base_url('/approvalprocess') ?>",
        type: "POST",
        data: { id: id, status: status },
        dataType: "json",
        success: function (res) {

            if (res.status === "success") {

                Swal.fire({
                position: 'top-end',
                toast: true,
                icon: 'success',
                title: 'Action Completed', 
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                backgroundColor: '#cf4040ff',
                titleColor: '#fff',
                }) 
                loadVisitorList();  // Refresh table immediately
            } else {
                alert("Failed to update!");
            }
        }
    });
}

$(document).ready(function() {
    loadVisitorList();
});

// 👉 CORRECT function
function loadVisitorList() {

    $.ajax({
        url: "<?= base_url('/visitorlistdata') ?>",
        type: "GET",
        dataType: "json",
        success: function(data) {

            let rows = "";
            let i = 1;

            data.forEach(function(item){

                // Status badge
                let statusBadge =
                    item.status === "approved" ? `<span class="badge bg-success">Approved</span>` :
                    item.status === "rejected" ? `<span class="badge bg-danger">Rejected</span>` :
                    `<span class="badge bg-warning">Pending</span>`;

                // Action buttons only for pending
                let actions = "";
                if (item.status === "pending") {
                    actions = `
                        <button class="btn btn-success btn-sm approvalBtn" data-id="${item.id}" data-status="approved">Approve</button>
                        <button class="btn btn-danger btn-sm approvalBtn" data-id="${item.id}" data-status="rejected">Reject</button>
                    `;
                } else {
                    actions = `<span class="text-muted">--</span>`;
                }

                rows += `
                    <tr>
                        <td>${i++}</td>
                        <td>${item.visitor_name}</td>
                        <td>${item.visit_date}</td>
                        <td>${item.purpose}</td>
                        <td>${item.visitor_phone}</td>
                        <td>${item.description ?? ''}</td>
                        <td>${statusBadge}</td>
                         <?php if($_SESSION['role_id'] == '1' || $_SESSION['role_id'] == '2'){?>
                        <td>${actions}</td>
                        <?php } ?>
                        <td>
                        <button class="btn btn-info btn-sm viewBtn" data-id="${item.id}">
                        View
                        </button>
                        </td>
                    </tr>
                `;
            });

            $("#visitorTable tbody").html(rows);
        }
    });
}



$(document).on("click", ".viewBtn", function () {
    let id = $(this).data("id");

    $.ajax({
        url: "<?= base_url('getvisitorrequestdata/') ?>" + id,
        type: "GET",
        dataType: "json",
        success: function (data) {

            $("#v_name").text(data.visitor_name);
            $("#v_email").text(data.visitor_email);
            $("#v_phone").text(data.visitor_phone);
            $("#v_purpose").text(data.purpose);
            $("#v_id_type").text(data.proof_id_type);
            $("#v_id_number").text(data.proof_id_number);
            $("#v_date").text(data.visit_date);
            $("#v_desc").text(data.description);

            if (data.qr_code) {
                $("#v_qr").attr("src", "<?= base_url('public/uploads/qr_codes/') ?>" + data.qr_code);
            } else {
                $("#v_qr").attr("src", "");
            }

            $("#visitorModal").modal("show");
        }
    });
});


</script>


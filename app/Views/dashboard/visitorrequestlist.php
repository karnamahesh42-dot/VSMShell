<?= $this->include('/dashboard/layouts/header') ?>
<?= $this->include('/dashboard/layouts/sidebar') ?>

<!--begin::App Main-->
<main class="app-main">

    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Visitor Request</h3></div>
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
                            <tr><th>Name</th> <td id="v_name"></td></tr>
                            <tr><th>Email</th> <td id="v_email"></td></tr>
                            <tr><th>Phone</th> <td id="v_phone"></td></tr>
                            <tr><th>Purpose</th> <td id="v_purpose"></td></tr>
                            <tr><th>ID Type</th> <td id="v_id_type"></td></tr>
                            <tr><th>ID Number</th> <td id="v_id_number"></td></tr>
                            <tr><th>Visit Date</th> <td id="v_date"></td></tr>
                            <tr><th>Description</th> <td id="v_desc"></td></tr>
                            <tr><th>QR Code</th> <td><img id="v_qr" src="" width="150"></td></tr>
                            <tr><th>V-Code</th> <td id="v_code"></td></tr>
                            
                            <tr id="action_row"><th>Actions</th> <th id='buttonContainer'></th></tr>
                            <input type="hidden" id="v_id" value="test">
                        </table>
                        </div>
                        <div class="modal-footer">
                        <button class="btn btn-success"  onclick="resendqr()" id="re-sendButton">Re-Send QR</button>
                        <button class="btn btn-danger text-end" data-bs-dismiss="modal">Close</button>
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
                            <div class="input-group input-group-sm mx-2" >
                            <!-- <input type="button" name="add" class="form-control float-right" placeholder="Search"> -->
                            
                            <a href="<?= base_url('visitorequest') ?>" class="btn btn-warning mt-1"> New Request</a>
                            </div>
                        </div>
                        </div>
                        <!-- /.card-header -->
                         <!-- /.card-body -->
                            <div class="card-body table-responsive">
                                <table class="table table-bordered table-striped"  id="visitorTable">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>#</th>
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
    let vcode = $(this).data("vcode")

    approval(id, status,vcode);
});

function resendqr() {

    let name = $("#v_name").text();
    let email = $("#v_email").text();
    let phone = $("#v_phone").text();
    let purpose = $("#v_purpose").text();
    let vid =$('#v_id').val(); // << QR Image URL or Base64
    let v_code =$('#v_code').text(); // V_Code
  
    $.ajax({
        url: "<?= base_url('send-email') ?>",
        type: "POST",
        data: {
            name: name,
            email: email,
            phone: phone,
            purpose: purpose,
            vid: vid,
            v_code: v_code
        },
        dataType: "json",
        success: function(data) {
            if (data.status === "success") {
                Swal.fire({
                    position: 'top-end',
                    toast: true,
                    icon: 'success',
                    title: 'Mail Sent Successfully',
                    showConfirmButton: false,
                    timer: 2000
                });
            } else {

                console.log(data);
                Swal.fire("Error", "Mail Not Sent", "error");
            }
        }
    });
}

function approval(id, status,vcode) {

    $.ajax({
        url: "<?= base_url('/approvalprocess') ?>",
        type: "POST",
        data: { id: id, status: status ,v_code : vcode },
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
            $("#v_id").val(data.id);
            $("#v_code").text(data.v_code);

           
            <?php if($_SESSION['role_id'] == '1' || $_SESSION['role_id'] == '2'){ ?>
              $("#action_row").show();
           <?php }else{?>
              $("#action_row").hide();
            <?php } ?> 

            if (data.qr_code) {
                $("#v_qr").attr("src", "<?= base_url('public/uploads/qr_codes/') ?>" + data.qr_code);
            } else {
                $("#v_qr").attr("src", "");
            }

            let buttons = '- -'
            if(data.status == 'pending'){
                $("#sendButton ").hide();
               buttons = `<button class="btn btn-success btn-sm approvalBtn"
                data-id="${data.id}" data-vcode = "${data.v_code}" data-status="approved">Approve</button>

                <button class="btn btn-danger btn-sm approvalBtn"
                data-id="${data.id}" data-vcode = "${data.v_code}" data-status="rejected">Reject</button>`;
            }else{
                 $("#sendButton ").show();
            }
              $("#buttonContainer").html(buttons);
    
            $("#visitorModal").modal("show");
        }
    });
});


</script>


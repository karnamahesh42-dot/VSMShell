<?= $this->include('/dashboard/layouts/sidebar') ?>
<?= $this->include('/dashboard/layouts/navbar') ?>
<style>
    #visitorModal .card {
        border-radius: 16px !important;
    }
    #visitorModal .table th, 
    #visitorModal .table td {
        vertical-align: middle;
    }
</style>

<main class="main-content" id="mainContent">
        <div class="container-fluid">

                 <!-- Satart view Visitor Request Form Pop-Up  -->
                    <!-- Visitor Request Modal -->
<div class="modal fade" id="visitorModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content shadow-lg rounded-4 border-0">

            <!-- HEADER -->
            <div class="modal-header bg-primary text-white rounded-top-4">
                <h5 class="modal-title">Visitor Request Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <!-- BODY -->
            <div class="modal-body">

                <!-- HEADER INFO CARD -->
                <div class="card mb-4 border-0 shadow-sm rounded-4">
                    <div class="card-body visitor-card">
                        <h5 class="fw-bold mb-3 text-primary">Request Header</h5>
                        <div class="row g-2">

                            <div class="col-md-3">
                                <label class="fw-semibold">Request Code:</label>
                                <div id="h_code" class="text-dark fw-bold"></div>
                            </div>

                            <div class="col-md-3">
                                <label class="fw-semibold">Requested By:</label>
                                <div id="h_requested_by"></div>
                            </div>
                              
                            <div class="col-md-3">
                                <label class="fw-semibold">Company:</label>
                                <div id="h_company"></div>
                            </div>

                             <div class="col-md-3">
                                <label class="fw-semibold">Department</label>
                                <div id="h_department"></div>
                            </div>

                             <div class="col-md-3">
                                <label class="fw-semibold">Visitors Count </label>
                                <div id="h_count"></div>
                            </div>

                             <div class="col-md-3">
                                <label class="fw-semibold">Email</label>
                                <div id="h_email"></div>
                            </div>

                            <div class="col-md-3">
                                <label class="fw-semibold">Purpose </label>
                                <div id="h_purpose">2</div>
                            </div>

                            <div class="col-md-3">
                                <label class="fw-semibold">Visit Date & Time </label>
                                <div id="h_date">2</div>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="fw-semibold">Description </label>
                                <div id="h_description">2</div>
                            </div>

                            <div class="col-md-6">
                                <label class="fw-semibold">Actions</label>
                                <?php if(session()->get('role_id') <= 2){ ?>
                               
                                <div id= "actionBtns"></div>
                                <?php } ?>

                            </div>
                        
                        </div>
                    </div>
                </div>

                <!-- VISITOR CARDS -->
             
                <div class="row g-4" id="visitorCardsContainer"></div>
            </div>
            <!-- FOOTER -->
            <div class="modal-footer justify-content-between">
                <button class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

                <!-- End view Visitor Request Form Pop-Up  -->
                <div class="col-12">
                    <div class="card card-primary visitor-list-card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0">Visitor Request List</h3>

                            <div class="card-header-actions">
                                <a href="<?= base_url('group_visito_request') ?>" class="btn btn-warning mx-1">
                                    <i class="fa-solid fa-users"></i> Group Request
                                </a>

                                <a href="<?= base_url('visitorequest') ?>" class="btn btn-warning mx-1">
                                    <i class="fa-solid fa-user"></i> New Request
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                         <!-- /.card-body -->
                            <div class="card-body table-responsive">
                                <table class="table table-bordered table-hover"  id="visitorTable">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Request ID</th>
                                            <th>Department</th>
                                            <th>Purpose</th>
                                            <th>Description</th>
                                            <th>Visit Date</th>
                                            <th>Visitors Count</th>
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
</main>

<?= $this->include('/dashboard/layouts/footer') ?>

<script>
$(document).ready(function() {
    loadVisitorList();
});

//  CORRECT function
function loadVisitorList() {

    $.ajax({
        url: "<?= base_url('/visitorlistdata') ?>",
        type: "GET",
        dataType: "json",
        success: function(data) {
            // console.log(data);

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
                        <button class="btn btn-success btn-sm approvalBtn mx-1" onclick = approvalProcess(${item.id},'approved','${item.header_code}','') ><i class="fa-solid fa-check"></i></button>
                        <button class="btn btn-danger btn-sm approvalBtn mx-1" onclick = rejectComment(${item.id},'rejected','${item.header_code}','') ><i class="fa-solid fa-xmark"></i></button>
                    `;
                } else {
                    actions = `<span class="text-muted">--</span>`;
                }

                rows += `
                    <tr> 
                        <td onclick="view_visitor(${item.id})">${i++}</td>
                        <td onclick="view_visitor(${item.id})">${item.header_code}</td>
                        <td onclick="view_visitor(${item.id})">${item.department}</td>
                        <td onclick="view_visitor(${item.id})">${item.purpose}</td>
                        <td onclick="view_visitor(${item.id})">${item.description}</td>
                        <td onclick="view_visitor(${item.id})">${item.requested_date}</td>
                        <td onclick="view_visitor(${item.id})">${item.total_visitors ?? ''}</td>
                        <td onclick="view_visitor(${item.id})">${statusBadge}</td>
                        </a>
                         <?php if($_SESSION['role_id'] == '1' || $_SESSION['role_id'] == '2'){?>
                        <td>${actions}</td>
                        <?php } ?>
                        <td>
                        <button class="btn btn-info btn-sm " onclick="view_visitor(${item.id})" >
                        <i class="fa-solid fa-eye"></i>
                        </button>
                        </td>
                    </tr>
                `;
            });

            $("#visitorTable tbody").html(rows);
        }
    });
}


// View Visitor Details Section 
      

// View Visitor Details Section

function view_visitor(id){

    // alert(id);
    $.ajax({
        url: "<?= base_url('getvisitorrequestdata/') ?>" + id,
        type: "GET",
        dataType: "json",

        success: function (res) {

              console.log(res)
            if (res.status !== "success" || res.data.length === 0) {
                alert("No data found");
                return;
            }  

            // Fill header
            let actionButtons = "";
            let h = res.data[0];

            console.log(h)
            console.log(h.status);
            
            if (h.status === "pending" ) {

                    actionButtons = `
                        <button class="btn btn-success btn-sm me-2"
                            onclick="approvalProcess(${h.request_header_id}, 'approved', '${h.header_code}')">
                            <i class="fas fa-check-circle"></i> Approve
                        </button>

                        <button class="btn btn-danger btn-sm"
                            onclick="rejectComment(${h.request_header_id }, 'rejected', '${h.header_code}')">
                            <i class="fas fa-times-circle"></i> Reject
                        </button>
                    `;
                } 
        
            $("#actionBtns").html(actionButtons);
            $("#h_code").text(h.header_code);
            $("#h_requested_by").text(h.requested_by);
            $("#h_department").text(h.department);
            $("#h_email").text(h.email ?? "-");
            $("#h_company").text(h.company);
            
            $("#h_count").text(h.total_visitors);
            $("#h_requested_by").text(h.visitor_created_by_name);
            $("#h_purpose").text(h.purpose);
            $("#h_date").text(h.requested_date +" & "+ h.requested_time);
            $("#h_description").text(h.description);
                           
            
            let cardsHtml = "";

            res.data.forEach(v => {

                let qrImg = v.qr_code 
                    ? `<?= base_url('public/uploads/qr_codes/') ?>${v.qr_code}`
                    : "";
                let resendButton = " <span>--</span>";

                
                if (v.status === "approved") {
                    resendButton = `
                        <button class="btn btn-warning btn-sm w-100"
                            onclick="resendqr('${v.v_code}')">
                            <i class="fas fa-paper-plane"></i> Re-send QR
                        </button>`;
                }

                   cardsHtml += `<div class="col-md-6">
                        <div class="card visitor-card p-4">

                            <div class="row visitor-card-body">

                                <!-- Visitor Details -->
                                <div class="col-8 visitor-details">
                                    <h5 class="visitor-name">
                                        <i class="fas fa-user text-primary me-2"></i> ${v.visitor_name}
                                    </h5>

                                    <p class="visitor-email">${v.visitor_email}</p>
                                    <p class="visitor-code">Code: ${v.v_code}</p>

                                    <p class="visitor-info"><b>Phone:</b> ${v.visitor_phone}</p>
                                    <p class="visitor-info"><b>ID Type:</b> ${v.proof_id_type}</p>
                                    <p class="visitor-info"><b>ID Number:</b> ${v.proof_id_number}</p>
                                    <p class="visitor-info"><b>Visit Date:</b> ${v.visit_date}</p>
                                </div>

                                <!-- QR & Resend -->
                                <div class="col-4 text-center">
                                    <img src="${qrImg}" class="visitor-qr mb-2">

                                    ${v.status === "approved" ? `
                                        <button class="btn btn-warning btn-sm w-100 resend-btn"
                                            onclick="resendqr('${v.v_code}')">
                                            <i class="fas fa-paper-plane"></i> Send QR
                                        </button>` : ""}
                                </div>

                            </div>

                        </div>
                    </div>`;

            });

            $("#visitorCardsContainer").html(cardsHtml);
            $("#visitorModal").modal("show");
        }
    });

}




// Resend QR To Mail Function 
function resendqr() {
    let name = $("#v_name").text();
    let email = $("#v_email").text();
    let phone = $("#v_phone").text();
    let purpose = $("#v_purpose").text();
    let vid = $('#v_id').val(); // << QR Image URL or Base64
    let v_code = $('#v_code').text(); // V_Code
    let qr_path = $('#qr_path').val(); // rq_path
    
    $.ajax({
        url: "<?= base_url('send-email') ?>",
        type: "POST",
        data: {
            name: name,
            email: email,
            phone: phone,
            purpose: purpose,
            vid: vid,
            v_code: v_code,
            qr_path: qr_path
        },
        dataType: "json",
        success: function(data) {
        }
    });

    Swal.fire({
        position: 'top-end',
        toast: true,
        icon: 'success',
        title: 'Mail Sent Successfully',
        showConfirmButton: false,
        timer: 2000
    });
}



function rejectComment(head_id, status, header_code, comment) {
    Swal.fire({
        title: "Reject Visitor Request",
        input: "text",
        inputLabel: "Enter rejection comment",
        inputPlaceholder: "Write your comment...",
        showCancelButton: true,
        confirmButtonText: "Submit",
    }).then((result) => {
        if (result.isConfirmed) {
            let comment = result.value; // user comment
            // Call your approval process with comment
            approvalProcess(head_id, status, header_code, comment);
        }
    });
}



function approvalProcess(head_id, status, header_code, comment) {

    $.ajax({
        url: "<?= base_url('/approvalprocess') ?>",
        type: "POST",
        data: { head_id: head_id, status: status, header_code: header_code, comment : comment},
        dataType: "json",

        success: function (res) {
            if (res.status === "success") {
             Swal.fire({
                    icon: 'success',
                    title: 'Action Completed Successfully!',
                    showConfirmButton: false,
                    timer: 900
                });
                // Call send-email using AJAX
                // sendMail(res.mail_data);
                // console.log(res.mail_data);
           sendMail(JSON.stringify(res.mail_data)); 
                loadVisitorList();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Update Failed!',
                    text: res.message ?? "Please try again",
                    confirmButtonColor: '#d33'
                });
            }
        },
    });
}


function sendMail(maildata) {
    $.ajax({
        url: "<?= base_url('/send-email') ?>",
        type: "POST",
        data:{ mail_data : maildata },
        dataType: "json",
        success: function (mailRes) {
            console.log(mailRes);
        },
        error: function () {
            console.log("Email sending failed");
        }
    });
}


</script>


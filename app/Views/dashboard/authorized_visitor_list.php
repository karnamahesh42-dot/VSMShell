<?= $this->include('/dashboard/layouts/sidebar') ?>
  <?= $this->include('/dashboard/layouts/navbar') ?>
     
  
        <!-- FULLSCREEN QR SCANNER -->
<div id="qrScanner" class="qr-fullscreen">
    <div id="reader"></div>

    <button class="btn btn-danger qr-cancel" onclick="stopScan()">
        ✕ Cancel
    </button>
</div>


   <main class="main-content" id="mainContent">
        <div class="container-fluid">
 
    <!-- view Pop-up Form start  -->
    <div class="modal fade" id="visitorModal">
        <div class="modal-dialog modal-lg">
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
                            <div class="row g-2">

                                <div class="col-md-3 col-6">
                                    <label class="fw-semibold">Request Code:</label>
                                    <div id="h_code" class="cardData text-primary"></div>
                                </div>

                                <div class="col-md-3 col-6">
                                    <label class="fw-semibold">Requested By:</label>
                                    <div id="h_requested_by" class="cardData"></div>
                                </div>

                                <div class="col-md-3 col-6">
                                    <label class="fw-semibold">Referred By:</label>
                                    <div id="referred_by" class="cardData"></div>
                                </div>

                                <div class="col-md-3 col-6">
                                    <label class="fw-semibold">Company:</label>
                                    <div id="h_company" class="cardData"></div>
                                </div>

                                <div class="col-md-3 col-6">
                                    <label class="fw-semibold">Department:</label>
                                    <div id="h_department" class="cardData"></div>
                                </div>

                                <div class="col-md-3 col-6">
                                    <label class="fw-semibold">Visitors Count:</label>
                                    <div id="h_count" class="cardData"></div>
                                </div>

                                <div class="col-md-3 col-6">
                                    <label class="fw-semibold">Email:</label>
                                    <div id="h_email" class="cardData"></div>
                                </div>

                                <div class="col-md-3 col-6">
                                    <label class="fw-semibold">Purpose:</label>
                                    <div id="h_purpose" class="cardData"></div>
                                </div>

                                <div class="col-md-3 col-6">
                                    <label class="fw-semibold">Visit Date & Time:</label>
                                    <div id="h_date" class="cardData"></div>
                                </div>

                                <div class="col-md-6">
                                    <label class="fw-semibold">Description:</label>
                                    <div id="h_description" class="cardData"></div>
                                </div>

                                
                                <div class="col-md-3 col-6">
                                    <label class="fw-semibold">Actions:</label>
                                   
                                    <div id="actionBtns"></div>
                                   
                                </div>
   
   
                                <!-- SINGLE VISITOR DETAILS CARD -->
                                                                <hr>
                                <h5 class="fw-bold text-primary">Visitor Details</h5>
                                <div class="row mt-2">
                                                            
                                <div class="col-md-4 col-6">
                                        <label class="fw-semibold">Visitor Code:</label>
                                        <div id="v_code" class="cardData text-primary"></div>
                                    </div>

                                    <div class="col-md-4 col-6">
                                        <label class="fw-semibold">Visitor Name:</label>
                                        <div id="v_name" class="cardData"></div>
                                    </div>

                                    <div class="col-md-4 col-6">
                                        <label class="fw-semibold">Visitor Phone:</label>
                                        <div id="v_phone" class="cardData"></div>
                                    </div>

                                    <div class="col-md-4 col-6">
                                        <label class="fw-semibold">Visitor Email:</label>
                                        <div id="v_email" class="cardData"></div>
                                    </div>

                                    <div class="col-md-4 col-6">
                                        <label class="fw-semibold">Vehicle No:</label>
                                        <div id="v_vehicle_no" class="cardData"></div>
                                    </div>

                                    <div class="col-md-4 col-6">
                                        <label class="fw-semibold">Vehicle Type:</label>
                                        <div id="v_vehicle_type" class="cardData"></div>
                                    </div>
                                </div>
    
                            </div>
                        </div>
                    </div>

                    <!-- VISITOR CARDS -->
                    <div class="row g-4" id="visitorCardsContainer">
                     

                    </div>
                </div>

                <!-- FOOTER -->
                <div class="modal-footer justify-content-between">
                    <button class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <!-- view Pop-up Form End   -->
 


             <div class="row d-flex justify-content-center">
                <div class="col-md-12">

                  <!-- AUTHORIZED VISITOR LIST -->
                    <div class="card visitor-list-card">
                        <div class="card-header text-white d-flex">
                            <h5 class="mb-0">
                                <i class="fas fa-users"></i> Authorized Visitor List
                            </h5>
                            <!-- <span class="badge bg-light text-success fw-bold" id="authCount">0</span> -->
                        </div>

                        <div class="card-body px-2">
                            <div class="card mb-3">
                              
                                    <div class="card-body" >
                                        <div class="row g-2">
                                            <div class="col-md-2">
                                                <label class="form-label">Request Code</label>
                                            <input type ='text' id="requestcode" placeholder="Enter GV-Code" class="form-control">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">V-Code</label>
                                                <input type ='text' id="f_v_code" placeholder="Enter V-Code" class="form-control">
                                            </div>

                                            <div class="col-md-2">
                                                <label class="form-label">Company</label>
                                                <select id="filterCompany" class="form-select">
                                                    <option value="">All</option>
                                                    <option value="UKMPL">UKMPL</option>
                                                    <option value="DHPL">DHPL</option>
                                                    <option value="ETPL">ETPL</option>
                                                </select>
                                            </div>

                                            <div class="col-md-2">
                                                <label class="form-label">Department</label>
                                                <select id="filterDepartment" class="form-select">
                                                    <option value="">All</option>
                                                    <?php foreach ($departments as $dept): ?>
                                                        <option value="<?= $dept['department_name'] ?>">
                                                            <?= $dept['department_name'] ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <div class="col-md-2">
                                                <label class="form-label">Security Status</label>
                                                <select id="filterSecurity" class="form-select">
                                                    <option value="">All</option>
                                                    <option value="0">Not Entered</option>
                                                    <option value="1">Inside</option>
                                                    <option value="2">Completed</option>
                                                </select>
                                            </div>

                                            <div class="col-md-2 d-flex align-items-end gap-1">

                                                <!-- Search Button -->
                                                <button class="btn btn-primary" onclick="loadAuthorizedVisitors()" title="Search">
                                                    <i class="fas fa-search"></i>
                                                </button>

                                                <!-- Reset Button -->
                                                <button class="btn btn-secondary" onclick="resetFilters()" title="Reset Filters">
                                                    <i class="fas fa-sync-alt"></i>
                                                </button>

                                                <!-- Scan Button -->
                                                <!-- <button class="btn btn-success active" id="scanBtn" onclick="toggleScan()" title="Scan">
                                                      <i class="fas fa-qrcode"></i>
                                                </button> -->

                                                 <!-- Mobile Scan Button -->
                                                <button class="btn btn-success" id="scanBtnMbl">
                                                    <i class="fas fa-qrcode"></i> Scan QR
                                                </button>
                                              


                                              <?php if($_SESSION['role_id'] == '1'){?>
                                                <!-- Export Button -->
                                                <button class="btn btn-success" onclick="exportTable()" title="Export Data">
                                                    <i class="fas fa-file-export"></i>
                                                </button>
                                             <?php }?>
                                            </div>
                                        </div>
                                    </div>

                         </div>
                         <div class="card-body p-0">
                            <div class="table-responsive">                            
                                <table class="table table-hover mb-0  table-bordered">
                                    <thead class="table-light" id="authorizedVisitorTablehead">
                                        <tr>
                                            <!-- <th>S.No</th> -->
                                            <!-- <th>Request Code</th> -->
                                            <!-- <th>V-Code</th> -->
                                            <th>Visit Date</th>
                                            <th>Company</th>
                                            <th>Department</th>
                                            <th>Referred</th>
                                            <th>Rquested By</th>
                                            <th>Visitor</th>
                                            <th>Contact</th>
                                            <th>Purpose</th>
                                            <th>Check-In By</th>
                                            <!-- <th>Check-Out By</th> -->
                                            <th>Validity</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="authorizedVisitorTable" ></tbody>
                                </table>
                            </div>
                          </div>
                        </div>
                    </div>
                    <!-- AUTHORIZED VISITOR LIST  Card End -->
                </div>
            </div>
        </div>
    </main>

<?= $this->include('/dashboard/layouts/footer') ?>
<script src="https://unpkg.com/html5-qrcode"></script>


<!-- JS -->
 <script>
$(document).ready(function () {
    loadAuthorizedVisitors();
    $('#f_v_code').focus();
})
///////////////////////  Auto Scan Logic  ////////////////////////////////////

// function toggleScan() {
//     const scanBtn = document.getElementById('scanBtn');

//     if (scanBtn.classList.contains('active')) {
//         // Inactive state
//         scanBtn.classList.remove('active', 'btn-success');
//         scanBtn.classList.add('btn-secondary');
//     } else {
//         // Active state
//         scanBtn.classList.add('active', 'btn-success');
//         scanBtn.classList.remove('btn-secondary');
//     }
// }

// Listen when user types / scanner fills
document.getElementById('f_v_code').addEventListener('input', function () {
  
    const vCode = this.value.trim();
    // const scanBtn = document.getElementById('scanBtn');
    // // Conditions:
    // if (scanBtn.classList.contains('active') && vCode.length === 7) {
    // }

      if (vCode.length === 7) {
         processSecurity(vCode);
         $('#f_v_code').val('');
      }
     
});



function processSecurity(vCode) {
    $.ajax({
        url: "<?= base_url('/security/securityAction') ?>",
        type: "POST",
        data: { v_code: vCode },
        success: function (res) {

            if (res.status === 'checkin_success') {
                Swal.fire("Success", "Visitor Checked In", "success");
            }
            else if (res.status === 'checkout_success') {
                Swal.fire("Success", "Visitor Checked Out", "success");
            }
            else if (res.status === 'meeting_not_completed') {
                Swal.fire("Warning", "Meeting not completed", "warning");
            }
            else if (res.status === 'invalid') {
                Swal.fire("Denied", res.message, "error");
            }
            else {
                Swal.fire("Error", res.message || "Something went wrong", "error");
            }
           
            $("#visitorModal").modal("hide");
            loadAuthorizedVisitors();
        }
    });
}



////////////////////////////////Mobile Scane Start //////////////////////////////////////////////

let html5QrCode;

document.getElementById('scanBtnMbl').addEventListener('click', () => {

    // Mobile only
    if (window.innerWidth > 768) {
        Swal.fire("Info", "QR scanning is available on mobile only", "info");
        return;
    }

    const scanner = document.getElementById('qrScanner');
    scanner.style.display = 'block';

    html5QrCode = new Html5Qrcode("reader");

    html5QrCode.start(
        { facingMode: "environment" },
        {
            fps: 10,
            qrbox: { width: 260, height: 260 }
        },
        (decodedText) => {
            stopScan();

            const vCode = decodedText.trim();

            if (vCode.length !== 7) {
                Swal.fire("Invalid QR", "Invalid V-Code scanned", "warning");
                return;
            }

            // 🔥 Your existing security flow
            processSecurity(vCode);
        },
        () => {} // ignore errors
    );
});

function stopScan() {
    if (html5QrCode) {
        html5QrCode.stop().then(() => {
            document.getElementById('qrScanner').style.display = 'none';
            html5QrCode.clear();
        }).catch(() => {
            document.getElementById('qrScanner').style.display = 'none';
        });
    }
}

/////////////////////////////////////////End Mobile Scane/////////////////////////////////////////////////////////






////////////////////////// Auto Scan Logic End ////////////////////////////////////

function loadAuthorizedVisitors() {

    $.ajax({
        url: "<?= base_url('/security/authorized_visitors_list_data') ?>",
        type: "GET",
        dataType: "json",
        data: {
            company: $("#filterCompany").val(),
            department: $("#filterDepartment").val(),
            securityCheckStatus: $("#filterSecurity").val(),
            requestcode:  $("#requestcode").val(),
            v_code:   $("#f_v_code").val()
        },
        success: function(res) {

            let tbody = $("#authorizedVisitorTable");
            tbody.empty();

            if (!res.length) {
                tbody.append(`
                    <tr>
                        <td colspan='13' class='text-center text-muted'>No authorized visitors found</td>
                    </tr>
                `);
                return;
            }

            res.forEach((v, index) => {
         
                let statusBadge = "";
             
                if (v.securityCheckStatus == 0) {
                    statusBadge = `
                        <span class="badge bg-secondary p-2">
                            Not Entered
                        </span>
                    `;
                } else if (v.securityCheckStatus == 1 && v.meeting_status == 0) {
                    statusBadge = `
                        <span class="badge bg-primary warning text-lite p-2">
                             Inside <br>
                             Meeting Not Yet Completed <br>
                            In: ${v.check_in_time ?? '-'} <br>
                         
                          
                        </span>
                    `;
                } 
                else if (v.securityCheckStatus == 1 && v.meeting_status == 1){
                      statusBadge = `
                        <span class="badge bg-warning text-dark p-2">
                             Inside <br>
                             Meeting Completed <br>
                            In: ${v.check_in_time ?? '-'} <br>
                          
                          
                        </span>
                    `;
                }else {
                    statusBadge = `
                        <span class="badge bg-success p-2" >
                            Completed <br>
                            In: ${v.check_in_time ?? '-'} <br>
                            Out: ${v.check_out_time ?? '-'} <br>
                          
                        </span>
                    `;
                }


                let validityBadge = "";
                if (v.validity == 1) {
                     validityBadge = `<i class="bi bi-check-circle text-success" style="font-size: 20px; font-weight: bold;"></i>`;
                } 
                else {
                   validityBadge = `<i class="bi bi-x-circle text-danger " style="font-size: 20px; font-weight: bold;"></i>`;
                }

                tbody.append(`
                    <tr onclick="openVisitorPopup('${v.v_code}')">
                        <td>${v.visit_date}</td>
                        <td>${v.company}</td>
                        <td>${v.department_name}</td>
                        <td>${v.referred_by_name}</td>
                        <td>${v.created_by_name}</td>
                        <td>${v.visitor_name}</td>
                        <td>${v.visitor_phone}</td>
                        <td>${v.purpose}</td>
                        <td>${v.check_in_by ? v.check_in_by : '--'}</td>
                        
                        <td>${validityBadge}</td>
                        <td>${statusBadge}</td>
                    </tr>
                `);
            });
        }
    });
}


function resetFilters() {
    $("#filterCompany").val('');
    $("#filterDepartment").val('');
    $("#filterSecurity").val('');
    $("#requestcode").val('');
     $("#f_v_code").val('');
    loadAuthorizedVisitors();
}

function exportTable() {
    let rows = [];
      
     $("#authorizedVisitorTablehead tr").each(function () {
        let cols = [];
        $(this).find("th").each(function () {
            cols.push($(this).text().trim());
        });
        if(cols.length > 0) rows.push(cols.join(","));
    });

    $("#authorizedVisitorTable tr").each(function () {
        let cols = [];
        $(this).find("td").each(function () {
            cols.push($(this).text().trim());
        });
        if(cols.length > 0) rows.push(cols.join(","));
    });

 
    let csvContent = "data:text/csv;charset=utf-8, " 
                     + rows.join("\n");
    // console.log(csvContent);

    let a = document.createElement("a");
    a.href = encodeURI(csvContent);
    a.download = "authorized_visitors.csv";
    a.click();
}

$('#f_v_code').on('keypress', function (e) {
    if (e.which === 13) { // Enter key
        e.preventDefault();

        let v_code = $(this).val().trim();
        if (v_code === '') {
            alert('Please enter V-Code');
            return;
        }

        openVisitorPopup(v_code);
    }
});


function openVisitorPopup(v_code) {

    $.ajax({
        url: "<?= base_url('/get-visitor-details') ?>",
        type: "POST",
        data: { v_code: v_code },
        dataType: "json",
        success: function (d) {
            // console.log(d)
            // HEADER FIELDS
            $("#h_code").text(d.header_code);
            $("#h_requested_by").text(d.created_by_name);
            $("#referred_by").text(d.referred_by_name ?? "-");
            $("#h_company").text(d.company);
            $("#h_department").text(d.department_name);
            $("#h_count").text(d.total_visitors);
            $("#h_email").text(d.visitor_email);
            $("#h_purpose").text(d.purpose);
            $("#h_date").text(d.visit_date + " " + d.visit_time);
            $("#h_description").text(d.description);
            $("#v_name").text(d.visitor_name);
            $("#v_phone").text(d.visitor_phone);
            $("#v_email").text(d.visitor_email);
            $("#v_vehicle_no").text(d.vehicle_no);
            $("#v_vehicle_type").text(d.vehicle_type);
            $("#v_visit_date").text(d.visit_date);
            $("#v_visit_time").text(d.visit_time);
            $("#v_code").text(d.v_code);

 let actionHTML = "";

if (d.securityCheckStatus == 0) {
    // NOT ENTERED → Allow Entry
    actionHTML = `
        <button class="btn btn-success btn-sm" onclick="processSecurity('${d.v_code}')">
            <i class="bi bi-door-open"></i> Allow Entry
        </button>
    `;
}
else if (d.securityCheckStatus == 1) {
    // INSIDE → Mark Exit
    actionHTML = `
        <button class="btn btn-warning btn-sm" onclick="processSecurity('${d.v_code}')" >
            <i class="bi bi-box-arrow-right"></i> Mark Exit
        </button>
    `;
}
else {
    // COMPLETED → No buttons
    actionHTML = `<span class="badge bg-success"><i class="bi bi-check-circle"></i> Completed</span>`;
}


$("#actionBtns").html(actionHTML);
            // Open Modal
            $("#visitorModal").modal("show");
        }
    });
}

</script>

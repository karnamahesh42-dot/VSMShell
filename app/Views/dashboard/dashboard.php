
  <?= $this->include('/dashboard/layouts/sidebar') ?>
  <?= $this->include('/dashboard/layouts/navbar') ?>
        
      <!-- Main Content -->
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

          <!-- ROW 1: Small Cards -->
            <section class="dash-row">
              <?php foreach($smallCards as $c): ?>
                  <div class="card-dash-sm <?= $c['color'] ?>">
                      <div class="left">
                          <div class="title"><?= esc($c['title']) ?></div>
                          <div class="value"><?= esc($c['value']) ?></div>
                      </div>
                      <div class="right">
                          <i class="fa <?= esc($c['icon']) ?> fa-2x"></i>
                      </div>
                  </div>
              <?php endforeach; ?>
            </section>
          <!-- ROW 2: Medium Cards -->
    <section class="dash-row row-medium mb-3">
    <?php foreach($meds as $m): ?>
    <div class="card-dash card-medium">

        <!-- Icon + Title side-by-side -->
        <div class="title-row">
            <i class="fa <?= esc($m['icon']) ?> icon"></i>
            <span class="title"><?= esc($m['title']) ?></span>
        </div>

        <!-- Big Count -->
        <div class="count-number"><?= esc($m['count']) ?></div>

        <!-- Small Description -->
        <div class="muted"><?= esc($m['desc']) ?></div>

    </div>
    <?php endforeach; ?>
</section>

        
          <!-- ROW 3: Pending + Quick Links -->
        <section class="dash-row row-large mb-3">
            <div class="card-dash card-large">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                  <h4 class="mb-0">Pending Approvals</h4>
                  <div class="muted">Requests that need action</div>
                </div>
                <div><a href="<?= base_url('visitorequestlist') ?>" class="btn btn-sm btn-outline-primary">View All</a></div>
              </div>
          <ul class="pending-list mt-2">
              <?php if (!empty($pendingList)): ?>
                  <?php foreach ($pendingList as $item): ?>
                      <li onclick="view_visitor(<?= $item['id'] ?>)" style="cursor:pointer;">
                         <!-- <li onclick="testamile(<?= $item['id'] ?>)" style="cursor:pointer;"> -->
                          
                          <div>
                              <!-- GV Code -->
                              <div class="fw-600">
                                <?= $item['purpose'] ?> - <?= $item['description'] ?>
                                  
                              </div>
                              <!-- Purpose + date + persons -->
                              <small class="muted">
                                  <?= $item['header_code'] ?>  • 
                                  <?= $item['requested_date'] ?> <?= $item['requested_time'] ?> •
                                  <?= $item['total_visitors'] ?> Persons
                              </small>
                          </div>

                          <div class="text-end">
                              <span class="badge-pending"> Pending </span>
                          </div>

                      </li>
                  <?php endforeach; ?>
              <?php else: ?>
                  <li>
                      <div class="text-center text-muted w-100">No pending requests</div>
                  </li>
              <?php endif; ?>
          </ul>
        </div>

            <div class="card-dash card-large">
              <h4 class="mb-3">Quick Links</h4>
              <div class="quick-links">
                <a href="<?= base_url('visitorequest') ?>"><i class="bi bi-person-plus me-2"></i> Create Visitor Request</a>
                <a href="<?= base_url('group_visito_request') ?>"><i class="bi bi-people me-2"></i> Create Group Request</a>
                <a href="<?= base_url('authorized_visitors_list') ?>"><i class="bi bi-card-checklist me-2"></i> Authorized Visitors</a>
                <a href="<?= base_url('security_authorization') ?>"><i class="bi bi-shield-lock-fill me-2"></i> Security Authorization</a>
                <a href="<?= base_url('userlist') ?>"><i class="bi bi-gear me-2"></i> User Management</a>
              </div>
            </div>
          </section>

          <!-- Example Table -->
      <div class="card-dash mb-3">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h5 class="mb-0">Recent Authorized Entries</h5>
            <small class="muted">Latest 10</small>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Visitor</th>
                        <th>Phone</th>
                        <th>Purpose</th>
                        <th>V-Code</th>
                        <th>Check-In</th>
                        <th>Check-Out</th>
                        <th>Status</th> <!-- ⭐ Added -->
                    </tr>
                </thead>

                <tbody>
                    <?php foreach($recentAuthorized as $row): ?>

                    <?php 
                        // STATUS LOGIC
                        if (!empty($row['check_in_time']) && empty($row['check_out_time'])) {
                            $status = "<span class='badge bg-info'>Inside</span>";
                        } 
                        elseif (!empty($row['check_in_time']) && !empty($row['check_out_time'])) {
                            $status = "<span class='badge bg-success'>Completed</span>";
                        } 
                        else {
                            $status = "<span class='badge bg-warning text-dark'>Pending</span>";
                        }
                    ?>

                    <tr>
                        <td><?= $row['visitor_name'] ?></td>
                        <td><?= $row['visitor_phone'] ?></td>
                        <td><?= $row['purpose'] ?></td>
                        <td><?= $row['v_code'] ?></td>
                        <td><?= $row['check_in_time'] ?></td>
                        <td><?= $row['check_out_time'] ?></td>
                        <td><?= $status ?></td> <!-- ⭐ Display Status -->
                    </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

<!-- <test></test> -->
        </div>
      </main>

  <?= $this->include('/dashboard/layouts/footer') ?>

  <script>

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
            sendMail(res.head_id); 
                // loadVisitorList();
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


function sendMail(head_id) {
        $.ajax({
        url: "<?= base_url('/send-email') ?>",
        type: "POST",
        data: { head_id: head_id },   // 🔥 single variable
        success: function(res) {
        console.log(res);
        }
        });
}



// function testamile(head_id){
//      $.ajax({
//     url: "<?= base_url('/send-email') ?>",
//     type: "POST",
//     data: { head_id: head_id },   // 🔥 single variable
//     success: function(res) {
//         console.log(res);
//     }
// });

// }

  </script>
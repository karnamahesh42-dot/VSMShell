<?= $this->include('/dashboard/layouts/header') ?>
<?= $this->include('/dashboard/layouts/sidebar') ?>

<main class="app-main">

    <!-- Page Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">
                        <i class="fas fa-shield-check text-primary"></i> Security Authorization
                    </h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Gate Checkpoint</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">

            <div class="row d-flex justify-content-center">
                <div class="col-md-6">

                    <!-- Search Box -->
               <div class="card shadow-sm border-0 mt-4">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">
            <i class="fas fa-qrcode"></i> Visitor Access Verification
        </h5>
    </div>

    <div class="card-body">
       <div class="row">
          <label class="fw-bold">Scan / Enter V-Code</label>
             <div class="col-9 col-md-9 col-sm-9">
            <input type="text" id="vcodeInput" class="form-control form-control-lg" placeholder="Example: V00001 or Scan QR">
            </div>
           <div class="col-3 col-md-3 col-sm-3">
              <a href="#"  class="btn btn-primary" id="searchBtn">   <i class="fas fa-search"></i> Verify</a>
           </div>
          
            <small class="text-muted mt-2">
                <label><b>Note :</b></label>
                Security can manually enter the V-Code or scan it using a gate QR scanner device.
            </small>
        </div>

    </div>
</div>


                    <!-- Visitor Details Card Start -->

                <div id="visitorDetails" class="card shadow-sm border-0 mt-3 d-none">

                    <div class="card-header bg-success text-white">
                    
                        <h5 class="mb-0">Visitor Information</h5>
                        
                    </div>

                    <div class="card-body">

                        <!-- PROFILE + STATUS IN SAME LINE -->
                        <div class="d-flex justify-content-between align-items-center mb-3">

                            <!-- Profile Section -->
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-light p-3 me-3 border">
                                    <i class="fas fa-user text-primary fa-2x"></i>
                                </div>
                                <div>
                                    <h5 id="vName" class="mb-0 text-primary"></h5>
                                    <span id="vEmail" class="text-muted small"></span>
                                </div>
                            </div>

                            <!-- Status Badge (Right Side) -->
                            <span id="vStatus" class="badge px-3 py-2"></span>

                        </div>

                        <hr>

                        <!-- Two Column Layout -->
                        <div class="row">

                            <div class="col-md-6">
                                <p><b>Phone :</b> <span id="vPhone"></span></p>
                                <p><b>Purpose :</b> <span id="vPurpose"></span></p>
                                <p><b>Group Code :</b> <span id="vGroupCode"></span></p>
                                <p><b>Vehicle No :</b> <span id="vVehicleNo"></span></p>
                            </div>

                            <div class="col-md-6">
                                <p><b>Exp Visit Date :</b> <span id="vExpVisitDate"></span></p>
                                <p><b>Exp Visit Time :</b> <span id="vExpVisitTime"></span></p>
                                <p><b>Id Proof Type :</b> <span id="vIdProofType"></span></p>
                                <p><b>Id Proof No :</b> <span id="vIdProofNo"></span></p>
                            <input type="hidden" id="visitorRequestId">


                            <div class="col-md-12">
                                <p><b>Description:</b> <span id="vDescription"></span></p>
                            </div>

                        </div>

                        <input type="hidden" id="visitorRequestId">
                        <input type="hidden" id="securityCheckStatus">

                        <!-- Action Buttons -->
                        <div class="mt-4">
                            <button class="btn btn-success w-100 mb-2 d-none" id="allowEntryBtn">
                                <i class="fas fa-door-open"></i> Allow Entry
                            </button>

                            <button class="btn btn-danger w-100 d-none" id="markExitBtn">
                                <i class="fas fa-door-closed"></i> Mark Exit
                            </button>
                        </div>
                    </div>
                </div>

                     
                    <!-- Visitor Details Card End -->
                </div>
            </div>

        </div>
    </div>
</main>

<?= $this->include('/dashboard/layouts/footer') ?>


<!-- JS -->
<script>
$("#searchBtn").on('click', function () {
    let vcode = $("#vcodeInput").val().trim();

    if (vcode === "") {
        Swal.fire("Required", "Please enter a V-Code.", "warning");
        return;
    }

    $.ajax({
        url: "<?= base_url('/security/verify') ?>",
        type: "POST",
        data: { v_code: vcode },
        success: function (res) {

            if (res.status === "error") {
                Swal.fire("Not Found", "Visitor record not found!", "error");
                return;
            }

            if (res.status === "not_approved") {
                Swal.fire("Not Approved", "Visitor is not approved yet.", "warning");
                return;
            }

            // SHOW CARD
            $("#visitorDetails").removeClass("d-none");

            // Fill Data
            $("#visitorRequestId").val(res.visitor.id);
            $("#vName").text(res.visitor.visitor_name);
            $("#vPhone").text(res.visitor.visitor_phone);
            $("#vEmail").text(res.visitor.visitor_email);
            $("#vPurpose").text(res.visitor.purpose);
            $("#vTime").text(res.visitor.visit_time);
            $("#vGroupCode").text(res.visitor.group_code);

            $("#vIdProofNo").text(res.visitor.proof_id_number);
            $("#vIdProofType").text(res.visitor.proof_id_type);
            $("#vVehicleNo").text(res.visitor.vehicle_no);
            $("#vExpVisitTime").text(res.visitor.visit_time);
            $("#vExpVisitDate").text(res.visitor.visit_date);
            $("#vDescription").text(res.visitor.description);
            
            // Extra fields based on your JSON
            $("#vCompany").text(res.visitor.group_code ?? "-"); // or company if exists
            $("#vMeetPerson").text(res.visitor.host_user_id ?? "-");

            // STATUS BADGE
            let badge = $("#vStatus");
            badge.removeClass("bg-secondary bg-warning bg-success text-dark");

            if (res.visitor.securityCheckStatus == 0) {
                badge.text("Not Entered").addClass("bg-secondary");
            }
            else if (res.visitor.securityCheckStatus == 1) {
                badge.text("Inside").addClass("bg-warning text-dark");
            }
            else if (res.visitor.securityCheckStatus == 2) {
                badge.text("Completed").addClass("bg-success");
            }

            // ENTRY/EXIT BUTTON LOGIC
            $("#allowEntryBtn").addClass("d-none");
            $("#markExitBtn").addClass("d-none");

            if (res.visitor.securityCheckStatus == 0) {
                $("#allowEntryBtn").removeClass("d-none");  // Show entry button
            }

            if (res.visitor.securityCheckStatus == 1) {
                $("#markExitBtn").removeClass("d-none");    // Show exit button
            }

            // Hide both if completed
            if (res.visitor.securityCheckStatus == 2) {
                $("#allowEntryBtn").addClass("d-none");
                $("#markExitBtn").addClass("d-none");
            }
        }
    });
});



// Allow Entry
$("#allowEntryBtn").on('click', function () {
    $.ajax({
        url: "<?= base_url('/security/checkin') ?>",
        type: "POST",
        data: {
            visitor_request_id: $("#visitorRequestId").val(),
            v_code: $("#vcodeInput").val()
        },
        success: function (res) {
            if (res.status === "exists") {
                Swal.fire("Already Inside", "Visitor already checked in.", "info");
                return;
            }
            Swal.fire("Success", "Visitor entry recorded.", "success");
        }
    });
});


// Mark Exit
$("#markExitBtn").on('click', function () {
    $.ajax({
        url: "<?= base_url('/security/checkout') ?>",
        type: "POST",
        data: { visitor_request_id: $("#visitorRequestId").val() },
        success: function (res) {
            if (res.status === "no_entry") {
                Swal.fire("No Entry", "Visitor has no entry record.", "warning");
                return;
            }
            Swal.fire("Recorded", "Visitor exit recorded.", "success");
        }
    });
});
</script>

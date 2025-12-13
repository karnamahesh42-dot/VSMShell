<?= $this->include('/dashboard/layouts/sidebar') ?>
<?= $this->include('/dashboard/layouts/navbar') ?>

<main class="main-content" id="mainContent">
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card card-primary">
                    <div class="card-header py-2">
                        <h3 class="card-title m-0">Visitor Request</h3>
                    </div>

                    <form id="visitorForm" enctype="multipart/form-data">
                        <div class="card-body">

                            <!-- Visit Info -->
                            <h5 class="text-primary font-weight-bold">Visit Information</h5>
                            <div class="row">

                                <div class="col-md-3 mb-2">
                                    <label>Purpose</label>
                                    <select name="purpose" class="form-control" required>
                                        <option value="">-- Select Purpose --</option>
                                        <option>General Visit</option>
                                        <option>Location Recci</option>
                                        <option>Wedding</option>
                                         <option>Vendor Visit</option>
                                         <option>Delivery</option>
                                        <option>Meeting</option>
                                        <option>Interview</option>
                                        <option>Document Submission</option>
                                        <option>Verification / Approval</option>
                                        <option>Event Visit</option>
                                        <option>Tourism Visit</option>
                                        <option>Personal Visit</option>
                                        <option>Site Inspection</option>
                                        <option>Maintenance / Service</option>
                                        <option>Other</option>
                                    </select>
                                </div>

                                                    
                                <div class="col-md-3 mb-2">
                                    <label>Referred By</label>
                                    <select name="referred_by" class="form-control" required title="Select Referred By">
                                        <!-- <option value="">--Select Admin --</option> -->
                                        <?php if (!empty($admins)) : ?>
                                            <?php foreach ($admins as $admin) : ?>
                                                <option value="<?= $admin['id']; ?>">
                                                    <?= $admin['name']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>


                                <div class="col-md-3 mb-2">
                                    <label>Date of Visit</label>
                                    <input type="date" name="visit_date" class="form-control" required>
                                </div>

                                <div class="col-md-3 mb-2">
                                    <label>Time of Visit</label>
                                    <input type="time" name="visit_time" class="form-control" required>
                                </div>

                                <div class="col-md-12 mb-2">
                                    <label>Description</label>
                                    <textarea name="description" id="description" class="form-control" rows="2"
                                              placeholder="Enter visit purpose details (optional)"></textarea>
                                </div>

                            </div>

                            <!-- Visitor Details -->
                            <h5 class="text-primary font-weight-bold">Visitor Details</h5>
                            <div class="row">

                                <div class="col-md-6 mb-2">
                                    <label>Visitor Name</label>
                                    <input type="text" name="visitor_name" id="visitorName"
                                           class="form-control" placeholder="Enter visitor full name" required>
                                </div>

                                <div class="col-md-6 mb-2">
                                    <label>Email</label>
                                    <input type="email" name="visitor_email" class="form-control"
                                           placeholder="Enter email address" required>
                                </div>

                                <div class="col-md-6 mb-2">
                                    <label>Phone</label>
                                    <input type="text" name="visitor_phone" id="phone"
                                           class="form-control" maxlength="10"
                                           placeholder="Enter phone number" required>
                                </div>

                                <div class="col-md-3 mb-2">
                                    <label>ID Proof Type</label>
                                    <select name="proof_id_type" class="form-control" required>
                                        <option value="">-- Select ID Type --</option>
                                        <option>Aadhar Card</option>
                                        <option>PAN Card</option>
                                        <option>Voter ID</option>
                                        <option>Passport</option>
                                        <option>Driving License</option>
                                        <option>Employee / Student ID</option>
                                        <option>Other</option>
                                    </select>
                                </div>

                                <div class="col-md-3 mb-2">
                                    <label>ID Number</label>
                                    <input type="text" name="proof_id_number" id="idNumber"
                                           class="form-control" placeholder="Enter ID card number" required>
                                </div>

                            </div>


                            <!-- Vehicle Details -->
                            <h5 class="text-primary font-weight-bold">Vehicle Information</h5>
                            <div class="row">

                                <div class="col-md-6 mb-2">
                                    <label>Vehicle Number</label>
                                    <input type="text" name="vehicle_no" id="vehicleNo"
                                           class="form-control" placeholder="Enter vehicle number (optional)">
                                </div>

                                <div class="col-md-6 mb-2">
                                    <label>Vehicle Type</label>
                                    <select name="vehicle_type" class="form-control">
                                        <option value="">-- Select Vehicle Type --</option>
                                        <option>Bike</option>
                                        <option>Car</option>
                                        <option>Van</option>
                                        <option>Bus</option>
                                        <option>Auto</option>
                                        <option>Truck</option>
                                    </select>
                                </div>

                            </div>

                            <!-- Attachments -->
                            <h5 class="text-primary font-weight-bold">Attachments</h5>
                            <div class="row">

                                <div class="col-md-6 mb-2">
                                    <label>Vehicle ID Proof</label>
                                    <input type="file" name="vehicle_id_proof" class="form-control">
                                </div>

                                <div class="col-md-6 mb-2">
                                    <label>Visitor ID Proof</label>
                                    <input type="file" name="visitor_id_proof" class="form-control">
                                </div>

                            </div>

                            <input type="hidden" name="host_user_id" value="<?= $_SESSION['user_id']; ?>">

                        </div>

                        <div class="card-footer py-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="<?= base_url('visitorequestlist') ?>"
                               class="btn btn-danger float-right">Back</a>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</main>

<?= $this->include('/dashboard/layouts/footer') ?>


<!-- =============== VALIDATION + AJAX SUBMIT JS =============== -->
<script>

// Phone Number Validation (only digits + 10 length)
$("#phone").on("input", function () {
    this.value = this.value.replace(/[^0-9]/g, "").slice(0, 10);
});

// Visitor Name Camel Case
$("#visitorName").on("input", function () {
    let val = this.value.toLowerCase().replace(/\b\w/g, c => c.toUpperCase());
    this.value = val;
});

// Visitor Name Camel Case
$("#description").on("input", function () {
    let val = this.value.toLowerCase().replace(/\b\w/g, c => c.toUpperCase());
    this.value = val;
});

// ID number uppercase
$("#idNumber").on("input", function () {
    this.value = this.value.toUpperCase();
});

// Vehicle number uppercase
$("#vehicleNo").on("input", function () {
    this.value = this.value.toUpperCase();
});


// FORM SUBMIT
$("#visitorForm").submit(function(e){
    e.preventDefault();

    // Phone check
    let phone = $("#phone").val();
    if(phone.length !== 10){
        Swal.fire({
            icon: "error",
            title: "Phone number must be 10 digits",
            timer: 1500,
            showConfirmButton: false
        });
        return;
    }

    let formData = new FormData(this);

    $.ajax({
        url: "<?= base_url('/visitorequest/create')?>",
        type: "POST",
        data: formData,
        dataType: "json",
        contentType: false,
        processData: false,
        cache: false,

        success: function(res){
            if(res.status === "success"){
                $("#visitorForm")[0].reset();

                Swal.fire({
                    icon: "success",
                    title: "Visitor Saved Successfully",
                    timer: 1200,
                    showConfirmButton: false
                });

                // setTimeout(() => location.reload(), 800);

                if(res.submit_type === 'admin'){
                    sendMail(res.head_id); 
                }
            }
        },

        error: function(){
            Swal.fire({
                icon: 'error',
                title: 'Something went wrong!',
                timer: 1200,
                showConfirmButton: false
            });
        }
    });
});

// // Send Mail
// function sendMail(postData) {
//     $.ajax({
//         url: "<?= base_url('/send-email') ?>",
//         type: "POST",
//         data: postData,
//         dataType: "json",
//         success: function (mailRes) {
//             console.log("Mail Sent:", mailRes);
//         }
//     });
// }

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



// function sendMail(maildata) {
//     $.ajax({
//         url: "<?= base_url('/send-email') ?>",
//         type: "POST",
//         data:{ mail_data : maildata },
//         dataType: "json",
//         success: function (mailRes) {
//             console.log(mailRes);
//         },
//         error: function () {
//             console.log("Email sending failed");
//         }
//     });
// }

</script>

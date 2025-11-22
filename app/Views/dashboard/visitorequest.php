<?= $this->include('/dashboard/layouts/header') ?>
<?= $this->include('/dashboard/layouts/sidebar') ?>

<!--begin::App Main-->
<main class="app-main">

    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Request Visitor Access</h3></div>
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
                <div class="col-md-6">

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Request Visitor Access</h3>
                        </div>
                            <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-danger">
                            <?= session()->getFlashdata('success') ?>
                            </div>
                            <?php endif; ?>
                        <!-- FORM START -->
                                <form id="visitorForm" >
                                <div class="card-body">

                                <!-- Visitor Name -->
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Visitor Name</label>
                                <div class="col-sm-9">
                                <input type="text" name="visitor_name" class="form-control" placeholder="Enter visitor full name" required>
                                </div>
                                </div>

                                <!-- Email -->
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                <input type="email" name="visitor_email" class="form-control" placeholder="Enter visitor email address" required>
                                </div>
                                </div>

                                <!-- Phone -->
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Phone</label>
                                <div class="col-sm-9">
                                <input type="text" name="visitor_phone" class="form-control" placeholder="Enter phone number (optional)">
                                </div>
                                </div>

                                <!-- NEW: Proof of ID Type -->
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Proof of ID Type</label>
                                <div class="col-sm-9">
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
                                </div>

                                <!-- NEW: Proof of ID Number -->
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ID Number</label>
                                <div class="col-sm-9">
                                <input type="text" name="proof_id_number" class="form-control" placeholder="Enter ID number" required>
                                </div>
                                </div>

                                <!-- Purpose -->
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Purpose</label>
                                <div class="col-sm-9">
                                <select name="purpose" class="form-control" required>
                                <option value="">-- Select Purpose --</option>
                                <option>General Visit</option>
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
                                </div>

                                <!-- Visit Date -->
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Visit Date</label>
                                <div class="col-sm-9">
                                <input type="date" name="visit_date" class="form-control" placeholder="Select visit date" required>
                                </div>
                                </div>

                                <!-- Expected From -->
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Expected From</label>
                                <div class="col-sm-9">
                                <input type="time" name="expected_from" class="form-control" placeholder="Start time">
                                </div>
                                </div>

                                <!-- Expected To -->
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Expected To</label>
                                <div class="col-sm-9">
                                <input type="time" name="expected_to" class="form-control" placeholder="End time">
                                </div>
                                </div>
 
                                <!-- Proof Upload (optional)
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Proof</label>
                                <div class="col-sm-9">
                                <input type="file" name="proof_file" class="form-control" accept="image/*,.pdf">
                                </div>
                                </div> -->

                                <input type="hidden" name="host_user_id" value="<?php echo $_SESSION['user_id']; ?>">
                                </div>

                                <!-- Submit & Cancel Buttons -->
                                <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="<?= base_url('home') ?>" class="btn btn-danger float-right" style="float:right">Back</a>
                                </div>
                                </form>
                                <div id="result"></div>
                        <!-- FORM END -->
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>
<!--end::App Main-->

<?= $this->include('/dashboard/layouts/footer') ?>

<script>
        $("#visitorForm").submit(function(e){
        e.preventDefault();
            $.ajax({
                url: "<?= base_url('/visitorequest/create')?>",
                type: "POST",
                data: $(this).serialize(),
                dataType: "json",

                success: function(res){
                    if(res.status === "success"){
                    $("#visitorForm")[0].reset();
                    Swal.fire({
                    position: 'top-end',
                    toast: true,
                    icon: 'success',
                    title: 'Visitor Saved Successfully',
                    text: '',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    backgroundColor: '#28a745',
                    titleColor: '#fff',
                    })
                    .then((result) => {
                    // // Clear the session variable after toast is dismissed (using AJAX)
                    // $.ajax({
                    //     url: 'clear_session.php',
                    //     success: () => {
                    //         console.log('Session cleared successfully');
                    //     }
                    // });
                    });
                    }
                },
                error: function(){
                      Swal.fire({
                    position: 'top-end',
                    toast: true,
                    icon: 'error',
                    title: 'Something went wrong!', 
                    text: '!',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    backgroundColor: '#cf4040ff',
                    titleColor: '#fff',
                    })
                }
            });
        });
</script>

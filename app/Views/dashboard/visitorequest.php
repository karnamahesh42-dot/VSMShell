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
                <div class="col-md-10">
                    <div class="card card-primary">
                        <div class="card-header py-2">
                            <h3 class="card-title m-0">Visitor Request</h3>
                        </div>

                        <form id="visitorForm" enctype="multipart/form-data">
                            <div class="card-body">

                                <!-- Visitor Details -->
                                <h5 class="text-primary font-weight-bold">Visitor Details</h5>
                                <div class="row">

                                    <div class="col-md-6 mb-2">
                                        <label>Visitor Name</label>
                                        <input type="text" name="visitor_name" class="form-control" placeholder="Enter visitor full name" required>
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <label>Email</label>
                                        <input type="email" name="visitor_email" class="form-control" placeholder="Enter email address" required>
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <label>Phone</label>
                                        <input type="text" name="visitor_phone" class="form-control" placeholder="Enter phone number" required>
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
                                        <input type="text" name="proof_id_number" class="form-control" placeholder="Enter ID card number" required>
                                    </div>

                                </div>

                                <!-- Visit Info -->
                                <h5 class="text-primary font-weight-bold">Visit Information</h5>
                                <div class="row">

                                    <div class="col-md-6 mb-2">
                                        <label>Purpose</label>
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
                                        <textarea name="description" class="form-control" rows="2" placeholder="Enter visit purpose details (optional)"></textarea>
                                    </div>

                                </div>

                                <!-- Vehicle Details -->
                                <h5 class="text-primary font-weight-bold">Vehicle Information</h5>
                                <div class="row">

                                    <div class="col-md-6 mb-2">
                                        <label>Vehicle Number</label>
                                        <input type="text" name="vehicle_no" class="form-control" placeholder="Enter vehicle number (optional)">
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
                                <a href="<?= base_url('visitorequestlist') ?>" class="btn btn-danger float-right">Back</a>
                            </div>

                        </form>
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

    let formData = new FormData(this); // REQUIRED for file upload

    $.ajax({
        url: "<?= base_url('/visitorequest/create')?>",
        type: "POST",
        data: formData,
        dataType: "json",
        contentType: false, // IMPORTANT
        processData: false, // IMPORTANT
        cache: false,

        success: function(res){
            if(res.status === "success"){
                $("#visitorForm")[0].reset();

                Swal.fire({
                    position: 'top-end',
                    toast: true,
                    icon: 'success',
                    title: 'Visitor Saved Successfully',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            }
        },

        error: function(){
            Swal.fire({
                position: 'top-end',
                toast: true,
                icon: 'error',
                title: 'Something went wrong!',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        }
    });
});

</script>

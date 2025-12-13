  <?= $this->include('/dashboard/layouts/sidebar') ?>
<?= $this->include('/dashboard/layouts/navbar') ?>
<main class="main-content" id="mainContent">
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <div class="card card-primary">

                    <!-- CARD HEADER -->
                    <div class="card-header py-2">
                        <h3 class="card-title m-0">Visitor Request</h3>
                    </div>

                    <form id="visitorForm" enctype="multipart/form-data">
                        <div class="card-body">

                            <!-- ********* COMMON HEADER FIELDS ********* -->
                          <div class="row">
                                <div class="col-md-2 mb-2">
                                    <label>Company</label>
                                    <input type="text" name="company" class="form-control" value="<?= session()->get('company_name')?>" placeholder="Enter Company" required readonly>
                                </div>

                                <div class="col-md-2 mb-2">
                                    <label>Department</label>
                                    <input type="text" name="department" class="form-control input-readonly-dark" value="<?= session()->get('department_name')?>" placeholder="Enter Department" required readonly>
                                </div>

                                <div class="col-md-2 mb-2">
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
                                
                                <div class="col-md-2 mb-2">
                                    <label>Visit Date</label>
                                    <input type="date" name="visit_date" class="form-control idNumberField" placeholder="Select Date" required>
                                </div>

                                <div class="col-md-2 mb-2">
                                    <label>Visit Time</label>
                                    <input type="time" name="visit_time" class="form-control" placeholder="Select Time" required>
                                </div>
                                
                                <div class="col-md-2 mb-2">
                                    <label>Email</label>
                                    <input type="email" name="email"  class="form-control" placeholder=" Please Enter Email" required>
                                </div>

                                                     
                                <div class="col-md-2 mb-2">
                                    <label>Referred By</label>
                                    <select name="referred_by" class="form-control" required>
                                        <option value="">--Select Admin --</option>
                                        <?php if (!empty($admins)) : ?>
                                            <?php foreach ($admins as $admin) : ?>
                                                <option value="<?= $admin['id']; ?>">
                                                    <?= $admin['name']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-2">
                                    <label>Description</label>
                                    <textarea name="description"  id="description" class="form-control" rows="1" placeholder="Please Enter Description"></textarea>
                                </div>

                                <!-- ====== Download & Upload Excel Buttons ====== -->
                                <div class="col-md-4 mb-2 d-flex align-items-end gap-2">

                                    <!-- download button -->
                                    <a href="<?= base_url('visitor-template-download') ?>" 
                                    class="btn btn-success me-2">
                                        <i class="fa-solid fa-download"></i> Download Template
                                    </a>

                                    <!-- upload button -->
                                    <label class="btn btn-primary mb-0">
                                        <i class="fa-solid fa-upload"></i> Upload Template File
                                        <input type="file" name="excel_file" id="excelUpload" class="d-none" accept=".xlsx,.xls,.csv">
                                    </label>
                                </div>
                            </div>

                            <hr>

                            <!-- ********* DYNAMIC TABLE ********* -->
                            <div class="table-responsive dynamic-form-table">
                                <table class="table table-bordered" id="visitorGrid">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>S.No</th>
                                            <th>Visitor Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>ID Type</th>
                                            <th>ID Number</th>
                                            <th>Vehicle No</th>
                                            <th>Vehicle Type</th>
                                            <th>Vehicle ID Proof</th>
                                            <th>Visitor ID Proof</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>1</td>

                                            <td><input type="text" name="visitor_name[]" class="form-control nameField" required></td>

                                            <td><input type="email" name="visitor_email[]" class="form-control" required></td>

                                            <td><input type="text" name="visitor_phone[]" class="form-control phoneField" required></td>

                                            <td>
                                                <select name="proof_id_type[]" class="form-control" required>
                                                    <option value="">Select</option>
                                                    <option>Aadhaar Card</option>
                                                    <option>PAN Card</option>
                                                    <option>Voter ID</option>
                                                    <option>Passport</option>
                                                    <option>Driving License</option>
                                                </select>
                                            </td>

                                            <td><input type="text" name="proof_id_number[]" class="form-control idNumberField" required></td>

                                            <td><input type="text" name="vehicle_no[]" class="form-control"></td>

                                            <td>
                                                <select name="vehicle_type[]" class="form-control">
                                                    <option value="">Select</option>
                                                    <option>Bike</option>
                                                    <option>Car</option>
                                                    <option>Van</option>
                                                    <option>Bus</option>
                                                    <option>Auto</option>
                                                    <option>Truck</option>
                                                </select>
                                            </td>

                                            <td class="text-center">
                                                <button type="button" class="btn btn-outline-primary btn-sm uploadBtn">
                                                    <i class="fa-solid fa-file-arrow-up"></i>
                                                </button>
                                                <input type="file" name="vehicle_id_proof[]" class="fileInput d-none">
                                            </td>

                                            <td class="text-center">
                                                <button type="button" class="btn btn-outline-primary btn-sm uploadBtn">
                                                    <i class="fa-solid fa-file-arrow-up"></i>
                                                </button>
                                                <input type="file" name="visitor_id_proof[]" class="fileInput d-none">
                                            </td>

                                            <td>
                                                <button type="button" class="btn btn-success btn-sm addRow"><i class="fa-solid fa-user-plus"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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
</main>

<?= $this->include('/dashboard/layouts/footer') ?>


<!-- Dynamic Row Script -->
<script>
let serial = 1;

$(document).on('click', '.addRow', function () {
    serial++;
    let row = `
        <tr>
            <td>${serial}</td>

            <td><input type="text" name="visitor_name[]" class="form-control" required></td>
            <td><input type="email" name="visitor_email[]" class="form-control" required></td>
            <td><input type="text" name="visitor_phone[]" class="form-control" required></td>

            <td>
                <select name="proof_id_type[]" class="form-control" required>
                    <option value="">Select</option>
                    <option>Aadhaar Card</option>
                    <option>PAN Card</option>
                    <option>Voter ID</option>
                    <option>Passport</option>
                    <option>Driving License</option>
                </select>
            </td>

            <td><input type="text" name="proof_id_number[]" class="form-control" required></td>
            <td><input type="text" name="vehicle_no[]" class="form-control"></td>

            <td>
                <select name="vehicle_type[]" class="form-control">
                    <option value="">Select</option>
                    <option>Bike</option>
                    <option>Car</option>
                    <option>Van</option>
                    <option>Bus</option>
                    <option>Auto</option>
                    <option>Truck</option>
                </select>
            </td>

            <td class="text-center">
                <button type="button" class="btn btn-outline-primary btn-sm uploadBtn">
                    <i class="fa-solid fa-file-arrow-up"></i>
                </button>
                <input type="file" name="vehicle_id_proof[]" class="fileInput d-none">
            </td>

            <td class="text-center">
                <button type="button" class="btn btn-outline-primary btn-sm uploadBtn">
                    <i class="fa-solid fa-file-arrow-up"></i>
                </button>
                <input type="file" name="visitor_id_proof[]" class="fileInput d-none">
            </td>

            <td>
                <button type="button" class="btn btn-danger btn-sm removeRow"><i class="fa-solid fa-user-xmark"></i></button>
            </td>
        </tr>
    `;

    $("#visitorGrid tbody").append(row);
});

$(document).on('click', '.removeRow', function () {
    $(this).closest('tr').remove();
});
</script>


<!-- AJAX Submit -->
<script>
$("#visitorForm").submit(function(e){
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        url: "<?= base_url('/visitorequest/create_group')?>",
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
                timer: 1000,
                showConfirmButton: false
                });
                setTimeout(() => location.reload(), 800);
                    // Send mails only for approved ones
                  if(res.submit_type === 'admin'){
                    sendMail(res.head_id); 
                  }
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

$(document).on('click', '.uploadBtn', function () {
    $(this).closest('td').find('.fileInput').click();
});



// CSV Upload Event
// CSV / Excel Upload Event
$("#excelUpload").change(function () {

    let file = this.files[0];

    if (!file) return;

    // FIX: Define formData before using it
    let formData = new FormData();
    formData.append("excel_file", file);

    $.ajax({
        url: "<?= base_url('visitor-template-upload') ?>",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (res) {

            if (res.status === "success") {

                $("#visitorGrid tbody").html(""); // clear table
                serial = 0;

                res.data.forEach((row) => {
                    serial++;

                    let newRow = `
                        <tr>
                            <td>${serial}</td>

                            <td><input type="text" name="visitor_name[]" 
                                class="form-control" value="${row.visitor_name}" required></td>

                            <td><input type="email" name="visitor_email[]" 
                                class="form-control" value="${row.email}" required></td>

                            <td><input type="text" name="visitor_phone[]" 
                                class="form-control" value="${row.phone}" required></td>

                            <td>
                                <select name="proof_id_type[]" class="form-control" required>
                                    <option value="">Select</option>
                                    <option ${row.id_type == 'Aadhaar Card' ? 'selected' : ''}>Aadhaar Card</option>
                                    <option ${row.id_type == 'PAN Card' ? 'selected' : ''}>PAN Card</option>
                                    <option ${row.id_type == 'Voter ID' ? 'selected' : ''}>Voter ID</option>
                                    <option ${row.id_type == 'Passport' ? 'selected' : ''}>Passport</option>
                                    <option ${row.id_type == 'Driving License' ? 'selected' : ''}>Driving License</option>
                                </select>
                            </td>

                            <td><input type="text" name="proof_id_number[]" 
                                class="form-control" value="${row.id_number}" required></td>

                            <td><input type="text" name="vehicle_no[]" 
                                class="form-control" value="${row.vehicle_no}"></td>

                            <td>
                                <select name="vehicle_type[]" class="form-control">
                                    <option value="">Select</option>
                                    <option ${row.vehicle_type == 'Bike' ? 'selected' : ''}>Bike</option>
                                    <option ${row.vehicle_type == 'Car' ? 'selected' : ''}>Car</option>
                                    <option ${row.vehicle_type == 'Van' ? 'selected' : ''}>Van</option>
                                    <option ${row.vehicle_type == 'Bus' ? 'selected' : ''}>Bus</option>
                                    <option ${row.vehicle_type == 'Auto' ? 'selected' : ''}>Auto</option>
                                    <option ${row.vehicle_type == 'Truck' ? 'selected' : ''}>Truck</option>
                                </select>
                            </td>

                            <td class="text-center">
                                <button type="button" class="btn btn-outline-primary btn-sm uploadBtn">
                                    <i class="fa-solid fa-file-arrow-up"></i>
                                </button>
                                <input type="file" name="vehicle_id_proof[]" class="fileInput d-none">
                            </td>

                            <td class="text-center">
                                <button type="button" class="btn btn-outline-primary btn-sm uploadBtn">
                                    <i class="fa-solid fa-file-arrow-up"></i>
                                </button>
                                <input type="file" name="visitor_id_proof[]" class="fileInput d-none">
                            </td>

                            <td>
                                <button type="button" class="btn btn-danger btn-sm removeRow">
                                    <i class="fa-solid fa-user-xmark"></i>
                                </button>
                            </td>
                        </tr>
                    `;

                    $("#visitorGrid tbody").append(newRow);
                });
            }
        },
        error: function () {
            alert("Error reading uploaded file");
        }
    });
});


    // Visitor Name Camel Case
    $("#description").on("input", function () {
        let val = this.value.toLowerCase().replace(/\b\w/g, c => c.toUpperCase());
        this.value = val;
    });



</script>

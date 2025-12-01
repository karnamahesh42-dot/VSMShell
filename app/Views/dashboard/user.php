       <?= $this->include('/dashboard/layouts/header') ?>
     
       <?= $this->include('/dashboard/layouts/sidebar') ?>
     
       <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">New User</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="<?= base_url('/') ?>" >Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">User</li>
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row d-flex justify-content-center" >

              <!-- /.col-md-6 -->
                <div class="col-md-8">
                    <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">User</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                   <form class="form-horizontal" method="post"  id="createUserForm">
                    <div class="card-body">

                    <!-- Company Name -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Company</label>
                        <div class="col-sm-10">
                            <select name="company_name" class="form-control" required>
                                <option value="">Select Company</option>
                                <option value="UKML">UKML</option>
                                <option value="DHPL">DHPL</option>
                                <option value="ETPL">ETPL</option>
                            </select>
                            <!-- <input type="text" name="company_name" class="form-control" placeholder="Enter Company Name" required> -->
                        </div>
                    </div>

                    <!-- Department Dropdown -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Department</label>
                        <div class="col-sm-10">
                            <select name="department_id" class="form-control" required>
                                <option value="">Select Department</option>
                                <?php foreach ($departments as $dept): ?>
                                <option value="<?= $dept['id'] ?>">
                                <?= esc($dept['department_name']) ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                      <!-- Name Dropdown -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
                        </div>
                    </div>
                      <!-- Email -->
                      <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Email</label>
                          <div class="col-sm-10">
                              <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
                          </div>
                      </div>

                      <!-- Employee Code -->
                      <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Employee Code</label>
                          <div class="col-sm-10">
                              <input type="text" name="employee_code" class="form-control" placeholder="Enter Employee Code" required>
                          </div>
                      </div>
                    <!-- Username -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" name="username" class="form-control" placeholder="Enter Username" required>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
                        </div>
                    </div>

                    <!-- Role Dropdown -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Role</label>
                        <div class="col-sm-10">
                            <select name="role_id" class="form-control" required>
                                <option value="">Select Role</option>
                                <option value="2">Admin</option>
                                <option value="3">User</option>
                                <option value="4">Security</option>
                            </select>
                        </div>
                    </div>

                    </div>
                    <!-- Submit / Cancel Buttons -->
                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save User</button>
                    <a href="<?= base_url('userlist')?>" class="btn btn-danger float-right" style="float:right" >Back</a>
                    <!-- <button type="reset" class="btn btn-default float-right">Back</button> -->
                    </div>
                    </form>

                 </div>
               </div>
              <!-- /.col-md-6 -->
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      <!--end::App Main-->
     
  <?= $this->include('/dashboard/layouts/footer') ?>

  <script>
    $("#createUserForm").on("submit", function(e) {
    e.preventDefault();

    $.ajax({
        url: "<?= base_url('user/create') ?>",
        type: "POST",
        data: $(this).serialize(),
        dataType: "json",

        success: function(res){
            if (res.status === "success") {
                Swal.fire({
                    icon: "success",
                    title: "User Created!",
                    text: res.message,
                    timer: 1500,
                    showConfirmButton: false
                });

                setTimeout(() => {
                    window.location.href = "<?= base_url('userlist') ?>";
                }, 1500);

            } else {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: res.message
                });
            }
        }
    });
});

  </script>
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
              <div class="col-sm-6"><h3 class="mb-0">Dashboard</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page"></li>
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
                <div class="col-md-6">
                    <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">User Form</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                   <form class="form-horizontal" method="post" action="<?= base_url('user/create') ?>">
                    <div class="card-body">

                    <!-- Company Name -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Company</label>
                        <div class="col-sm-10">
                            <input type="text" name="company_name" class="form-control" placeholder="Enter Company Name" required>
                        </div>
                    </div>

                    <!-- Department Dropdown -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Department</label>
                        <div class="col-sm-10">
                            <select name="department_id" class="form-control" required>
                                <option value="">Select Department</option>
                                <option value="1">HR</option>
                                <option value="2">IT</option>
                                <option value="3">Finance</option>
                                <option value="4">Marketing</option>
                            </select>
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
                            </select>
                        </div>
                    </div>

                    </div>

                    <!-- Submit / Cancel Buttons -->
                    <div class="card-footer">
                    <button type="submit" class="btn btn-info">Save User</button>
                    <button type="reset" class="btn btn-default float-right">Cancel</button>
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
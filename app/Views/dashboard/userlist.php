<?= $this->include('/dashboard/layouts/header') ?>
<?= $this->include('/dashboard/layouts/sidebar') ?>

<!--begin::App Main-->
<main class="app-main">

    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Users</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
                        <li class="breadcrumb-item active">User List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!--end::App Content Header-->

    <div class="app-content">
        <div class="container-fluid">
                <div class="row d-flex justify-content-center">
             
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">User List</h3>

                                    <div class="card-tools">
                                    <div class="input-group input-group-sm mx-2">
                                    <!-- <input type="button" name="add" class="form-control float-right" placeholder="Search"> -->
                                    <a href="<?= base_url('user') ?>" class="btn btn-warning mt-1">New User</a>
                                    </div>
                                </div>
                               
                            </div>

                            <div class="card-body table-responsive">
                                <table class="table table-bordered table-striped" id="userTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Company</th>
                                            <th>Department</th>
                                            <th>Username</th>
                                            <th>Role</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php if (!empty($users)): ?>
                                            <?php $i = 1; foreach ($users as $user): ?>
                                                <tr>
                                                    <td><?= $i++ ?></td>
                                                    <td><?= $user['company_name'] ?></td>
                                                    <td><?= $user['department_name'] ?></td>
                                                    <td><?= $user['username'] ?></td>
                                                    <td><?= $user['role_name'] ?></td>
                                                    <td>
                                                        <a href="<?= base_url('user/edit/'.$user['id']) ?>" class="btn btn-sm btn-primary">Edit</a>
                                                        <a href="<?= base_url('user/delete/'.$user['id']) ?>" class="btn btn-sm btn-danger" 
                                                        onclick="return confirm('Are you sure to delete?');">
                                                        Delete
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
               
                                
            </div>

        </div>
    </div>
</main>
<!--end::App Main-->

<?= $this->include('/dashboard/layouts/footer') ?>

<script>



</script>


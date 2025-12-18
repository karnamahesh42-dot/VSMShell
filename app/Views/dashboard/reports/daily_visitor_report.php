<?= $this->include('/dashboard/layouts/sidebar') ?>
<?= $this->include('/dashboard/layouts/navbar') ?>


<main class="main-content" id="mainContent">
   <div class="container-fluid">

          <!-- Edit User Modal -->

<!-- Edit User Modal -->

                <div class="row d-flex justify-content-center">
                    <div class="col-md-12">
                        <div class="card visitor-list-card">
                            <div class="card-header d-flex justify-content-between align-items-center card-header-actions">
                                <h5 class="mb-0">Daily Visitor Report</h5>
                            </div>

                            <div class="card-body table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Requiest ID</th>
                                            <th>V-Code</th>
                                            <th>Visitor</th>
                                            <th>Department</th>
                                            <th>Company</th>
                                            <th>Check-In</th>
                                            <th>Check-Out</th>
                                            <th>Time Spent</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($report as $row): ?>
                                        <tr>
                                            <td><?= $row['group_code'] ?></td>
                                            <td><?= $row['v_code'] ?></td>
                                            <td><?= $row['visitor_name'] ?></td>
                                            <td><?= $row['company'] ?></td>
                                            <td><?= $row['department'] ?></td>
                                            <td><?= $row['check_in_time'] ?></td>
                                            <td><?= $row['check_out_time'] ?? '-' ?></td>
                                            <td><?= $row['spendTime'] ?? '-' ?></td>
                                            <td>
                                                <span class="badge <?= $row['visit_status']=='IN' ? 'bg-success' : 'bg-secondary' ?>">
                                                    <?= $row['visit_status'] ?>
                                                </span>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
   </div>
</main>




<?= $this->include('/dashboard/layouts/footer') ?>

<script>


</script>


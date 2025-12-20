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
                                <h5 class="mb-0">Request to Checkout Report</h5>
                            </div>

                            <div class="card-body table-responsive">
                                <table class="table table-bordered table-hover">
                                   <table class="table table-bordered table-hover table-sm">
                                    <thead class="table-light">
                                        <tr>
                                            <th>S.no</th>
                                            <th>ID</th>
                                            <th>Request ID</th>
                                            <th>Group Code</th>
                                            <th>Visitor Code</th>
                                            <th>Visitor Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Purpose</th>
                                            <th>Description</th>
                                            <th>Visit Date</th>
                                            <th>Visit Time</th>
                                            <th>Department</th>
                                            <th>Company</th>
                                            <th>Total Visitors</th>
                                            <th>Referred By</th>
                                            <th>Vehicle No</th>
                                            <th>Vehicle Type</th>
                                            <th>Proof Type</th>
                                            <th>Proof Number</th>
                                            <th>Check In</th>
                                            <th>Check Out</th>
                                            <th>Time Spent</th>
                                            <th>Meeting Status</th>
                                            <th>Meeting Completed At</th>
                                            <th>Status</th>
                                            <th>Request Created By</th>
                                            <th>Security Check-In By</th>
                                            <th>Security Check-Out By</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                        </tr>
                                    </thead>

                                        <tbody>
                                        <?php $i = 1; foreach ($report as $row): ?>
                                        <tr>
                                             <td><?= $i ?></td>
                                            <td><?= esc($row['id']) ?></td>
                                            <td><?= esc($row['request_header_id']) ?></td>
                                            <td><?= esc($row['group_code']) ?></td>
                                            <td><?= esc($row['v_code']) ?></td>
                                            <td><?= esc($row['visitor_name']) ?></td>
                                            <td><?= esc($row['visitor_email']) ?></td>
                                            <td><?= esc($row['visitor_phone']) ?></td>
                                            <td><?= esc($row['purpose']) ?></td>
                                            <td><?= esc($row['description']) ?></td>
                                            <td><?= esc($row['visit_date']) ?></td>
                                            <td><?= esc($row['visit_time']) ?></td>

                                            <td><?= esc($row['department']) ?></td>
                                            <td><?= esc($row['company']) ?></td>
                                            <td><?= esc($row['total_visitors']) ?></td>
                                            <td><?= esc($row['referred_by'] ?? '-') ?></td>

                                            <td><?= esc($row['vehicle_no']) ?></td>
                                            <td><?= esc($row['vehicle_type']) ?></td>
                                            <td><?= esc($row['proof_id_type']) ?></td>
                                            <td><?= esc($row['proof_id_number']) ?></td>

                                            <td><?= $row['check_in_time'] ?? '-' ?></td>
                                            <td><?= $row['check_out_time'] ?? '-' ?></td>
                                            <td><?= esc($row['spendTime'] ?? '-') ?></td>

                                            <td>
                                                <?= $row['meeting_status'] ? 'Completed' : 'Pending' ?>
                                            </td>

                                            <td><?= esc($row['meeting_completed_at'] ?? '-') ?></td>

                                            <td><?= esc($row['status']) ?></td>

                                            <td><?= esc($row['rqst_created_by'] ?? '-') ?></td>
                                            <td><?= esc($row['s_checkin_by'] ?? '-') ?></td>
                                            <td><?= esc($row['s_checkout_by'] ?? '-') ?></td>

                                            <td><?= esc($row['created_at']) ?></td>
                                            <td><?= esc($row['updated_at']) ?></td>
                                        </tr>

                                        <?php $i++; endforeach; ?>
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


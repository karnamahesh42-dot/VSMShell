<?= $this->include('/dashboard/layouts/header') ?>
<?= $this->include('/dashboard/layouts/sidebar') ?>

<!--begin::App Main-->
<main class="app-main">

    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Visitor Request Data</h3></div>
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
        
                    <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                        <h3 class="card-title">Visitor Request Data</h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                            <!-- <input type="button" name="add" class="form-control float-right" placeholder="Search"> -->
                            
                            <a href="<?= base_url('visitorequest') ?>" class="btn btn-warning "> New Request</a>


                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                                </button>
                            </div>
                            </div>
                        </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                          <table class="table table-hover text-nowrap" id="visitorTable">
                                <thead>
                                    <tr>
                                        <th>S No</th>
                                        <th>Visitor</th>
                                        <th>Date</th>
                                        <th>Reason</th>
                                        <th>Phone No</th>
                                        <th>Status</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>

        </div>
    </div>
</main>
<!--end::App Main-->

<?= $this->include('/dashboard/layouts/footer') ?>

<script>
$(document).ready(function() {
    
    loadVisitorList();

    function loadVisitorList() {
        $.ajax({
            url: "<?= base_url('/visitorlistdata') ?>",
            type: "GET",
            dataType: "json",
            success: function(data) {

                let rows = "";
                let i = 1;
                data.forEach(function(item){
                    rows += `
                        <tr>
                            <td>${i}</td>
                            <td>${item.visitor_name}</td>
                            <td>${item.created_at}</td>
                            <td>${item.purpose}</td>
                            <td>${item.visitor_phone}</td>
                            <td><span class="tag tag-${statusColor(item.status)}">${item.status}</span></td>
                        </tr>
                    `;
                    i++;
                });

                $("#visitorTable tbody").html(rows);
            }
        });
    }

    function statusColor(status){
        if(status === "Approved") return "success";
        if(status === "Pending") return "warning";
        if(status === "Denied") return "danger";
        return "primary";
    }

});
</script>


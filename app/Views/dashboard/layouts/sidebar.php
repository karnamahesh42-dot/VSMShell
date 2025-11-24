<!--begin::Sidebar-->
      <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="#" class="brand-link">
            <!--begin::Brand Image-->
            <!-- <img
              src="./assets/img/AdminLTELogo.png"
              alt="AdminLTE Logo"
              class="brand-image opacity-75 shadow"
            /> -->
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
        
            <span class="brand-text" style=" font-weight: bold">Smart VMS Portal</span>
            <!--end::Brand Text-->
          </a>
          <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="navigation"
              aria-label="Main navigation"
              data-accordion="false"
              id="navigation" >
              
            <?php if($_SESSION['role_id'] == '1' || $_SESSION['role_id'] == '2'){?>
              <li class="nav-item">
                <a href="<?= base_url('userlist') ?>" class="nav-link">
                  <i class="nav-icon bi bi-circle-fill text-warning"></i>
                  <p>Users</p>
                </a>
              </li>
            <?php }?>

              <li class="nav-item">
                <a href="<?= base_url('visitorequestlist') ?>" class="nav-link">
                  <i class="nav-icon bi bi-circle-fill text-warning"></i> 
                  <p>Visitor request</p>
                </a>
              </li>
            </ul>
            <!--end::Sidebar Menu-->
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>
      <!--end::Sidebar-->
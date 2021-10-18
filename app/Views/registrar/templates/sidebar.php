<div class="page-wrapper chiller-theme toggled">
  <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
    <i class="fas fa-bars"></i>
  </a>
  <nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
      <!-- sidebar-brand -->
      <div class="sidebar-brand">
        <img src="<?= site_url()?>assets/images/school_logo.png" alt="" class="img-fluid" style="width: 40px">
        <a href="#" class="px-2 text-dark">LHS-ES</a>
        <div id="close-sidebar">
          <i class="fas fa-times"></i>
        </div>
      </div>
      
      <!-- sidebar-header -->
      <div class="sidebar-header">
        <div class="user-pic">
          <img class="img-responsive img-rounded-start" src="<?= site_url()?>assets/images/user.jpg" alt="User picture">
        </div>
        <div class="user-info text-secondary">
          <span class="user-name">
            <strong>John Doe</strong>
          </span>
          <span class="user-role text-dark">Registrar Staff</span>
          <span class="user-status">
            <i class="fa fa-circle text-success"></i>
            <span class="text-dark">Online</span>
          </span>
        </div>
      </div>
      <div class="sidebar-search">
        <div>
          <!-- sidebar-search -->
          <div class="input-group">
            <input type="text" class="form-control search-menu" placeholder="Search...">
            <div class="input-group-append">
              <span class="input-group-text h-100">
                <i class="fa fa-search" aria-hidden="true"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
      
      <?php 
      $uri = service('uri');
      $page = $uri->getSegment(2);
      ?>
      <!-- sidebar-menu  -->
      <div class="py-2 sidebar-menu">
        <ul>
          <!-- dashboard nav link -->
          <li class="sidebar-dropdown <?= ($page == 'dashboard') ? 'active' : ''?>">
            <a href="<?= site_url()?>r/dashboard">
              <i class="fa fa-tachometer-alt fa-fw"></i>
              <span class="ps-1">Dashboard</span>
            </a>
          </li>

          <!-- course management nav link -->
          <li class="sidebar-dropdown <?= ($page == 'crs_mgt') ? 'active' : ''?>">
            <a href="#">
              <i class="far fa-list-alt fa-fw"></i>
              <span class="ps-1">Course Management</span>
            </a>
            <div class="sidebar-submenu <?= ($page == 'crs_mgt' || $page == 'crs_schedule') ? 'd-block' : ''?>">
              <ul>
                <li>
                  <a href="<?= site_url()?>r/crs_mgt" class="<?= ($page == 'crs_mgt') ? 'active bg-white rounded-start shadow-sm' : ''?>">Manage Course
                  </a>
                </li>
                <li>
                  <a href="<?= site_url()?>r/crs_schedule" class="<?= ($page == 'crs_schedule') ? 'active bg-white rounded-start shadow-sm' : ''?>">Schedule</a>
                </li>
              </ul>
            </div>
          </li>

          <!-- enrollment nav link -->
          <li class="sidebar-dropdown <?= ($page == 'enrollments' || $page == 'payment' || $page == 'assessment') ? 'active' : ''?>">
            <a href="#">
              <i class="far fa-address-card fa-fw"></i>
              <span class="ps-1">Enrollment</span>
            </a>
            <div class="sidebar-submenu <?= ($page == 'enrollments' || $page == 'payment' || $page == 'assessment') ? 'd-block' : ''?>">
              <ul>
                <li>
                  <a href="<?= site_url()?>r/enrollments" class="<?= ($page == 'enrollments' || $page == 'assessment') ? 'active bg-white rounded-start shadow-sm' : ''?>">Assessment
                  </a>
                </li>
                <li>
                  <a href="<?= site_url()?>r/payment" class="<?= ($page == 'payment') ? 'active bg-white rounded-start shadow-sm' : ''?>">Payment</a>
                </li>
              </ul>
            </div>
          </li>

          <!-- ESC voucher -->
          <li class="sidebar-dropdown <?= ($page == 'esc_request' || $page == 'esc_approved' || $page == 'esc_denied') ? 'active' : ''?>">
            <a href="#">
              <i class="fas fa-tags fa-fw"></i>
              <span class="ps-1">ESC Voucher</span>
            </a>
            <div class="sidebar-submenu <?= ($page == 'esc_request' || $page == 'esc_approved' || $page == 'esc_denied') ? 'd-block' : ''?>">
              <ul>
                <li>
                  <a href="<?= site_url()?>r/esc_request" class="<?= ($page == 'esc_request') ? 'active bg-white rounded-start shadow-sm' : ''?>">Verification</a>
                </li>
                <li>
                  <a href="<?= site_url()?>r/esc_approved" class="<?= ($page == 'esc_approved') ? 'active bg-white rounded-start shadow-sm' : ''?>">Approved</a>
                </li>
                <li>
                  <a href="<?= site_url()?>r/esc_denied" class="<?= ($page == 'esc_denied') ? 'active bg-white rounded-start shadow-sm' : ''?>">Denied</a>
                </li>
              </ul>
            </div>
          </li>

          <!-- faculty -->
          <li class="sidebar-dropdown <?= ($page == 'teacher_list') ? 'active' : ''?>">
            <a href="#">
              <i class="fa fa-users fa-fw"></i>
              <span class="ps-1">Teachers</span>
            </a>
            <div class="sidebar-submenu <?= ($page == 'teacher_list') ? 'd-block' : ''?>">
              <ul>
                <li>
                  <a href="<?= site_url()?>r/teacher_list" class="<?= ($page == 'teacher_list') ? 'active bg-white rounded-start shadow-sm' : ''?>">List of Teachers</a>
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </div>

      <div class="py-2 sidebar-menu">
        <ul>
          <li>
            <a href="<?= site_url()?>r/signout">
              <i class="fa fa-sign-out-alt fa-fw"></i>
              <span class="ps-1">Sign Out</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="sidebar-footer p-3">
      <a href="#">
        <i class="far fa-copyright"></i> <span>2021 LNHS-ES</span>
      </a>
    </div>
  </nav>  
<!-- page-wrapper -->
  <div class="page-content">
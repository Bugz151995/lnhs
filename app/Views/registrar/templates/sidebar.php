<div class="page-wrapper chiller-theme toggled">
  <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
    <i class="fas fa-bars"></i>
  </a>
  <nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
      <!-- sidebar-brand -->
      <div class="sidebar-brand">
        <img src="<?= site_url()?>assets/images/school_logo.png" alt="" class="img-fluid" style="width: 40px">
        <a href="#" class="px-2 text-dark">LNHS-ES</a>
        <div id="close-sidebar">
          <i class="fas fa-times"></i>
        </div>
      </div>
      
      <!-- sidebar-header -->
      <div class="sidebar-header">
        <div class="user-pic">
          <img class="img-responsive img-rounded" src="<?= site_url()?>assets/images/user.jpg" alt="User picture">
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
                  <a href="<?= site_url()?>r/crs_mgt" class="<?= ($page == 'crs_mgt') ? 'active' : ''?>">Tracks and Strands
                  </a>
                </li>
                <li>
                  <a href="<?= site_url()?>r/crs_schedule" class="<?= ($page == 'crs_schedule') ? 'active' : ''?>">Schedule</a>
                </li>
              </ul>
            </div>
          </li>

          <!-- enrollment nav link -->
          <li class="sidebar-dropdown <?= ($page == 'enroll_request' || $page == 'validation' || $page == 'payment') ? 'active' : ''?>">
            <a href="#">
              <i class="far fa-address-card fa-fw"></i>
              <span class="ps-1">Enrollment</span>
            </a>
            <div class="sidebar-submenu <?= ($page == 'enroll_request' || $page == 'validation' || $page == 'payment') ? 'd-block' : ''?>">
              <ul>
                <li>
                  <a href="<?= site_url()?>r/enroll_request" class="<?= ($page == 'enroll_request') ? 'active' : ''?>">Pending
                  </a>
                </li>
                <li>
                  <a href="<?= site_url()?>r/validation" class="<?= ($page == 'validation') ? 'active' : ''?>">Admission</a>
                </li>
                <li>
                  <a href="<?= site_url()?>r/payment" class="<?= ($page == 'validation') ? 'active' : ''?>">Payment</a>
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
                  <a href="<?= site_url()?>r/esc_request">Verification</a>
                </li>
                <li>
                  <a href="<?= site_url()?>r/esc_approved">Approved</a>
                </li>
                <li>
                  <a href="<?= site_url()?>r/esc_denied">Denied</a>
                </li>
              </ul>
            </div>
          </li>

          <!-- Reports -->
          <li class="sidebar-dropdown <?= ($page == 'rep_masterlist' || $page == 'rep_escvoucher' || $page == 'rep_payment') ? 'active' : ''?>">
            <a href="#">
              <i class="fa fa-chart-line fa-fw"></i>
              <span class="ps-1">Reports</span>
            </a>
            <div class="sidebar-submenu <?= ($page == 'rep_masterlist' || $page == 'rep_escvoucher' || $page == 'rep_payment') ? 'd-block' : ''?>">
              <ul>
                <li>
                  <a href="<?= site_url()?>r/rep_masterlist">Masterlist</a>
                </li>
                <li>
                  <a href="<?= site_url()?>r/rep_escvoucher">ESC Voucher</a>
                </li>
                <li>
                  <a href="<?= site_url()?>r/rep_payment">Payment</a>
                </li>
              </ul>
            </div>
          </li>

          <!-- Account -->
          <li class="sidebar-dropdown <?= ($page == 'acc_request' || $page == 'acc_activated') ? 'active' : ''?>">
            <a href="#">
              <i class="fas fa-user-cog fa-fw"></i>
              <span class="ps-1">Account</span>
            </a>
            <div class="sidebar-submenu <?= ($page == 'acc_request' || $page == 'acc_activated') ? 'd-block' : ''?>">
              <ul>
                <li>
                  <a href="<?= site_url()?>r/acc_request">Request</a>
                </li>
                <li>
                  <a href="<?= site_url()?>r/acc_activated">Activated Account</a>
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </div>

      <div class="py-2 sidebar-menu">
        <ul>
          <li>
            <a href="#">
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
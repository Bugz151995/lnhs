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
          <img class="img-responsive img-rounded" src="<?= site_url()?>assets/images/user.jpg" alt="User picture">
        </div>
        <div class="user-info text-secondary">
          <span class="user-name">
            <strong>
              <?= $admin['firstname'].' ' ?>
              <?php if($admin['middlename']) : ?>
                <?= substr($admin['middlename'], 0, 1).'. ' ?>
              <?php endif ?>
              <?= $admin['lastname'] ?>
            </strong>
          </span>
          <span class="user-role text-dark">Admin</span>
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
            <label for="" class="form-control bg-light border-0">Menu</label>
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
            <a href="<?= site_url()?>a/dashboard">
              <i class="fa fa-tachometer-alt fa-fw"></i>
              <span class="ps-1">Dashboard</span>
            </a>
          </li>

          <!-- Account -->
          <li class="sidebar-dropdown <?= ($page == 'request' || $page == 'acc_activated' || $page == 'r_request') ? 'active' : ''?>">
            <a href="#">
              <i class="fas fa-user-cog fa-fw"></i>
              <span class="ps-1">Account</span>
            </a>
            <div class="sidebar-submenu <?= ($page == 'request' || $page == 'acc_activated' || $page == 'r_request') ? 'd-block' : ''?>">
              <ul>
                <li>
                  <a href="<?= site_url()?>a/request" class="<?= ($page == 'request' || $page == 'r_request') ? "text-primary" : '' ?>">Request</a>
                </li>
              </ul>
            </div>
          </li>

          <!-- change password link -->
          <li class="sidebar-dropdown <?= ($page == 'changepass') ? 'active' : ''?>">
            <a href="<?= site_url()?>a/changepass">
              <i class="fa fa-lock-open fa-fw"></i>
              <span class="ps-1">Change Password</span>
            </a>
          </li>

          <!-- change user credentials link -->
          <li class="sidebar-dropdown <?= ($page == 'updateaccount') ? 'active' : ''?>">
            <a href="<?= site_url()?>a/updateaccount">
              <i class="fa fa-user-shield fa-fw"></i>
              <span class="ps-1">Update My Account</span>
            </a>
          </li>
        </ul>
      </div>

      <div class="py-2 sidebar-menu">
        <ul>
          <li>
            <a href="<?= site_url()?>a/signout">
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
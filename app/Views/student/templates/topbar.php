  <header class="bg-primary">
    <nav class="container navbar navbar-expand-lg navbar-dark">
      <div class="container-fluid">
        <a class="navbar-brand d-flex gap-2 align-items-center" href="<?= site_url()?>">
          <img src="<?= site_url()?>assets/images/school_logo.png" alt="" width="40" class="img-fluid">
          <span class="d-none d-sm-block">Lagonoy High School</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <?php
          $uri = service('uri');
          $page = $uri->getSegment(1);
        ?>
        <div class="collapse navbar-collapse offset justify-content-end" id="navbarSupportedContent">
          <ul class="nav navbar-nav ">
            <li class="nav-item">
              <a class="nav-link <?= ($page == '') ? 'active' : ''?>" aria-current="page" href="<?= site_url()?>">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?= ($page == 'enrollment') ? 'active' : ''?>" href="<?= site_url()?>enrollment">Enrollment</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?= ($page == 'esc_registration') ? 'active' : ''?>" href="<?= site_url()?>esc_registration">ESC Voucher Registration</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?= ($page == 'about') ? 'active' : ''?>" href="<?= site_url()?>about">About Us</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
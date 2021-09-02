<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= site_url()?>css/main.css">
    <title>Enrollment Request</title>

  </head>
  <body class="bg-light">
    <header class="bg-white">
      <nav class="container navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
          <a class="navbar-brand d-flex gap-2 align-items-center" href="#">
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
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
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
    <main>
      <div class="container text-center shadow p-5 mt-5">
        <h1><i class="fas fa-check-circle text-success fa-5x"></i></h1>
        <h5 class="text-success">Your enrollment has been successfully submitted!</h5>
        <p class="pt-4">Your enrollment is now being processed. Please keep all your contact number open for further anouncement and clarifications.<br> Thank you and have a Great day!</p>
        <a href="<?= site_url()?>" class="btn btn-primary mt-4">Okay</a>
      </div>
    </main>
  </body>
  <!-- bootstrap js bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <!-- fontawesome -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</html>
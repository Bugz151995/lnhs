<main class="container">  
  <div>
    <section class="row py-4 py-sm-0 px-2">
      <div class="col-sm-7 text-center text-sm-start d-flex justify-content-center flex-column">
        <h4>ESC Registration Made Easy</h4>
        <p>Lagonoy High School now offers online enrollment for incoming Senior High School Students</p>
        <div class="container p-0">
          <a href="<?= site_url()?>enrollment" class="btn btn-sm btn-primary">
            <i class="fas fa-chevron-right"></i> Enroll Now
          </a>
        </div>
      </div>
      <div class="col-sm-5">
        <img src="<?= site_url()?>assets/images/study.jpg" alt="" class="img-fluid">
      </div>
    </section>

    <section class="row row-cols-sm-3 g-sm-5 mx-4">
      <div class="col text-center text-sm-start">
        <div class="bg-secondary rounded p-4 text-light">
          <i class="fas fa-list-alt fa-fw fa-4x"></i>
          <h5 class="py-3">Online ESC Registration</h5>
          <p>Our School offers enrollment on the go. Enroll wherever you are.</p>
          <a href="#" class="btn btn-sm btn-dark">
            <i class="fas fa-chevron-right"></i> Read More
          </a>
        </div>
      </div>

      <div class="col text-center text-sm-start">
        <div class="bg-dark rounded p-4 text-light">
          <i class="fas fa-ticket-alt fa-fw fa-4x"></i>
          <h5 class="py-3">ESC Voucher</h5>
          <p>Our School also offers processing of ESC Vouchers online.</p>
          <a href="#" class="btn btn-sm btn-secondary">
            <i class="fas fa-chevron-right"></i> Read More
          </a>
        </div>
      </div>

      <div class="col text-center text-sm-start">
        <div class="bg-secondary rounded p-4 text-light">
          <i class="fas fa-users fa-fw fa-4x"></i>
          <h5 class="py-3">Faculty Search</h5>
          <p>Our School allows transparency with our faculty and staff.</p>
          <a href="#" class="btn btn-sm btn-dark">
            <i class="fas fa-chevron-right"></i> Read More
          </a>
        </div>
      </div>
    </section>

    <section class="row py-5">
      <div class="col-sm-5">
        <img src="<?= site_url()?>assets/images/study_2.jpg" alt="" class="img-fluid">
      </div>
      <div class="col-sm-7 text-center text-sm-start d-flex justify-content-center flex-column">
        <h4>ESC Voucher Registration</h4>
        <p>Lagonoy High School also offers online processing of eligible ESC grantees, it is made easy and user-friendly.</p>
        <div class="container p-0">
          <a href="<?= site_url()?>esc_registration" class="btn btn-sm btn-primary">
            <i class="fas fa-chevron-right"></i> Register Now
          </a>
        </div>
      </div>
    </section>
  </div>

  <!-- enrolment form -->
  <?= form_open('esc/auth')?>
    <!-- trigger -->
    <a class="btn btn-sm btn-primary d-none" id="escBtn" data-bs-toggle="modal" href="#page0" role="button"></a>

    <!-- PAGE 1 -->
    <!-- other family info -->
    <div class="modal fade" id="page0" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" aria-hidden="true" aria-labelledby="page0Label" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header bg-primary text-light">
            <h5 class="modal-title" id="page0Label"><i class="fas fa-list fa-fw me-1"></i>ESC Registration Form</h5>
            <a href="<?= site_url()?>" class="btn-close"></a>
          </div>
          <div class="modal-body">
            <!-- field -->
            <?php if(session()->getTempData('error')): ?>
              <div class="alert alert-danger">
                <strong>Oops!</strong> 
                <?= session()->getTempData('error') ?>
              </div>
            <?php endif ?>
            <div class="row row-cols-1 row-cols-lg-3 g-3 mb-3">
              <div class="col">
                <label for="fname" class="form-label"><span class="text-danger">*</span>Firstname</label>
                <input type="text" name="fname" id="fname" class="form-control form-control-sm" placeholder="Firstname here">
                <?php if(isset($validation) && $validation->getError('fname')): ?>
                  <span class="text-danger fst-italic"><i class="fas fa-exclamation-triangle me-1"></i><?= $validation->getError('fname') ?></span>
                <?php endif ?>
              </div>
              <div class="col">
                <label for="mname" class="form-label"><span class="text-danger">*</span>Middlename</label>
                <input type="text" name="mname" id="mname" class="form-control form-control-sm" placeholder="Middlename here">
                <?php if(isset($validation) && $validation->getError('mname')): ?>
                  <span class="text-danger fst-italic"><i class="fas fa-exclamation-triangle me-1"></i><?= $validation->getError('mname') ?></span>
                <?php endif ?>
              </div>
              <div class="col">
                <label for="lname" class="form-label"><span class="text-danger">*</span>Lastname</label>
                <input type="text" name="lname" id="lname" class="form-control form-control-sm" placeholder="Lastname here">
                <?php if(isset($validation) && $validation->getError('lname')): ?>
                  <span class="text-danger fst-italic"><i class="fas fa-exclamation-triangle me-1"></i><?= $validation->getError('lname') ?></span>
                <?php endif ?>
              </div>
            </div>
            
            <div class="text-danger fst-italic mb-3">Please input the email you used during the enrollment/or when you request a token during the enrollment process.</div>
            <div class="mb-3">
              <label for="email" class="form-label"><span class="text-danger">*</span> Email</label>
              <input type="text" name="email" id="email" class="form-control form-control-sm" placeholder="email">
              <?php if(isset($validation) && $validation->getError('email')): ?>
                <span class="text-danger fst-italic"><i class="fas fa-exclamation-triangle me-1"></i><?= $validation->getError('email') ?></span>
              <?php endif ?>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-sm btn-primary">Next<i class="fas fa-arrow-right ms-1"></i></button>
          </div>
        </div>
      </div>
    </div>
  <?= form_close()?>
</main>

<script>
  document.addEventListener('DOMContentLoaded', ()=>{
    const trigger = document.getElementById('escBtn');
    trigger.click();
  });
</script>
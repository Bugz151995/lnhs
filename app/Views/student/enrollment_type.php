<main class="container">
  <div>
    <section class="row py-5 my-5 py-sm-0 px-2">
      <div class="col-sm-7 text-center text-sm-start d-flex justify-content-center flex-column">
        <h4>Enrollment Made Easy</h4>
        <p>Lagonoy High School now offers online enrollment for incoming Senior High School Students</p>
        <div class="container p-0">
          <a href="<?= site_url() ?>enrollment" class="btn btn-primary">
            <i class="fas fa-chevron-right"></i> Enroll Now
          </a>
        </div>
      </div>
      <div class="col-sm-5">
        <img src="<?= site_url() ?>assets/images/study.jpg" alt="" class="img-fluid">
      </div>
    </section>

    <section class="row row-cols-sm-3 g-sm-5 mx-4 py-5 my-5">
      <div class="col text-center text-sm-start">
        <div class="bg-secondary rounded p-4 text-light">
          <i class="fas fa-list-alt fa-fw fa-4x"></i>
          <h5 class="py-3">Online Enrollment</h5>
          <p>Our School offers enrollment on the go. Enroll wherever you are.</p>
        </div>
      </div>

      <div class="col text-center text-sm-start">
        <div class="bg-dark rounded p-4 text-light">
          <i class="fas fa-ticket-alt fa-fw fa-4x"></i>
          <h5 class="py-3">ESC Voucher</h5>
          <p>Our School also offers processing of ESC Vouchers online.</p>
        </div>
      </div>

      <div class="col text-center text-sm-start">
        <div class="bg-secondary rounded p-4 text-light">
          <i class="fas fa-users fa-fw fa-4x"></i>
          <h5 class="py-3">Faculty Search</h5>
          <p>Our School allows transparency with our faculty and staff.</p>
        </div>
      </div>
    </section>

    <section class="row py-5 my-5">
      <div class="col-sm-5">
        <img src="<?= site_url() ?>assets/images/study_2.jpg" alt="" class="img-fluid">
      </div>
      <div class="col-sm-7 text-center text-sm-start d-flex justify-content-center flex-column">
        <h4>ESC Voucher Registration</h4>
        <p>Lagonoy High School also offers online processing of eligible ESC grantees, it is made easy and user-friendly.</p>
        <div class="container p-0">
          <a href="<?= site_url() ?>esc" class="btn btn-primary">
            <i class="fas fa-chevron-right"></i> Register Now
          </a>
        </div>
      </div>
    </section>
  </div>

  <!-- trigger -->
  <a class="btn btn-sm btn-primary d-none" id="escBtn" data-bs-toggle="modal" href="#page0" role="button"></a>

  <!-- PAGE 1 -->
  <!-- other family info -->
  <div class="modal fade" id="page0" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" aria-hidden="true" aria-labelledby="page0Label" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header bg-primary text-light">
          <h5 class="modal-title" id="page0Label"><i class="fas fa-list fa-fw me-1"></i>Enrollment Type</h5>
          <a href="<?= site_url() ?>" class="btn-close bg-light me-1"></a>
        </div>
        <div class="modal-body">
          <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong>Hello, Good Day!</strong> Please select the type of your enrollment.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          <div class="row gap-3">
            <div class="col text-end">
              <a href="<?= site_url()?>enrollment/request/new" class="btn btn-lg btn-outline-primary">New Student</a>
            </div>
            <div class="col text-start">
              <a href="<?= site_url()?>enrollment/request/old" class="btn btn-lg btn-outline-secondary">Old Student</a>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <a href="<?= site_url() ?>" class="btn btn-secondary">Cancel</a>
        </div>
      </div>
    </div>
  </div>
</main>

<script src="<?= site_url() ?>js/preview_image.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const trigger = document.getElementById('escBtn');
    trigger.click();
  });
</script>
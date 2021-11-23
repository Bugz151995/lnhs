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

  <!-- trigger -->
  <a class="btn btn-sm btn-primary d-none" id="escBtn" data-bs-toggle="modal" href="#page0" role="button"></a>
  
  <!-- PAGE 1 -->
  <!-- other family info -->
  <div class="modal fade" id="page0" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" aria-hidden="true" aria-labelledby="page0Label" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header bg-primary text-light">
          <h5 class="modal-title" id="page0Label"><i class="fas fa-list fa-fw me-1"></i>Enrollment Request Token</h5>
          <a href="<?= site_url()?>" class="btn-close bg-light me-1"></a>
        </div>
        <div class="modal-body">
          <?= form_open_multipart('enrollment/request')?>
          <!-- learners information -->
          <div class="row g-3 row-cols-1 px-3">
            <!-- 2x2 -->
            <div class="col align-self-center justify-self-center">
              <div class="row row-cols-1 row-cols-lg-2 g-3 justify-content-center">
                <div class="col-auto">
                  <img src="<?= site_url()?>assets/images/user.jpg" alt="2by2 picture" id="img_preview" style="width: 150px; height: 150px; background-color: rgba(0,0,255,.1);" class="img-fluid img-thumbnail mx-4 rounded">
                </div>
                <div class="col d-flex flex-column justify-content-center">
                  <div class="">
                  <label for="user_img" class="form-label"><span class="text-danger">*</span> ID Picture</label>
                    <input type="file" name="user_img" id="user_img" class="form-control form-control-sm text-primary">
                  </div>
                  <p class="text-danger fst-italic">Please upload your student ID. and fill up the form to request for a unique token.</p>
                </div>
              </div>
            </div>

            <hr>

            <!-- learners information -->
            <div class="col mt-4">
              <div class="row row-cols-1 row-cols-lg-3 g-3 mb-3">
                <div class="col">
                  <label for="firstname" class="form-label"><span class="text-danger">*</span> Firstname</label>
                  <input type="text" class="form-control form-control-sm text-primary" name="firstname" value="<?= set_value('firstname')?>" id="firstname" placeholder="First Name here...">
                </div>
                <div class="col">
                  <label for="middlename" class="form-label"><span class="text-danger">*</span> Middlename</label>
                  <input type="text" id="middlename" name="middlename" value="<?= set_value('middlename')?>" class="form-control form-control-sm text-primary" placeholder="Middle Name here..."> 
                </div>
                <div class="col">
                  <label for="lastname" class="form-label"><span class="text-danger">*</span> Lastname</label>
                  <input type="text" class="form-control form-control-sm text-primary " id="lastname" name="lastname" value="<?= set_value('lastname')?>" placeholder="Last Name here...">
                </div>
                <div class="col">
                  <label for="nameextension" class="form-label"> Name Extension</label>
                  <input type="text" class="form-control form-control-sm text-primary " id="nameextension" name="suffix" value="<?= set_value('suffix')?>" placeholder="Name Extendsion here...">
                </div>
                <div class="col">
                  <label for="contact_num" class="form-label"><span class="text-danger">*</span> Contact Number</label>
                  <input type="text" class="form-control form-control-sm text-primary " id="contact_num" name="contact_num" value="<?= set_value('contact_num')?>" placeholder="Contact Number here...">
                </div>
                <div class="col">
                  <label for="email" class="form-label"><span class="text-danger">*</span> Email</label>
                  <input type="email" class="form-control form-control-sm text-primary " id="email" name="email" value="<?= set_value('email')?>" placeholder="Email here...">
                </div>
              </div> 
            </div>
            
            <div class="row row-cols-1 row-cols-lg-3 g-3 mb-3">
              <div class="col">
                <label for="class" class="form-label"><span class="text-danger">*</span> Class</label>
                <select name="class" id="" class="form-select form-select-sm text-primary">
                  <option value="" selected disabled>Select a Class...</option>
                  <?php foreach($class as $key => $c) : ?>
                    <option value="<?= $c['class_id']?>" <?= (isset($enrollments)) ? set_select('class', $enrollments[0]->grade_level, TRUE) : set_select('class', $c['class_id']) ?>><?= $c['class_name']?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="col">
                <label for="sy" class="form-label"><span class="text-danger">*</span> Academic Year</label>
                <select name="sy" id="sy" class="form-select form-select-sm text-primary">
                  <option value="" selected disabled>Select Academic Year...</option>
                  <?php for ($i=0; $i < 5; $i++) : ?>
                    <?php 
                      $c_year = $now->getYear();
                      $prev_y = $c_year - 2;
                      $sy_start = $prev_y + $i;
                      $sy_end   = $prev_y + $i + 1;
                    ?>
                    <option value="<?= $sy_start.'-'.$sy_end?>">
                      <?= $sy_start.'-'.$sy_end?>
                    </option>
                  <?php endfor ?>
                </select>
              </div>
              <div class="col">
                <label for="sem" class="form-label"><span class="text-danger">*</span> Semester</label>
                <select name="sem" id="" class="form-select form-select-sm text-primary">
                  <option value="" selected disabled>Select a Semester...</option>
                  <option value="1">1st Semester</option>
                  <option value="2">2nd Semester</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-sm btn-primary">Submit</button>
          <?= form_close()?>
        </div>
      </div>
    </div>
  </div>
</main>

<script src="<?= site_url()?>js/preview_image.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', ()=>{
    const trigger = document.getElementById('escBtn');
    trigger.click();
  });
</script>
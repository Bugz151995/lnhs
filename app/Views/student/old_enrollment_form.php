<main class="container">
  <div>
    <section class="row py-4 py-sm-0 px-2">
      <div class="col-sm-7 text-center text-sm-start d-flex justify-content-center flex-column">
        <h4>Enrollment Made Easy</h4>
        <p>Lagonoy High School now offers online enrollment for incoming Senior High School Students</p>
        <div class="container p-0">
          <a href="<?= site_url() ?>enrollment" class="btn btn-sm btn-primary">
            <i class="fas fa-chevron-right"></i> Enroll Now
          </a>
        </div>
      </div>
      <div class="col-sm-5">
        <img src="<?= site_url() ?>assets/images/study.jpg" alt="" class="img-fluid">
      </div>
    </section>

    <section class="row row-cols-sm-3 g-sm-5 mx-4">
      <div class="col text-center text-sm-start">
        <div class="bg-secondary rounded p-4 text-light">
          <i class="fas fa-list-alt fa-fw fa-4x"></i>
          <h5 class="py-3">Online Enrollment</h5>
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
        <img src="<?= site_url() ?>assets/images/study_2.jpg" alt="" class="img-fluid">
      </div>
      <div class="col-sm-7 text-center text-sm-start d-flex justify-content-center flex-column">
        <h4>ESC Voucher Registration</h4>
        <p>Lagonoy High School also offers online processing of eligible ESC grantees, it is made easy and user-friendly.</p>
        <div class="container p-0">
          <a href="<?= site_url() ?>esc_registration" class="btn btn-sm btn-primary">
            <i class="fas fa-chevron-right"></i> Register Now
          </a>
        </div>
      </div>
    </section>
  </div>

  <!-- enrolment form -->
  <?= form_open('enrollment/submit', ['id' => 'enrollmentForm']) ?>
  <?= csrf_field() ?>
  <?= form_hidden('s', esc($student[0]->student_id)) ?>
  <!-- trigger -->
  <a class="btn btn-sm btn-primary d-none" id="enrollmentBtn" data-bs-toggle="modal" href="#page" role="button"></a>

  <!-- INSTRUCTIONS -->
  <div class="modal fade" id="page" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" aria-hidden="true" aria-labelledby="pageLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header bg-primary text-light">
          <h5 class="modal-title" id="pageLabel"><i class="fas fa-list fa-fw me-1"></i>Enrollment Form</h5>
        </div>
        <div class="modal-body">
          <h1 class="h4">Instruction:</h1>
          <div class="card border-0">
            <div class="row">
              <div class="col-1">
                <img src="<?= site_url() ?>assets/images/4213.jpg" alt="" class="rounded-start img-fluid d-none d-sm-block">
                <i class="fas fa-check-circle text-success d-sm-none d-block"></i>
              </div>
              <div class="col-11 d-flex align-items-center">
                <span>Answer the form accurately.</span>
              </div>
            </div>
          </div>
          
          <div class="card border-0">
            <div class="row">
              <div class="col-1">
                <img src="<?= site_url() ?>assets/images/5219070.jpg" alt="" class="rounded-start img-fluid d-none d-sm-block">
                <i class="fas fa-check-circle text-success d-sm-none d-block"></i>
              </div>
              <div class="col-11 d-flex align-items-center">
                <span>Please don't leave the required fields with a red astrisk( <span class="text-danger">*</span> ) unanswered.</span>
              </div>
            </div>
          </div>

          <div class="card border-0">
            <div class="row">
              <div class="col-1">
                <img src="<?= site_url() ?>assets/images/245.jpg" alt="" class="rounded-start img-fluid d-none d-sm-block">
                <i class="fas fa-check-circle text-success d-sm-none d-block"></i>
              </div>
              <div class="col-11 d-flex align-items-center">
                <span>The form is responsive, which means in small devices. the modal will have a scroll bar and adjust to your device viewport.</span>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <a class="btn btn-sm btn-primary" data-bs-target="#page0" data-bs-toggle="modal" data-bs-dismiss="modal">Next<i class="fas fa-arrow-right ms-1"></i></a>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="page0" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" aria-hidden="true" aria-labelledby="page5Label" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header bg-primary text-light">
          <h5 class="modal-title" id="page5Label"><i class="fas fa-list fa-fw me-1"></i>Enrollment Form</h5>
        </div>
        <div class="modal-body">
          <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div>
          </div>
          <!-- For SHS -->
          <label for="seniorhighstudent" class="h6 text-center bg-light w-100 mt-4 text-decoration-underline">For Learners in Senior High School</label>
          <div id="seniorhighstudent" class="row g-3 row-cols-1 align-items-center mb-3">
            <div class="col-md-3">
              <label for="semester" class="form-label"><span class="text-danger">*</span> Semester</label>
              <div class="form-control  form-control-sm text-primary ps-4">
                <div class="row" id="semester">
                  <div class="form-check col-auto mb-0">
                    <input class="form-check-input" type="radio" name="semester" value="1" id="firstsem" <?= ($student[0]->semester == '1') ? set_radio('semester', '1', TRUE) : set_radio('semester', '1') ?>>
                    <label class="form-check-label" for="firstsem">
                      1st Sem
                    </label>
                  </div>
                  <div class="form-check col-auto mb-0">
                    <input class="form-check-input" type="radio" name="semester" value="2" id="secondsem" <?= ($student[0]->semester == '2') ? set_radio('semester', '2', TRUE) : set_radio('semester', '2') ?>>
                    <label class="form-check-label" for="secondsem">
                      2nd Sem
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <label for="sy" class="form-label"><span class="text-danger">*</span> Academic Year</label>
              <select name="sy" id="sy" class="form-select form-select-sm text-primary">
                <option value="" selected disabled>Select Academic Year...</option>
                <?php for ($i = 0; $i < 5; $i++) : ?>
                  <?php
                  $c_year = $now->getYear();
                  $prev_y = $c_year - 2;
                  $sy_start = $prev_y + $i;
                  $sy_end   = $prev_y + $i + 1;
                  ?>
                  <option value="<?= $sy_start . '-' . $sy_end ?>" <?= ($student[0]->acad_year == $sy_start . '-' . $sy_end) ? set_select('sy', $sy_start . '-' . $sy_end, TRUE) : set_select('sy', $sy_start . '-' . $sy_end) ?>>
                    <?= $sy_start . '-' . $sy_end ?>
                  </option>
                <?php endfor ?>
              </select>
            </div>
            <div class="col-md-3">
              <label for="gradelevel" class="form-label"><span class="text-danger">*</span> Grade Level</label>
              <select name="gradelevel" id="gradelevel" class="form-select form-select-sm text-primary">
                <option value="" selected disabled>Select your Grade Level...</option>
                <option value="11" <?= ($student[0]->grade_level == '11') ? set_select('gradelevel', '11', TRUE) : set_select('gradelevel', '11') ?>>11</option>
                <option value="12" <?= ($student[0]->grade_level == '12') ? set_select('gradelevel', '12', TRUE) : set_select('gradelevel', '12') ?>>12</option>
              </select>
            </div>
            <div class="col-md-3">
              <label for="class" class="form-label"><span class="text-danger">*</span> Class</label>
              <select name="class" id="class" class="form-select form-select-sm text-primary">
                <option value="" selected disabled>Select your Class...</option>
                <?php foreach ($class as $key => $class) : ?>
                  <option value="<?= $class['class_id'] ?>" <?= ($class['class_id'] == $student[0]->class_id) ? set_select('class', $student[0]->class_id, TRUE) : set_select('class', $class['class_id']) ?>><?= $class['class_name'] ?></option>
                <?php endforeach ?>
              </select>
            </div>
          </div>
          <div class="row g-3">
            <div class="col-lg-6">
              <label for="course" class="form-label"><span class="text-danger">*</span> Track and Strands</label>
              <select name="course" id="course" class="form-select form-select-sm text-primary">
                <option value="" selected disabled>Select Track and Strands...</option>
                <?php foreach ($courses as $key => $course) : ?>
                  <option value="<?= $course->course_id ?>" <?= set_select('course', $course->course_id) ?>><?= $course->track_name ?> - <?= $course->strand_name ?></option>
                <?php endforeach ?>
              </select>
            </div>
            <div class="col-lg-6">
              <label for="modality" class="form-label"><span class="text-danger">*</span> Learning Modality</label>
              <select name="modality" id="learningmodality" class="form-select form-select-sm text-primary">
                <option value="" disabled selected>Select Learning Modality</option>
                <option value="Modular(print)" <?= set_select('modality', 'Modular(print)') ?>>Modular(print)</option>
                <option value="Modular(digital)" <?= set_select('modality', 'Modular(digital)') ?>>Modular(digital)</option>
              </select>
              <?= form_hidden('s', esc($student[0]->student_id)) ?>
            </div>
          </div>
        </div>

        <script>
          const fields = [
            'semester', 'sy', 'gradelevel', 'class', 'course', 'learningmodality'
          ];

          const pages = {
            current: 'page0'
          }
        </script>

        <div class="modal-footer d-flex justify-content-between">
          <a class="btn btn-sm btn-secondary" data-bs-target="#page" data-bs-toggle="modal" data-bs-dismiss="modal"><i class="fas fa-arrow-left me-1"></i>Prev</a>
          <a role="submit" onclick="validate(pages, fields, true)" class="btn btn-sm btn-primary">Submit</a>
        </div>
      </div>
    </div>
  </div>
  <?= form_close() ?>
</main>

<script src="<?= site_url() ?>js/validation_enrollment.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const trigger = document.getElementById('enrollmentBtn');
    trigger.click();
  });
</script>
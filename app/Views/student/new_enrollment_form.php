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
  <?= form_open_multipart('enrollment/submit') ?>
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
          <p><i class="fas fa-check-circle me-2 text-success"></i>Answer the form accurately.</p>
          <p><i class="fas fa-check-circle me-2 text-success"></i>Please don't leave the required fields with a red astrisk( <span class="text-danger">*</span> ) unanswered.</p>
          <p><i class="fas fa-check-circle me-2 text-success"></i>The form is scrollable, which means in small devices. the modal will have a scroll bar.</p>
          <p><i class="fas fa-check-circle me-2 text-success"></i>Don't press next when you have not answered all the required fields, as this will produce an error on the submission of the form.</p>
        </div>
        <div class="modal-footer">
          <a class="btn btn-sm btn-primary" data-bs-target="#page0" data-bs-toggle="modal" data-bs-dismiss="modal">Next<i class="fas fa-arrow-right ms-1"></i></a>
        </div>
      </div>
    </div>
  </div>

  <!-- PAGE 1 -->
  <!-- 2x2 pic -->
  <div class="modal fade" id="page0" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" aria-hidden="true" aria-labelledby="page0Label" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header bg-primary text-light">
          <h5 class="modal-title" id="page0Label"><i class="fas fa-list fa-fw me-1"></i>Enrollment Form</h5>
        </div>
        <div class="modal-body">
          <div class="progress mb-3">
            <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
          </div>
          <!-- 2x2 -->
          <div class="row g-3">
            <div class="col">
              <div class="d-flex justify-content-center">
                <img src="<?= site_url() ?>assets/images/user.jpg" alt="2by2 picture" id="img_preview" style="width: 200px; height: 200px; background-color: rgba(0,0,255,.1);" class="img-fluid img-thumbnail mx-4 rounded-circle">
              </div>


              <div class="px-3 pt-2">
                <label for="" class="form-label"><span class="text-danger">*</span> 2x2 Picture</label>
                <input type="file" name="user_img" value="<?= set_value('user_img') ?>" id="user_img" class="form-control  form-control-sm text-primary">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-between">
          <a class="btn btn-sm btn-secondary" data-bs-target="#page" data-bs-toggle="modal" data-bs-dismiss="modal"><i class="fas fa-arrow-left me-1"></i>Prev</a>
          <a class="btn btn-sm btn-primary" data-bs-target="#page1" data-bs-toggle="modal" data-bs-dismiss="modal">Next<i class="fas fa-arrow-right ms-1"></i></a>
        </div>
      </div>
    </div>
  </div>

  <!-- PAGE 2 -->
  <!-- about me -->
  <div class="modal fade" id="page1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" aria-labelledby="page1Label" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header bg-primary text-light">
          <h5 class="modal-title" id="page1Label"><i class="fas fa-list fa-fw me-1"></i>Enrollment Form</h5>
        </div>
        <div class="modal-body">
          <div class="progress mb-3">
            <div class="progress-bar" role="progressbar" style="width: 20%;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">20%</div>
          </div>

          <label for="aboutme" class="h6 text-center bg-light w-100 mt-4 text-decoration-underline">About Me</label>
          <div id="aboutme" class="row row-cols-1 row-cols-lg-3 g-3">
            <div class="col">
              <label for="firstname" class="form-label"><span class="text-danger">*</span> First name</label>
              <input type="text" class="form-control  form-control-sm text-primary" name="firstname" value="<?= (isset($student)) ? $student[0]->firstname : set_value('firstname') ?>" id="firstname" placeholder="First Name here...">
            </div>
            <div class="col">
              <label for="middlename" class="form-label"><span class="text-danger">*</span> Middle name</label>
              <input type="text" id="middlename" name="middlename" value="<?= (isset($student)) ? $student[0]->middlename : set_value('middlename') ?>" class="form-control  form-control-sm text-primary" placeholder="Middle Name here...">
            </div>
            <div class="col">
              <label for="lastname" class="form-label"><span class="text-danger">*</span> Last Name</label>
              <input type="text" class="form-control  form-control-sm text-primary " id="lastname" name="lastname" value="<?= (isset($student)) ? $student[0]->lastname : set_value('lastname') ?>" placeholder="Last Name here...">
            </div>
            <div class="col">
              <label for="nameextension" class="form-label">Name Extension</label>
              <input type="text" class="form-control  form-control-sm text-primary " id="nameextension" name="suffix" value="<?= set_value('suffix') ?>" placeholder="Name Extension here...">
            </div>
            <div class="col">
              <label for="bday" class="form-label"><span class="text-danger">*</span> Birth Date</label>
              <input type="date" id="bday" name="bday" value="<?= set_value('bday') ?>" class="form-control  form-control-sm text-primary">
            </div>
            <div class="col">
              <label for="bplace" class="form-label"><span class="text-danger">*</span> Birth Place</label>
              <input type="text" id="bplace" name="bplace" value="<?= set_value('bplace') ?>" class="form-control form-control-sm text-primary" placeholder="Birth Place here...">
            </div>
            <div class="col">
              <label for="age" class="form-label"><span class="text-danger">*</span> Age</label>
              <input type="number" min="6" max="130" id="age" name="age" value="<?= set_value('age') ?>" class="form-control  form-control-sm text-primary" placeholder="Age here...">
            </div>
            <div class="col">
              <label for="sex" class="form-label"><span class="text-danger">*</span> Sex</label>
              <select name="sex" id="sex" class="form-select form-select-sm text-primary">
                <option value="" disabled selected>Select Sex...</option>
                <option value="Male" <?= set_select('sex', 'Male') ?>>Male</option>
                <option value="Female" <?= set_select('sex', 'Female') ?>>Female</option>
              </select>
            </div>
            <div class="col">
              <label for="religion" class="form-label"><span class="text-danger">*</span> Religious Affiliation</label>
              <input type="text" id="religion" name="religion" value="<?= set_value('religion') ?>" class="form-control  form-control-sm text-primary" placeholder="Religious Affiliation here...">
            </div>
            <div class="col">
              <label for="natl" class="form-label"><span class="text-danger">*</span> Nationality</label>
              <input type="text" id="natl" name="natl" value="<?= set_value('natl') ?>" class="form-control  form-control-sm text-primary" placeholder="Nationality here...">
            </div>
          </div>

        </div>
        <div class="modal-footer d-flex justify-content-between">
          <a class="btn btn-sm btn-secondary" data-bs-target="#page0" data-bs-toggle="modal" data-bs-dismiss="modal"><i class="fas fa-arrow-left me-1"></i>Prev</a>
          <a class="btn btn-sm btn-sm btn-primary" data-bs-target="#page2" data-bs-toggle="modal" data-bs-dismiss="modal">Next<i class="fas fa-arrow-right ms-1"></i></a>
        </div>
      </div>
    </div>
  </div>

  <!-- PAGE 3 -->
  <!-- address -->
  <div class="modal fade" id="page2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" aria-hidden="true" aria-labelledby="page2Label" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header bg-primary text-light">
          <h5 class="modal-title" id="page2Label"><i class="fas fa-list fa-fw me-1"></i>Enrollment Form</h5>
        </div>
        <div class="modal-body">
          <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: 40%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">40%</div>
          </div>

          <label for="address" class="h6 text-center bg-light w-100 mt-4 text-decoration-underline">Complete Address</label>
          <div class="row row-cols-1 row-cols-lg-3 g-3">
            <div class="col">
              <label for="street" class="form-label"><span class="text-danger">*</span> House #/Street/Sitio/Purok</label>
              <input type="text" id="street" name="street" value="<?= set_value('street') ?>" class="form-control  form-control-sm text-primary " placeholder="House #/Street/Sitio/Purok here...">
            </div>

            <div class="col">
              <label for="barangay" class="form-label"><span class="text-danger">*</span> Barangay</label>
              <input type="text" id="barangay" name="barangay" value="<?= set_value('barangay') ?>" class="form-control  form-control-sm text-primary" placeholder="Barangay here...">
            </div>

            <div class="col">
              <label for="mun_city" class="form-label"><span class="text-danger">*</span> Municipality/City</label>
              <input type="text" id="mun_city" name="mun_city" value="<?= set_value('mun_city') ?>" class="form-control  form-control-sm text-primary" placeholder="Municipality/City here...">
            </div>

            <div class="col">
              <label for="province" class="form-label"><span class="text-danger">*</span> Province</label>
              <input type="text" id="province" name="province" value="<?= set_value('province') ?>" class="form-control  form-control-sm text-primary " placeholder="Province here...">
            </div>

            <div class="col">
              <label for="zip" class="form-label"><span class="text-danger">*</span> Zip Code</label>
              <input type="number" id="zip" name="zip" value="<?= set_value('zip') ?>" class="form-control  form-control-sm text-primary " placeholder="Zip Code here...">
            </div>
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-between">
          <a class="btn btn-sm btn-secondary" data-bs-target="#page1" data-bs-toggle="modal" data-bs-dismiss="modal"><i class="fas fa-arrow-left me-1"></i>Prev</a>
          <a class="btn btn-sm btn-primary" data-bs-target="#page3" data-bs-toggle="modal" data-bs-dismiss="modal">Next<i class="fas fa-arrow-right ms-1"></i></a>
        </div>
      </div>
    </div>
  </div>

  <!-- PAGE 4 -->
  <div class="modal fade" id="page3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" aria-hidden="true" aria-labelledby="page3Label" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header bg-primary text-light">
          <h5 class="modal-title" id="page3Label"><i class="fas fa-list fa-fw me-1"></i>Enrollment Form</h5>
        </div>
        <div class="modal-body">
          <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">60%</div>
          </div>
          <!-- parent information -->
          <div for="parent" class="h6 text-center bg-light w-100 mt-4 text-decoration-underline">Parents/Guardian</div>
          <div class="row row-cols-1 g-3">
            <div class="col">
              <div class="row g-3">
                <div class="col-lg-9">
                  <label for="fathersname" class="form-label"><span class="text-danger">*</span> Fathers name</label>
                  <div class="row row-cols-1 row-cols-md-3 g-3" id="fathersname">
                    <div class="col">
                      <input type="text" name="firstname_0" value="<?= set_value('firstname_0') ?>" id="firstname_0" class="form-control  form-control-sm text-primary" placeholder="First Name here...">
                    </div>
                    <div class="col">
                      <input type="text" name="middlename_0" value="<?= set_value('middlename_0') ?>" id="middlename_0" class="form-control  form-control-sm text-primary" placeholder="Middle Name here...">
                    </div>
                    <div class="col">
                      <input type="text" name="lastname_0" value="<?= set_value('lastname_0') ?>" id="lastname_0" class="form-control  form-control-sm text-primary" placeholder="Last Name here...">
                    </div>
                    <input type="hidden" name="relationship_0" value="father">
                  </div>
                </div>
                <div class="col-lg-3">
                  <label for="contact_number" class="form-label">Contact Number (Father)</label>
                  <div class="col">
                    <input type="text" class="form-control  form-control-sm text-primary " name="contact_number_0" value="<?= set_value('contact_number_0') ?>" id="contact_number_0" placeholder="Father's Contact Number here...">
                  </div>
                </div>
              </div>
            </div>

            <div class="col">
              <div class="row g-3">
                <div class="col-lg-9">
                  <label for="mothersname" class="form-label"><span class="text-danger">*</span> Mothers Maiden name</label>
                  <div class="row row-cols-1 row-cols-md-3 g-3" id="mothersname">
                    <div class="col">
                      <input type="text" name="firstname_1" id="firstname_1" value="<?= set_value('firstname_1') ?>" class="form-control  form-control-sm text-primary" placeholder="First Name here...">
                    </div>
                    <div class="col">
                      <input type="text" name="middlename_1" id="middlename_1" value="<?= set_value('middlename_1') ?>" class="form-control  form-control-sm text-primary" placeholder="Middle Name here...">
                    </div>
                    <div class="col">
                      <input type="text" name="lastname_1" id="lastname_1" value="<?= set_value('lastname_1') ?>" class="form-control  form-control-sm text-primary" placeholder="Last Name here...">
                    </div>
                    <input type="hidden" name="relationship_1" value="mother">
                  </div>
                </div>
                <div class="col-lg-3">
                  <label for="contact_number" class="form-label">Contact Number (Mother)</label>
                  <input type="text" class="form-control  form-control-sm text-primary " name="contact_number_1" id="contact_number_1" value="<?= set_value('contact_number_1') ?>" placeholder="Mother's Contact Number here...">
                </div>
              </div>
            </div>
          </div>

          <!-- guardian -->
          <div class="fst-italic mt-4 text-danger">Specify Guardian if you are not living with your parent.</div>

          <label for="liveswithguardianorparent" class="form-label">Are you living with your parent?</label>
          <div class="form-control  form-control-sm text-primary ps-4">
            <div class="row">
              <div class="form-check col-auto mb-0">
                <input class="form-check-input" type="radio" name="liveswithguardianorparent" checked id="liveswithparent">
                <label class="form-check-label" for="liveswithparent">
                  Yes
                </label>
              </div>
              <div class="form-check col-auto mb-0">
                <input class="form-check-input" type="radio" name="liveswithguardianorparent" id="liveswithguardian">
                <label class="form-check-label" for="liveswithguardian">
                  No
                </label>
              </div>
            </div>
          </div>

          <div class="row g-3" id="guardian">
            <div class="col-12 col-lg-6">
              <label for="guardian" class="form-label">Guardian </label>
              <div class="row row-cols-1 row-cols-lg-3 g-3" id="guardian">
                <div class="col">
                  <input type="text" name="firstname_2" id="firstname_2" value="<?= set_value('firstname_2') ?>" class="form-control  form-control-sm text-primary" disabled placeholder="First Name here...">
                </div>
                <div class="col">
                  <input type="text" name="middlename_2" id="middlename_2" value="<?= set_value('middlename_2') ?>" class="form-control  form-control-sm text-primary" disabled placeholder="Middle Name here...">
                </div>
                <div class="col">
                  <input type="text" name="lastname_2" id="lastname_2" value="<?= set_value('lastname_2') ?>" class="form-control  form-control-sm text-primary" disabled placeholder="Last Name here...">
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-3">
              <label for="relationship" class="form-label">Relationship</label>
              <input type="text" name="relationship_2" id="relationship_2" value="<?= set_value('relationship_2') ?>" class="form-control  form-control-sm text-primary" disabled placeholder="Relationship here...">
            </div>
            <div class="col-12 col-lg-3">
              <label for="contact_number" class="form-label">Contact Number</label>
              <input type="text" class="form-control  form-control-sm text-primary " name="contact_number_2" value="<?= set_value('contact_number_2') ?>" id="contact_number_2" disabled placeholder="Guardian's Contact Number here...">
            </div>
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-between">
          <a class="btn btn-sm btn-secondary" data-bs-target="#page2" data-bs-toggle="modal" data-bs-dismiss="modal"><i class="fas fa-arrow-left me-1"></i>Prev</a>
          <a class="btn btn-sm btn-primary" data-bs-target="#page4" data-bs-toggle="modal" data-bs-dismiss="modal">Next<i class="fas fa-arrow-right ms-1"></i></a>
        </div>
      </div>
    </div>
  </div>

  <!-- PAGE 5 -->
  <div class="modal fade" id="page4" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" aria-hidden="true" aria-labelledby="page4Label" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header bg-primary text-light">
          <h5 class="modal-title" id="page4Label"><i class="fas fa-list fa-fw me-1"></i>Enrollment Form</h5>
        </div>
        <div class="modal-body">
          <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: 80%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">80%</div>
          </div>
          <!-- For Returning Learners(Balik-Aral) and Those Who Shall Transfer/Move in -->
          <label for="returneeTransferee" class="h6 text-center bg-light w-100 mt-4 text-decoration-underline">For Returning Learners(Balik-Aral) and Those Who Shall Transfer/Move in</label>

          <div class="fst-italic ps-3 my-2 text-danger">If you are not a returnee or transferee please skip this page</div>

          <div class="col-12 col-4 mb-3">
            <label for="returneeortransferee" class="form-label">Are you a transferee or Returnee?</label>
            <div class="form-control  form-control-sm text-primary ps-4">
              <div class="row">
                <div class="form-check col-auto mb-0">
                  <input class="form-check-input" type="radio" name="returneeortransferee" id="isreturneeortransferee">
                  <label class="form-check-label" for="isreturneeortransferee">
                    Yes
                  </label>
                </div>
                <div class="form-check col-auto mb-0">
                  <input class="form-check-input" type="radio" name="returneeortransferee" checked id="isnotreturneeortransferee">
                  <label class="form-check-label" for="isnotreturneeortransferee">
                    No
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div id="returneeTransferee" class="row g-3 row-cols-1 row-cols-lg-2">
            <div class="col">
              <label for="hea" class="form-label">Last Grade Level Completed</label>
              <input type="number" name="hea" id="hea" class="form-control  form-control-sm text-primary" value="<?= set_value('hea') ?>" disabled placeholder="Last Grade Level Completed here...">
            </div>
            <div class="col">
              <label for="hea_ay" class="form-label">Last School Year Completed</label>
              <input type="number" name="hea_ay" id="hea_ay" class="form-control  form-control-sm text-primary" value="<?= set_value('hea_ay') ?>" disabled placeholder="Last School Year Completed here...">
            </div>
            <div class="col">
              <label for="prev_school" class="form-label">School Name</label>
              <input type="text" name="prev_school" id="prev_school" class="form-control  form-control-sm text-primary" value="<?= set_value('prev_school') ?>" disabled placeholder="School Name here...">
            </div>
            <div class="col">
              <label for="prev_school_address" class="form-label">School Address</label>
              <input type="text" name="prev_school_address" id="prev_school_address" value="<?= set_value('prev_school_address') ?>" class="form-control  form-control-sm text-primary" disabled placeholder="School Address here...">
            </div>
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-between">
          <a class="btn btn-sm btn-secondary" data-bs-target="#page3" data-bs-toggle="modal" data-bs-dismiss="modal"><i class="fas fa-arrow-left me-1"></i>Prev</a>
          <a class="btn btn-sm btn-primary" data-bs-target="#page5" data-bs-toggle="modal" data-bs-dismiss="modal">Next<i class="fas fa-arrow-right ms-1"></i></a>
        </div>
      </div>
    </div>
  </div>

  <!-- PAGE 6 -->
  <div class="modal fade" id="page5" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" aria-hidden="true" aria-labelledby="page5Label" tabindex="-1">
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
                <div class="row">
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
        <div class="modal-footer d-flex justify-content-between">
          <a class="btn btn-sm btn-secondary" data-bs-target="#page4" data-bs-toggle="modal" data-bs-dismiss="modal"><i class="fas fa-arrow-left me-1"></i>Prev</a>
          <button type="submit" class="btn btn-sm btn-primary">Submit</button>
        </div>
      </div>
    </div>
  </div>
  <?= form_close() ?>
</main>

<script src="<?= site_url() ?>js/returneeform_toggle.js"></script>
<script src="<?= site_url() ?>js/guardianfield_toggle.js"></script>
<script src="<?= site_url() ?>js/preview_image.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const trigger = document.getElementById('enrollmentBtn');
    trigger.click();
  });
</script>
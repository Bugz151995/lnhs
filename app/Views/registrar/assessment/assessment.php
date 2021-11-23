<main class="p-4">
  <!-- breadcrumb -->
  <div class="d-flex justify-content-between border-bottom mb-5">
    <h4>Assessment</h4>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= site_url() ?>r/dashboard">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Enrollments</li>
        <li class="breadcrumb-item active" aria-current="page">Assessment</li>
      </ol>
    </nav>
  </div>

  <div class="bg-white mt-4 border">
    <?= form_open_multipart('r/assessment/update') ?>
    <!-- header -->
    <div class="bg-primary p-3 text-light text-center border-top border-white h5">Learners Information</div>
    <!-- learners information -->
    <div class="row g-0">
      <input type="hidden" name="s" value="<?= $enrollments[0]->student_id ?>">
      <input type="hidden" name="e" value="<?= $enrollments[0]->enrollment_id ?>">
      <input type="hidden" name="rt" value="<?= (count($returnee_transferee) > 0) ? $returnee_transferee[0]->transferee_returnee_id : '' ?>">
      <input type="hidden" name="a" value="<?= $enrollments[0]->address_id ?>">
      <input type="hidden" name="sa" value="<?= $enrollments[0]->student_address_id ?>">
      <input type="hidden" name="father_id" value="<?= (isset($relatives[0])) ? $relatives[0]->person_id : '' ?>">
      <input type="hidden" name="mother_id" value="<?= (isset($relatives[1])) ? $relatives[1]->person_id : '' ?>">
      <input type="hidden" name="guardian_id" value="<?= (isset($relatives[2])) ? $relatives[2]->person_id : '' ?>">
      <input type="hidden" name="father_r_id" value="<?= (isset($relatives[0])) ? $relatives[0]->relation_id : '' ?>">
      <input type="hidden" name="mother_r_id" value="<?= (isset($relatives[1])) ? $relatives[1]->relation_id : '' ?>">
      <input type="hidden" name="guardian_r_id" value="<?= (isset($relatives[2])) ? $relatives[2]->relation_id : '' ?>">
      <!-- 2x2 -->
      <div class="col-lg-3 text-center d-flex flex-column gap-3 align-items-center justify-content-end">
        <img src="<?= (isset($enrollments)) ? $enrollments[0]->user_img : site_url() . 'assets/images/user.jpg' ?>" id="img_preview" alt="hugenerd" style="width: 200px; height: 200px; background-color: rgba(0,0,255,.1);" class="img-fluid img-thumbnail rounded" alt="">
        <input type="file" name="user_img" id="user_img" class="form-control form-control-sm w-75">
      </div>
      <!-- learners information -->
      <div class="col-lg-9">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 g-lg-4 g-2 px-3 pt-3">
          <div class="col">
            <label for="lrn" class="form-label">LRN</label>
            <input type="text" class="form-control form-control-sm text-primary" name="lrn" value="<?= set_value('firstname') ?>" id="lrn" placeholder="LRN here...">
          </div>
          <div class="col">
            <label for="firstname" class="form-label"><span class="text-danger">*</span> First name</label>
            <input type="text" class="form-control form-control-sm text-primary" name="firstname" value="<?= (isset($enrollments)) ? $enrollments[0]->firstname : set_value('firstname') ?>" id="firstname" placeholder="First Name here...">
          </div>
          <div class="col">
            <label for="middlename" class="form-label"><span class="text-danger">*</span> Middle name</label>
            <input type="text" id="middlename" name="middlename" value="<?= (isset($enrollments)) ? $enrollments[0]->middlename : set_value('middlename') ?>" class="form-control form-control-sm text-primary" placeholder="Middle Name here...">
          </div>
          <div class="col">
            <label for="lastname" class="form-label"><span class="text-danger">*</span> Last Name</label>
            <input type="text" class="form-control form-control-sm text-primary " id="lastname" name="lastname" value="<?= (isset($enrollments)) ? $enrollments[0]->lastname : set_value('lastname') ?>" placeholder="Last Name here...">
          </div>
          <div class="col">
            <label for="nameextension" class="form-label">Name Extension</label>
            <input type="text" class="form-control form-control-sm text-primary " id="nameextension" name="suffix" value="<?= (isset($enrollments)) ? $enrollments[0]->suffix : set_value('suffix') ?>" placeholder="Name Extendsion here...">
          </div>
          <div class="col">
            <label for="bday" class="form-label"><span class="text-danger">*</span> Birth Date</label>
            <input type="date" id="bday" name="bday" value="<?= (isset($enrollments)) ? $enrollments[0]->birthdate : set_value('bday') ?>" class="form-control form-control-sm text-primary">
          </div>
          <div class="col">
            <label for="age" class="form-label"><span class="text-danger">*</span> Age</label>
            <input type="number" min="6" max="130" id="age" name="age" value="<?= (isset($enrollments)) ? $enrollments[0]->age : set_value('age') ?>" class="form-control form-control-sm text-primary" placeholder="Age here...">
          </div>
          <div class="col">
            <label for="religiosAffilication" class="form-label"><span class="text-danger">*</span> Sex</label>
            <div class="form-control form-control-sm text-primary d-flex align-items-center justify-content-center">
              <div class="form-check form-check-inline mb-0">
                <input class="form-check-input" type="radio" name="sex" id="male" value="Male" <?= (isset($enrollments) && $enrollments[0]->sex == 'Male') ? set_radio('sex', $enrollments[0]->sex, TRUE) : set_radio('sex', 'Male') ?>>
                <label class="form-check-label align-middle" for="male">Male</label>
              </div>
              <div class="form-check form-check-inline mb-0">
                <input class="form-check-input" type="radio" name="sex" id="female" value="Female" <?= (isset($enrollments) && $enrollments[0]->sex == 'Female') ? set_radio('sex', $enrollments[0]->sex, TRUE) : set_radio('sex', 'Female') ?>>
                <label class="form-check-label align-middle" for="female">Female</label>
              </div>
            </div>
          </div>
          <div class="col">
            <label for="religion" class="form-label"><span class="text-danger">*</span> Religious Affiliation</label>
            <input type="text" id="religion" name="religion" value="<?= (isset($enrollments)) ? $enrollments[0]->religion : set_value('religion') ?>" class="form-control form-control-sm text-primary" placeholder="Religious Affiliation here...">
          </div>
          <div class="col">
            <label for="modality" class="form-label"><span class="text-danger">*</span> Learning Modality</label>
            <select name="modality" id="learningmodality" class="form-select form-select-sm text-primary">
              <option value="" disabled selected>Select Learning Modality</option>
              <option value="Modular(print)" <?= (isset($enrollments) && $enrollments[0]->learning_modality == 'Modular(print)') ? set_select('modality', $enrollments[0]->learning_modality, TRUE) : set_select('modality', 'Modular(print)') ?>>Modular(print)</option>
              <option value="Modular(digital)" <?= (isset($enrollments) && $enrollments[0]->learning_modality == 'Modular(digital)') ? set_select('modality', $enrollments[0]->learning_modality, TRUE) : set_select('modality', 'Modular(digital)') ?>>Modular(digital)</option>
            </select>
          </div>
        </div>
      </div>
    </div>

    <!-- complete address -->
    <label for="address" class="h6 text-center bg-light w-100 mt-4 text-decoration-underline">Complete Address</label>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 px-3 g-2 g-lg-4">
      <div class="col">
        <label for="street" class="form-label"><span class="text-danger">*</span> House #/Street/Sitio/Purok</label>
        <input type="text" id="street" name="street" value="<?= (isset($enrollments)) ? $enrollments[0]->street : set_value('street') ?>" class="form-control form-control-sm text-primary " placeholder="House #/Street/Sitio/Purok here...">
      </div>

      <div class="col">
        <label for="barangay" class="form-label"><span class="text-danger">*</span> Barangay</label>
        <input type="text" id="barangay" name="barangay" value="<?= (isset($enrollments)) ? $enrollments[0]->barangay : set_value('barangay') ?>" class="form-control form-control-sm text-primary" placeholder="Barangay here...">
      </div>

      <div class="col">
        <label for="mun_city" class="form-label"><span class="text-danger">*</span> Municipality/City</label>
        <input type="text" id="mun_city" name="mun_city" value="<?= (isset($enrollments)) ? $enrollments[0]->city_municipality : set_value('mun_city') ?>" class="form-control form-control-sm text-primary" placeholder="Municipality/City here...">
      </div>

      <div class="col">
        <label for="province" class="form-label"><span class="text-danger">*</span> Province</label>
        <input type="text" id="province" name="province" value="<?= (isset($enrollments)) ? $enrollments[0]->province : set_value('province') ?>" class="form-control form-control-sm text-primary " placeholder="Province here...">
      </div>
    </div>

    <!-- parent information -->
    <div for="parent" class="h6 text-center bg-light w-100 mt-4 text-decoration-underline">Parents/Guardian</div>
    <div class="row row-cols-1 px-3 g-2 g-lg-4">
      <div class="col">
        <div class="row g-2 g-lg-4">
          <div class="col-sm-9">
            <label for="fathersname" class="form-label"><span class="text-danger">*</span> Fathers name</label>
            <div class="row row-cols-1 row-cols-md-3 px-1 g-2 g-lg-3" id="fathersname">
              <div class="col">
                <input type="text" name="firstname_0" value="<?= (isset($relatives[0])) ? $relatives[0]->firstname : set_value('firstname_0') ?>" id="firstname_0" class="form-control form-control-sm text-primary" placeholder="First Name here...">
              </div>
              <div class="col">
                <input type="text" name="middlename_0" value="<?= (isset($relatives[0])) ? $relatives[0]->middlename : set_value('middlename_0') ?>" id="middlename_0" class="form-control form-control-sm text-primary" placeholder="Middle Name here...">
              </div>
              <div class="col">
                <input type="text" name="lastname_0" value="<?= (isset($relatives[0])) ? $relatives[0]->lastname : set_value('lastname_0') ?>" id="lastname_0" class="form-control form-control-sm text-primary" placeholder="Last Name here...">
              </div>
              <input type="hidden" name="relationship_0" value="father">
            </div>
          </div>
          <div class="col-sm-3">
            <label for="contact_number" class="form-label"><span class="text-danger">*</span> Contact Number</label>
            <div class="col">
              <input type="text" class="form-control form-control-sm text-primary " name="contact_number_0" value="<?= (isset($relatives[0])) ? $relatives[0]->contact_number : set_value('contact_number_0') ?>" id="contact_number_0" placeholder="Father's Contact Number here...">
            </div>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="row g-2 g-lg-4">
          <div class="col-sm-9">
            <label for="mothersname" class="form-label"><span class="text-danger">*</span> Mothers Maiden name</label>
            <div class="row row-cols-1 row-cols-md-3 px-1 g-2 g-lg-3" id="mothersname">
              <div class="col">
                <input type="text" name="firstname_1" id="firstname_1" value="<?= (isset($relatives[1])) ? $relatives[1]->firstname : set_value('firstname_1') ?>" class="form-control form-control-sm text-primary" placeholder="First Name here...">
              </div>
              <div class="col">
                <input type="text" name="middlename_1" id="middlename_1" value="<?= (isset($relatives[1])) ? $relatives[1]->middlename : set_value('middlename_1') ?>" class="form-control form-control-sm text-primary" placeholder="Middle Name here...">
              </div>
              <div class="col">
                <input type="text" name="lastname_1" id="lastname_1" value="<?= (isset($relatives[1])) ? $relatives[1]->lastname : set_value('lastname_1') ?>" class="form-control form-control-sm text-primary" placeholder="Last Name here...">
              </div>
              <input type="hidden" name="relationship_1" value="mother">
            </div>
          </div>
          <div class="col-sm-3">
            <label for="contact_number" class="form-label"><span class="text-danger">*</span> Contact Number</label>
            <input type="text" class="form-control form-control-sm text-primary " name="contact_number_1" id="contact_number_1" value="<?= (isset($relatives[1])) ? $relatives[1]->contact_number : set_value('contact_number_1') ?>" placeholder="Mother's Contact Number here...">
          </div>
        </div>
      </div>
    </div>

    <!-- guardian -->
    <div class="fst-italic ps-3 mt-4 text-danger">Specify Guardian if you are not living with your parent.</div>

    <div class="col-12 col-4 px-3 mb-2">
      <label for="liveswithguardianorparent" class="form-label">Are you living with your parent?</label>
      <div class="form-control form-control-sm text-primary ps-4">
        <div class="row">
          <div class="form-check col-auto mb-0">
            <input class="form-check-input" type="radio" name="liveswithguardianorparent" value="yes" <?= (!isset($relatives[2])) ? set_radio('liveswithguardianorparent', 'yes', TRUE) : set_radio('liveswithguardianorparent', 'yes') ?> checked id="liveswithparent">
            <label class="form-check-label" for="liveswithparent">
              Yes
            </label>
          </div>
          <div class="form-check col-auto mb-0">
            <input class="form-check-input" type="radio" name="liveswithguardianorparent" value="no" <?= (isset($relatives[2])) ? set_radio('liveswithguardianorparent', 'no', TRUE) : set_radio('liveswithguardianorparent', 'no') ?> id="liveswithguardian">
            <label class="form-check-label" for="liveswithguardian">
              No
            </label>
          </div>
        </div>
      </div>
    </div>

    <div class="row px-3 g-2 g-lg-4" id="guardian">
      <div class="col-12 col-md-6">
        <label for="guardian" class="form-label">Guardian </label>
        <div class="row row-cols-1 row-cols-md-3 px-1 g-2 g-lg-3" id="guardian">
          <div class="col">
            <input type="text" name="firstname_2" id="firstname_2" value="<?= (isset($relatives[2])) ? $relatives[2]->firstname : set_value('firstname_2') ?>" class="form-control form-control-sm text-primary" <?= (isset($relatives[2])) ? '' : 'disabled' ?> placeholder="First Name here...">
          </div>
          <div class="col">
            <input type="text" name="middlename_2" id="middlename_2" value="<?= (isset($relatives[2])) ? $relatives[2]->middlename : set_value('middlename_2') ?>" class="form-control form-control-sm text-primary" <?= (isset($relatives[2])) ? '' : 'disabled' ?> placeholder="Middle Name here...">
          </div>
          <div class="col">
            <input type="text" name="lastname_2" id="lastname_2" value="<?= (isset($relatives[2])) ? $relatives[2]->lastname : set_value('lastname_2') ?>" class="form-control form-control-sm text-primary" <?= (isset($relatives[2])) ? '' : 'disabled' ?> placeholder="Last Name here...">
          </div>
        </div>
      </div>
      <div class="col-12 col-md-3">
        <label for="relationship" class="form-label">Relationship</label>
        <input type="text" name="relationship_2" id="relationship_2" value="<?= (isset($relatives[2])) ? $relatives[2]->relationship : set_value('relationship_2') ?>" class="form-control form-control-sm text-primary" <?= (isset($relatives[2])) ? '' : 'disabled' ?> placeholder="Relationship here...">
      </div>
      <div class="col-12 col-md-3">
        <label for="contact_number" class="form-label">Contact Number</label>
        <input type="text" class="form-control form-control-sm text-primary " name="contact_number_2" value="<?= (isset($relatives[2])) ? $relatives[2]->contact_number : set_value('contact_number_2') ?>" id="contact_number_2" <?= (isset($relatives[2])) ? '' : 'disabled' ?> placeholder="Guardian's Contact Number here...">
      </div>
    </div>

    <!-- For Returning Learners(Balik-Aral) and Those Who Shall Transfer/Move in -->
    <label for="returneeTransferee" class="h6 text-center bg-light w-100 mt-4 text-decoration-underline">For Returning Learners(Balik-Aral) and Those Who Shall Transfer/Move in</label>

    <div class="fst-italic ps-3 my-2 text-danger">If you are not a returnee or transferee please proceed to fill up the For Learners in Senior High School Section.</div>

    <div class="col-12 col-4 px-3 mb-2">
      <label for="returneeortransferee" class="form-label">Are you a transferee or Returnee?</label>
      <div class="form-control form-control-sm text-primary ps-4">
        <div class="row">
          <div class="form-check col-auto mb-0">
            <input class="form-check-input" type="radio" name="returneeortransferee" value="1" id="isreturneeortransferee">
            <label class="form-check-label" for="isreturneeortransferee">
              Yes
            </label>
          </div>
          <div class="form-check col-auto mb-0">
            <input class="form-check-input" type="radio" name="returneeortransferee" value="0" checked id="isnotreturneeortransferee">
            <label class="form-check-label" for="isnotreturneeortransferee">
              No
            </label>
          </div>
        </div>
      </div>
    </div>
    <div id="returneeTransferee" class="row g-2 g-lg-4 px-3 row-cols-1 row-cols-md-2">
      <div class="col">
        <label for="hea" class="form-label">Last Grade Level Completed</label>
        <input type="number" name="hea" id="hea" class="form-control form-control-sm text-primary" value="<?= (count($returnee_transferee) > 0) ? $returnee_transferee[0]->last_gradelevel : set_value('hea') ?>" disabled placeholder="Last Grade Level Completed here...">
      </div>
      <div class="col">
        <label for="hea_ay" class="form-label">Last School Year Completed</label>
        <input type="number" name="hea_ay" id="hea_ay" class="form-control form-control-sm text-primary" value="<?= (count($returnee_transferee) > 0) ? $returnee_transferee[0]->year_completed : set_value('hea_ay') ?>" disabled placeholder="Last School Year Completed here...">
      </div>
      <div class="col">
        <label for="prev_school" class="form-label">School Name</label>
        <input type="text" name="prev_school" id="prev_school" class="form-control form-control-sm text-primary" value="<?= (count($returnee_transferee) > 0) ? $returnee_transferee[0]->school_name : set_value('prev_school') ?>" disabled placeholder="School Name here...">
      </div>
      <div class="col">
        <label for="prev_school_address" class="form-label">School Address</label>
        <input type="text" name="prev_school_address" id="prev_school_address" value="<?= (count($returnee_transferee) > 0) ? $returnee_transferee[0]->school_address : set_value('prev_school_address') ?>" class="form-control form-control-sm text-primary" disabled placeholder="School Address here...">
      </div>
    </div>

    <!-- For SHS -->
    <label for="seniorhighstudent" class="h6 text-center bg-light w-100 mt-4 text-decoration-underline">For Learners in Senior High School</label>
    <div id="seniorhighstudent" class="row g-2 g-lg-4 px-3 row-cols-1 align-items-center">
      <div class="col-sm-3">
        <label for="semester" class="form-label"><span class="text-danger">*</span> Semester</label>
        <div class="form-control form-control-sm text-primary ps-4">
          <div class="row">
            <div class="form-check col-auto mb-0">
              <input class="form-check-input" type="radio" name="semester" value="1" id="firstsem" <?= (isset($enrollments) && $enrollments[0]->semester == 1) ? set_radio('semester', $enrollments[0]->semester, TRUE) : set_radio('semester', '1') ?>>
              <label class="form-check-label" for="firstsem">
                1st Sem
              </label>
            </div>
            <div class="form-check col-auto mb-0">
              <input class="form-check-input" type="radio" name="semester" value="2" id="secondsem" <?= (isset($enrollments) && $enrollments[0]->semester == 2) ? set_radio('semester', $enrollments[0]->semester, TRUE) : set_radio('semester', '2') ?>>
              <label class="form-check-label" for="secondsem">
                2nd Sem
              </label>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
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
            <option value="<?= $sy_start . '-' . $sy_end ?>" <?= ($enrollments[0]->acad_year == $sy_start . '-' . $sy_end) ? set_select('sy', $sy_start . '-' . $sy_end, TRUE) : set_select('sy', $sy_start . '-' . $sy_end) ?>>
              <?= $sy_start . '-' . $sy_end ?>
            </option>
          <?php endfor ?>
        </select>
      </div>
      <div class="col-sm-3">
        <label for="semester" class="form-label"><span class="text-danger">*</span> Grade Level</label>
        <input type="text" name="gradelevel" class="form-control form-control-sm text-primary" value="<?= (isset($enrollments)) ? $enrollments[0]->grade_level : set_value('gradelevel') ?>" placeholder="Grade Level here...">
      </div>
      <div class="col-sm-3">
        <label for="class" class="form-label"><span class="text-danger">*</span> Class</label>
        <select name="class" id="" class="form-select form-select-sm text-primary">
          <option value="" selected disabled>Select a Class...</option>
          <?php foreach ($class as $key => $class) : ?>
            <option value="<?= $class['class_id'] ?>" <?= (isset($enrollments) && $class['class_id'] == $enrollments[0]->class_id) ? set_select('class', $enrollments[0]->class_id, TRUE) : set_select('class', $class['class_id']) ?>><?= $class['class_name'] ?></option>
          <?php endforeach ?>
        </select>
      </div>
    </div>
    <div class="row px-3 py-2 py-lg-4 mb-4">
      <div class="col-12">
        <label for="course" class="form-label"><span class="text-danger">*</span> Track and Strands</label>
        <select name="course" id="course" class="form-select form-select-sm text-primary">
          <option value="" selected disabled>Select Track and Strands...</option>
          <?php foreach ($courses as $key => $course) : ?>
            <option value="<?= $course->course_id ?>" <?= (isset($enrollments) && $course->course_id == $enrollments[0]->course_id) ? set_select('class', $enrollments[0]->course_id, TRUE) : set_select('course', $course->course_id) ?>><?= $course->track_name ?> - <?= $course->strand_name ?></option>
          <?php endforeach ?>
        </select>
      </div>
    </div>

    <!-- For SHS -->
    <div class="alert alert-danger text-center">
      <strong><i class="fas fa-exclamation-triangle"></i> This portion is to be filled out by the Registrar.</strong>
      <label for="seniorhighstudent" class="h6 text-center bg-light w-100 mt-4 text-decoration-underline">Student's Requirements</label>
    </div>
    <div id="seniorhighstudent" class="row g-2 g-lg-4 px-3 row-cols-1 align-items-center mb-5">
      <div class="col-sm-3">
        <label for="isdocumentcomplete" class="form-label"><span class="text-danger">*</span> is the document complete?</label>
        <div class="form-control form-control-sm text-primary ps-4">
          <div class="row">
            <div class="form-check col-auto mb-0">
              <input class="form-check-input" type="radio" name="isdocumentcomplete" value="1" <?= (isset($enrollments) && $enrollments[0]->isDocumentComplete == '1') ? set_radio('isdocumentcomplete', $enrollments[0]->isDocumentComplete, TRUE) : set_radio('isdocumentcomplete', '1') ?> id="notcomplete">
              <label class="form-check-label" for="notcomplete">
                Yes
              </label>
            </div>
            <div class="form-check col-auto mb-0">
              <input class="form-check-input" type="radio" name="isdocumentcomplete" value="0" <?= (isset($enrollments) && $enrollments[0]->isDocumentComplete == '0') ? set_radio('isdocumentcomplete', $enrollments[0]->isDocumentComplete, TRUE) : set_radio('isdocumentcomplete', '0') ?> id="complete">
              <label class="form-check-label" for="complete">
                No
              </label>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <label for="status" class="form-label"><span class="text-danger">*</span> Marked As</label>
        <div class="form-control form-control-sm text-primary ps-4">
          <div class="row">
            <div class="form-check col-auto mb-0">
              <input class="form-check-input" type="radio" name="status" value="pending" <?= (isset($enrollments) && $enrollments[0]->status == 'pending') ? set_radio('semester', $enrollments[0]->status, TRUE) : set_radio('status', '1') ?> id="pending">
              <label class="form-check-label text-danger fst-italic" for="pending">
                Pending
              </label>
            </div>
            <div class="form-check col-auto mb-0">
              <input class="form-check-input" type="radio" name="status" value="approved" <?= (isset($enrollments) && $enrollments[0]->status == 'approved') ? set_radio('semester', $enrollments[0]->status, TRUE) : set_radio('status', '0') ?> id="approved">
              <label class="form-check-label text-success fst-italic" for="approved">
                Approved
              </label>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <label for="remarks" class="form-label">Remarks</label>
        <input type="text" class="form-control form-control-sm text-primary" name="remarks" placeholder="Remarks here...">
      </div>
    </div>
    <hr>
    <div class="gap-2 d-sm-flex justify-content-end mt-3 mb-3 p-3">
      <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
      <a href="<?= site_url() ?>r/assessment/evaluation/<?= $enrollments[0]->student_id ?>" type="button" class="btn btn-secondary "><i class="fas fa-arrow-right me-1"></i><span class="align-middle"> Proceed To Evaluation</span></a>
    </div>
    <?= form_close() ?>
  </div>
</main>

<script src="<?= site_url() ?>js/returneeform_toggle.js"></script>
<script>
  window.addEventListener("DOMContentLoaded", () => {
    const isreturnee_transferee = document.getElementById('isreturneeortransferee');
    const isnotreturnee_transferee = document.getElementById('isnotreturneeortransferee');
    const hea = document.getElementById('hea');
    const hea_ay = document.getElementById('hea_ay');
    const prev_school = document.getElementById('prev_school');
    const prev_school_address = document.getElementById('prev_school_address');

    isreturnee_transferee.addEventListener('change', () => {
      if (isreturnee_transferee.checked) {
        hea.toggleAttribute('disabled');
        hea_ay.toggleAttribute('disabled');
        prev_school.toggleAttribute('disabled');
        prev_school_address.toggleAttribute('disabled');
      }
    });
    isnotreturnee_transferee.addEventListener('change', () => {
      if (isnotreturnee_transferee.checked) {
        hea.toggleAttribute('disabled');
        hea_ay.toggleAttribute('disabled');
        prev_school.toggleAttribute('disabled');
        prev_school_address.toggleAttribute('disabled');
      }
    });
  })

  <?php if (count($returnee_transferee) > 0) : ?>
    hea.toggleAttribute('disabled');
    hea_ay.toggleAttribute('disabled');
    prev_school.toggleAttribute('disabled');
    prev_school_address.toggleAttribute('disabled');
    document.getElementById('isreturneeortransferee').setAttribute('checked', true);
    document.getElementById('isnotreturneeortransferee').removeAttribute('checked');
  <?php endif ?>
</script>
<script src="<?= site_url()?>js/preview_image.js"></script>
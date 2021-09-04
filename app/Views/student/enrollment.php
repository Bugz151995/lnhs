<main class="container">
  <div class="bg-white mt-4">
    <?= form_open_multipart('enrollment/submit')?>
      <!-- header -->
      <div class="bg-primary p-3 text-light text-center h5">Enrollment Form</div>
      <!-- learners information -->
      <div class="row">
        <!-- 2x2 -->
        <div class="col-lg-3 text-center align-self-center justify-self-center">
          <img src="<?= site_url()?>assets/images/user.jpg" alt="2by2 picture" id="img_preview" style="width: 200px; height: 200px; background-color: rgba(0,0,255,.1);" class="img-fluid img-thumbnail mx-4 rounded-circle">
          <div class="px-3 pt-2">
            <input type="file" name="user_img" value="<?= set_value('user_img')?>" id="user_img" class="form-control form-control-sm">
          </div>
        </div>
        <!-- learners information -->
        <div class="col-lg-9">
          <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 g-lg-4 g-2 p-3">
            <div class="col">
              <label for="firstname" class="form-label"><span class="text-danger">*</span> First name</label>
              <input type="text" class="form-control form-control-sm" name="firstname" value="<?= (isset($student)) ? $student[0]->firstname : set_value('firstname')?>" id="firstname" placeholder="First Name here...">
            </div>
            <div class="col">
              <label for="middlename" class="form-label"><span class="text-danger">*</span> Middle name</label>
              <input type="text" id="middlename" name="middlename" value="<?= (isset($student)) ? $student[0]->middlename : set_value('middlename')?>" class="form-control form-control-sm" placeholder="Middle Name here..."> 
            </div>
            <div class="col">
              <label for="lastname" class="form-label"><span class="text-danger">*</span> Last Name</label>
              <input type="text" class="form-control form-control-sm " id="lastname" name="lastname" value="<?= (isset($student)) ? $student[0]->lastname : set_value('lastname')?>" placeholder="Last Name here...">
            </div>
            <div class="col">
              <label for="nameextension" class="form-label"><span class="text-danger">*</span> Name Extension</label>
              <input type="text" class="form-control form-control-sm " id="nameextension" name="suffix" value="<?= set_value('suffix')?>" placeholder="Name Extendsion here...">
            </div>
            <div class="col">
              <label for="bday" class="form-label"><span class="text-danger">*</span> Birth Date</label>
              <input type="date" id="bday" name="bday" value="<?= set_value('bday')?>" class="form-control form-control-sm">
            </div>
            <div class="col">
              <label for="age" class="form-label"><span class="text-danger">*</span> Age</label>
              <input type="number" min="6" max="130" id="age" name="age" value="<?= set_value('age')?>" class="form-control form-control-sm" placeholder="Age here...">
            </div>
            <div class="col">
              <label for="religiosAffilication" class="form-label"><span class="text-danger">*</span> Sex</label>
              <div class="form-control form-control-sm d-flex align-items-center justify-content-center">
                <div class="form-check form-check-inline mb-0">
                  <input class="form-check-input" type="radio" name="sex" id="male" value="male" <?= set_radio('sex', 'male')?>>
                  <label class="form-check-label align-middle" for="male">Male</label>
                </div>
                <div class="form-check form-check-inline mb-0">
                  <input class="form-check-input" type="radio" name="sex" id="female" value="female" <?= set_radio('sex', 'female')?>>
                  <label class="form-check-label align-middle" for="female">Female</label>
                </div>
              </div>
            </div>
            <div class="col">
              <label for="religion" class="form-label"><span class="text-danger">*</span> Religious Affiliation</label>
              <input type="text" id="religion" name="religion" value="<?= set_value('religion')?>" class="form-control form-control-sm" placeholder="Religious Affiliation here...">
            </div>
            <div class="col">
              <label for="modality" class="form-label"><span class="text-danger">*</span> Learning Modality</label>
              <select name="modality" id="learningmodality" class="form-select form-select-sm">
                <option value="" disabled selected>Select Learning Modality</option>
                <option value="Modular(print)" <?= set_select('modality', 'Modular(print)')?>>Modular(print)</option>
                <option value="Modular(digital)" <?= set_select('modality', 'Modular(digital)') ?>>Modular(digital)</option>
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
          <input type="text" id="street" name="street" value="<?= set_value('street')?>" class="form-control form-control-sm " placeholder="House #/Street/Sitio/Purok here...">
        </div>

        <div class="col">
          <label for="barangay" class="form-label"><span class="text-danger">*</span> Barangay</label>
          <input type="text" id="barangay" name="barangay" value="<?= set_value('barangay')?>" class="form-control form-control-sm" placeholder="Barangay here...">
        </div>

        <div class="col">
          <label for="mun_city" class="form-label"><span class="text-danger">*</span> Municipality/City</label>
          <input type="text" id="mun_city" name="mun_city" value="<?= set_value('mun_city')?>" class="form-control form-control-sm" placeholder="Municipality/City here...">
        </div>

        <div class="col">
          <label for="province" class="form-label"><span class="text-danger">*</span> Province</label>
          <input type="text" id="province" name="province" value="<?= set_value('province')?>" class="form-control form-control-sm " placeholder="Province here...">
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
                  <input type="text" name="firstname_0" value="<?= set_value('firstname_0')?>" id="firstname_0" class="form-control form-control-sm" placeholder="First Name here...">
                </div>
                <div class="col">
                  <input type="text" name="middlename_0" value="<?= set_value('middlename_0')?>" id="middlename_0" class="form-control form-control-sm" placeholder="Middle Name here...">
                </div>
                <div class="col">
                  <input type="text" name="lastname_0" value="<?= set_value('lastname_0')?>" id="lastname_0" class="form-control form-control-sm" placeholder="Last Name here...">
                </div>
                <input type="hidden" name="relationship_0" value="father">
              </div>
            </div>
            <div class="col-sm-3">
              <label for="contact_number" class="form-label"><span class="text-danger">*</span> Contact Number</label>
              <div class="col">
                <input type="text" class="form-control form-control-sm " name="contact_number_0" value="<?= set_value('contact_number_0')?>" id="contact_number_0" placeholder="Father's Contact Number here...">
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
                  <input type="text" name="firstname_1" id="firstname_1" value="<?= set_value('firstname_1')?>" class="form-control form-control-sm" placeholder="First Name here...">
                </div>
                <div class="col">
                  <input type="text" name="middlename_1" id="middlename_1" value="<?= set_value('middlename_1')?>" class="form-control form-control-sm" placeholder="Middle Name here...">
                </div>
                <div class="col">
                  <input type="text" name="lastname_1" id="lastname_1" value="<?= set_value('lastname_1')?>" class="form-control form-control-sm" placeholder="Last Name here...">
                </div>
                <input type="hidden" name="relationship_1" value="mother">
              </div>
            </div>
            <div class="col-sm-3">
              <label for="contact_number" class="form-label"><span class="text-danger">*</span> Contact Number</label>
              <input type="text" class="form-control form-control-sm " name="contact_number_1" id="contact_number_1" value="<?= set_value('contact_number_1')?>" placeholder="Mother's Contact Number here...">
            </div>
          </div>
        </div>
      </div>

      <!-- guardian -->
      <div class="fst-italic ps-3 mt-4 text-danger">Specify Guardian if you are not living with your parent.</div>

      <div class="col-12 col-4 px-3 mb-2">
        <label for="liveswithguardianorparent" class="form-label">Are you living with your parent?</label>
        <div class="form-control form-control-sm ps-4">
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
      </div>

      <div class="row px-3 g-2 g-lg-4" id="guardian">
        <div class="col-12 col-md-6">
          <label for="guardian" class="form-label">Guardian </label>
          <div class="row row-cols-1 row-cols-md-3 px-1 g-2 g-lg-3" id="guardian">
            <div class="col">
              <input type="text" name="firstname_2" id="firstname_2" value="<?= set_value('firstname_2')?>" class="form-control form-control-sm" disabled placeholder="First Name here...">
            </div>
            <div class="col">
              <input type="text" name="middlename_2" id="middlename_2" value="<?= set_value('middlename_2')?>" class="form-control form-control-sm" disabled placeholder="Middle Name here...">
            </div>
            <div class="col">
              <input type="text" name="lastname_2" id="lastname_2" value="<?= set_value('lastname_2')?>" class="form-control form-control-sm" disabled placeholder="Last Name here...">
            </div>
          </div>
        </div>
        <div class="col-12 col-md-3">
          <label for="relationship" class="form-label">Relationship</label>
          <input type="text" name="relationship_2" id="relationship_2" value="<?= set_value('relationship_2')?>" class="form-control form-control-sm" disabled placeholder="Relationship here...">
        </div>
        <div class="col-12 col-md-3">
          <label for="contact_number" class="form-label">Contact Number</label>
          <input type="text" class="form-control form-control-sm " name="contact_number_2" value="<?= set_value('contact_number_2')?>" id="contact_number_2" disabled placeholder="Guardian's Contact Number here...">
        </div>
      </div>

      <!-- For Returning Learners(Balik-Aral) and Those Who Shall Transfer/Move in -->
      <label for="returneeTransferee" class="h6 text-center bg-light w-100 mt-4 text-decoration-underline">For Returning Learners(Balik-Aral) and Those Who Shall Transfer/Move in</label>

      <div class="fst-italic ps-3 my-2 text-danger">If you are not a returnee or transferee please proceed to fill up the For Learners in Senior High School Section.</div>

      <div class="col-12 col-4 px-3 mb-2">
        <label for="returneeortransferee" class="form-label">Are you a transferee or Returnee?</label>
        <div class="form-control form-control-sm ps-4">
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
      <div id="returneeTransferee" class="row g-2 g-lg-4 px-3 row-cols-1 row-cols-md-2">
        <div class="col">
          <label for="hea" class="form-label">Last Grade Level Completed</label>
          <input type="number" name="hea" id="hea" class="form-control form-control-sm" value="<?= set_value('hea')?>" disabled placeholder="Last Grade Level Completed here...">
        </div>
        <div class="col">
          <label for="hea_ay" class="form-label">Last School Year Completed</label>
          <input type="number" name="hea_ay" id="hea_ay" class="form-control form-control-sm" value="<?= set_value('hea_ay')?>" disabled placeholder="Last School Year Completed here...">
        </div>
        <div class="col">
          <label for="prev_school" class="form-label">School Name</label>
          <input type="text" name="prev_school" id="prev_school" class="form-control form-control-sm" value="<?= set_value('prev_school')?>" disabled placeholder="School Name here...">
        </div>
        <div class="col">
          <label for="prev_school_address" class="form-label">School Address</label>
          <input type="text" name="prev_school_address" id="prev_school_address" value="<?= set_value('prev_school_address')?>" class="form-control form-control-sm" disabled placeholder="School Address here...">
        </div>
      </div>
      
      <!-- For SHS -->
      <label for="seniorhighstudent" class="h6 text-center bg-light w-100 mt-4 text-decoration-underline">For Learners in Senior High School</label>
      <div id="seniorhighstudent" class="row g-2 g-lg-4 px-3 row-cols-1 align-items-center">
        <div class="col-sm-3">
          <label for="semester" class="form-label"><span class="text-danger">*</span> Semester</label>
          <div class="form-control form-control-sm ps-4">
            <div class="row">
              <div class="form-check col-auto mb-0">
                <input class="form-check-input" type="radio" name="semester" value="1" id="firstsem" <?= set_radio('semester', '1')?>>
                <label class="form-check-label" for="firstsem">
                  1st Sem
                </label>
              </div>
              <div class="form-check col-auto mb-0">
                <input class="form-check-input" type="radio" name="semester" value="2" id="secondsem" <?= set_radio('semester', '2')?>>
                <label class="form-check-label" for="secondsem">
                  2nd Sem
                </label>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <label for="semester" class="form-label"><span class="text-danger">*</span> Grade Level</label>
          <input type="text" name="gradelevel" class="form-control form-control-sm" value="<?= set_value('gradelevel')?>" placeholder="Grade Level here...">
        </div>
        <div class="col-sm-3">
          <label for="section" class="form-label"><span class="text-danger">*</span> Section</label>
          <select name="section" id="" class="form-select form-select-sm">
            <option value="" selected disabled>Select a Section...</option>
            <?php foreach($sections as $key => $section) : ?>
              <option value="<?= $section['section_id']?>" <?= set_select('section', $section['section_id']) ?>><?= $section['section_name']?></option>
            <?php endforeach ?>
          </select>
        </div>
      </div>
        <div class="row px-3 py-2 py-lg-4">
          <div class="col-12">
            <label for="course" class="form-label"><span class="text-danger">*</span> Track and Strands</label>
            <select name="course" id="course" class="form-select form-select-sm">
              <option value="" selected disabled>Select Track and Strands...</option>
              <?php foreach($courses as $key => $course) : ?>
                <option value="<?= $course->course_id?>" <?= set_select('course', $course->course_id) ?>><?= $course->track_name?> - <?= $course->strand_name?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>

      <div class="gap-2 d-sm-flex justify-content-end mt-3 mb-3 px-3 pb-3">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    <?= form_close()?>
  </div>
</main>

<script src="<?= site_url()?>js/returneeform_toggle.js"></script>
<script src="<?= site_url()?>js/guardianfield_toggle.js"></script>
<script src="<?= site_url()?>js/preview_image.js"></script>
<main class="container">
  <div class="bg-white mt-4">
    <?= form_open_multipart('enrollment/submit')?>
      <!-- header -->
      <div class="bg-light p-3 text-center h5">Enrollment Form</div>
      <!-- learners information -->
      <div class="row">
        <!-- 2x2 -->
        <div class="col-lg-3 text-center align-self-center justify-self-center">
          <img src="<?= site_url()?>assets/images/user.jpg" alt="hugenerd" style="width: 200px; height: 200px; background-color: rgba(0,0,255,.1);" class="img-fluid img-thumbnail mx-4 rounded-circle" alt="">
          <div class="px-3 pt-2">
            <input type="file" name="user_img" id="user_img" class="form-control form-control-sm">
          </div>
        </div>
        <!-- learners information -->
        <div class="col-lg-9">
          <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 g-lg-4 g-2 px-3">
            <div class="col">
              <label for="firstname" class="form-label">First name</label>
              <input type="text" class="form-control form-control-sm" name="firstname" id="firstname" placeholder="First Name here...">
            </div>
            <div class="col">
              <label for="middlename" class="form-label">Middle name</label>
              <input type="text" id="middlename" name="middlename" class="form-control form-control-sm" placeholder="Middle Name here..."> 
            </div>
            <div class="col">
              <label for="lastname" class="form-label">Last Name</label>
              <input type="text" class="form-control form-control-sm " id="lastname" name="lastname" placeholder="Last Name here...">
            </div>
            <div class="col">
              <label for="nameextension" class="form-label">Name Extension</label>
              <input type="text" class="form-control form-control-sm " id="nameextension" name="suffix" placeholder="Name Extendsion here...">
            </div>
            <div class="col">
              <label for="bday" class="form-label">Birth Date</label>
              <input type="date" id="bday" name="bday" class="form-control form-control-sm">
            </div>
            <div class="col">
              <label for="age" class="form-label">Age</label>
              <input type="number" min="6" max="130" id="age" name="age" class="form-control form-control-sm" placeholder="Age here...">
            </div>
            <div class="col">
              <label for="religiosAffilication" class="form-label">Sex</label>
              <div class="form-control form-control-sm d-flex align-items-center justify-content-center">
                <div class="form-check form-check-inline mb-0">
                  <input class="form-check-input" type="radio" name="sex" id="male" value="male">
                  <label class="form-check-label align-middle" for="male">Male</label>
                </div>
                <div class="form-check form-check-inline mb-0">
                  <input class="form-check-input" type="radio" name="sex" id="female" value="female">
                  <label class="form-check-label align-middle" for="female">Female</label>
                </div>
              </div>
            </div>
            <div class="col">
              <label for="religion" class="form-label">Religious Affiliation</label>
              <input type="text" id="religion" name="religion" class="form-control form-control-sm" placeholder="Religious Affiliation here...">
            </div>
            <div class="col">
              <label for="gradeLevel" class="form-label">Grade Level</label>
              <input type="text" class="form-control form-control-sm " id="gradeLevel" name="grade" placeholder="Grade Level here...">
            </div>
            <div class="col">
              <label for="modality" class="form-label">Learning Modality</label>
              <select name="modality" id="learningmodality" class="form-select form-select-sm">
                <option value="" disabled selected>Select Learning Modality</option>
                <option value="Modular(print)">Modular(print)</option>
                <option value="Modular(digital)">Modular(digital)</option>
              </select>
            </div>
          </div> 
        </div>
      </div>

      <!-- complete address -->
      <label for="address" class="h6 text-center bg-light w-100 mt-4 text-decoration-underline">Complete Address</label>
      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 px-3 g-2 g-lg-4"> 
        <div class="col">
          <label for="street" class="form-label">House #/Street/Sitio/Purok</label>
          <input type="text" id="street" name="street" class="form-control form-control-sm " placeholder="House #/Street/Sitio/Purok here...">
        </div>

        <div class="col">
          <label for="barangay" class="form-label">Barangay</label>
          <input type="text" id="barangay" name="barangay" class="form-control form-control-sm" placeholder="Barangay here...">
        </div>

        <div class="col">
          <label for="mun_city" class="form-label">Municipality/City</label>
          <input type="text" id="mun_city" name="mun_city" class="form-control form-control-sm" placeholder="Municipality/City here...">
        </div>

        <div class="col">
          <label for="province" class="form-label">Province</label>
          <input type="text" id="province" name="province" class="form-control form-control-sm " placeholder="Province here...">
        </div>
      </div>
      
      <!-- parent information -->
      <div for="parent" class="h6 text-center bg-light w-100 mt-4 text-decoration-underline">Parents/Guardian</div>
      <div class="row row-cols-1 px-3 g-2 g-lg-4">  
        <div class="col">
          <div class="row g-2 g-lg-4">
            <div class="col-sm-9">
              <label for="fathersname" class="form-label">Fathers name</label>
              <div class="row row-cols-1 row-cols-md-3 px-1 g-2 g-lg-3" id="fathersname">
                <div class="col">
                  <input type="text" name="firstname_0" id="firstname_0" class="form-control form-control-sm" placeholder="First Name here...">
                </div>
                <div class="col">
                  <input type="text" name="middlename_0" id="middlename_0" class="form-control form-control-sm" placeholder="Middle Name here...">
                </div>
                <div class="col">
                  <input type="text" name="lastname_0" id="lastname_0" class="form-control form-control-sm" placeholder="Last Name here...">
                </div>
                <input type="hidden" name="relationship_0" value="father">
              </div>
            </div>
            <div class="col-sm-3">
              <label for="contact_number" class="form-label">Contact Number</label>
              <div class="col">
                <input type="text" class="form-control form-control-sm " name="contact_number_0" id="contact_number_0" placeholder="Father's Contact Number here...">
              </div>
            </div>
          </div>
        </div>

        <div class="col">
          <div class="row g-2 g-lg-4">
            <div class="col-sm-9">
              <label for="mothersname" class="form-label">Mothers Maiden name</label>
              <div class="row row-cols-1 row-cols-md-3 px-1 g-2 g-lg-3" id="mothersname">
                <div class="col">
                  <input type="text" name="firstname_1" id="firstname_1" class="form-control form-control-sm" placeholder="First Name here...">
                </div>
                <div class="col">
                  <input type="text" name="lastname_1" id="lastname_1" class="form-control form-control-sm" placeholder="Middle Name here...">
                </div>
                <div class="col">
                  <input type="text" name="lastname_1" id="lastname_1" class="form-control form-control-sm" placeholder="Last Name here...">
                </div>
                <input type="hidden" name="relationship_1" value="mother">
              </div>
            </div>
            <div class="col-sm-3">
              <label for="contact_number" class="form-label">Contact Number</label>
              <input type="text" class="form-control form-control-sm " name="contact_number_1" id="contact_number_1" placeholder="Mother's Contact Number here...">
            </div>
          </div>
        </div>
      </div>

      <!-- guardian -->
      <div for="guardian" class="fst-italic ps-3 mt-4 text-danger">Specify Guardian if you are not living with your parent.</div>
      <div class="row px-3 g-2 g-lg-4 pt-4" id="guardian">
        <div class="col-12 col-md-6">
          <label for="guardian" class="form-label">Guardian </label>
          <div class="row row-cols-1 row-cols-md-3 px-1 g-2 g-lg-3" id="guardian">
            <div class="col">
              <input type="text" name="firstname_2" id="firstname_2" class="form-control form-control-sm" placeholder="First Name here...">
            </div>
            <div class="col">
              <input type="text" name="middlename_2" id="middlename_2" class="form-control form-control-sm" placeholder="Middle Name here...">
            </div>
            <div class="col">
              <input type="text" name="lastname_2" id="lastname_2" class="form-control form-control-sm" placeholder="Last Name here...">
            </div>
          </div>
        </div>
        <div class="col-12 col-md-3">
          <label for="relationship" class="form-label">Relationship</label>
          <input type="text" name="relationship_2" id="relationship" class="form-control form-control-sm" placeholder="Relationship here...">
        </div>
        <div class="col-12 col-md-3">
          <label for="contact_number" class="form-label">Contact Number</label>
          <input type="text" class="form-control form-control-sm " name="contact_number_2" id="contact_number_2" placeholder="Guardian's Contact Number here...">
        </div>
      </div>

      <!-- For Returning Learners(Balik-Aral) and Those Who Shall Transfer/Move in -->
      <label for="returneeTransferee" class="h6 text-center bg-light w-100 mt-4 text-decoration-underline">For Returning Learners(Balik-Aral) and Those Who Shall Transfer/Move in</label>
      <div class="row g-2 g-lg-4 px-3 row-cols-1 row-cols-md-2">
        <div class="col">
          <label for="hea" class="form-label">Last Grade Level Completed</label>
          <input type="number" name="hea" id="hea" class="form-control" placeholder="Last Grade Level Completed here...">
        </div>
        <div class="col">
          <label for="hea_ay" class="form-label">Last School Year Completed</label>
          <input type="number" name="hea_ay" id="hea_ay" class="form-control" placeholder="Last School Year Completed here...">
        </div>
        <div class="col">
          <label for="prev_school" class="form-label">School Name</label>
          <input type="text" name="prev_school" id="prev_school" class="form-control" placeholder="School Name here...">
        </div>
        <div class="col">
          <label for="prev_school_address" class="form-label">School Address</label>
          <input type="text" name="prev_school_address" id="prev_school_address" class="form-control" placeholder="School Address here...">
        </div>
      </div>
      
      <!-- For SHS -->
      <label for="returneeTransferee" class="h6 text-center bg-light w-100 mt-4 text-decoration-underline">For Learners in Senior High School</label>
      <div class="row g-2 g-lg-4 px-3 row-cols-1 row-cols-md-2">
        <div class="col">
          <label for="semester" class="form-label">Semester</label>
          <div class="row">
            <div class="form-check col">
              <input class="form-check-input" type="radio" name="semester" id="firstsem">
              <label class="form-check-label" for="firstsem">
                1st Sem
              </label>
            </div>
            <div class="form-check col">
              <input class="form-check-input" type="radio" name="semester" id="secondsem">
              <label class="form-check-label" for="secondsem">
                2nd Sem
              </label>
            </div>
          </div>
        </div>
        <div class="col">
          <label for="course" class="form-label">Track and Strands</label>
          <select name="course" id="course" class="form-select">
            <option value="" selected disabled>Select Track and Strands...</option>
          </select>
        </div>
      </div>

      
      <div class="gap-2 d-sm-flex justify-content-end mt-3 mb-3 px-3 pb-3">
        <button type="button" class="btn btn-primary">Submit</button>
      </div>
    <?= form_close()?>
  </div>
</main>
  <main class="p-4 my-container"> 
    
    <form class="bg-light mx-3 rounded bg-white border">
      <!-- header -->
      <div class="bg-light p-3 text-center h5">Learner's Infomation</div>
      <!-- learners information -->
      <div class="row">
        <div class="col-lg-3 text-center align-self-center justify-self-center">
          <img src="<?= site_url()?>assets/images/user.jpg" alt="hugenerd" style="width: 200px; height: 200px; background-color: rgba(0,0,255,.1);" class="  img-fluid img-thumbnail mx-4 rounded-circle" alt="">
        </div>
        <div class="col-lg-9">
          <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 g-lg-4 g-2 px-3">
            <div class="col">
              <label for="lrn" class="form-label">LRN</label>
              <input type="text" class="form-control form-control-sm " id="lrn" value="136887090657"  disabled>
            </div>
            <div class="col">
              <label for="firstName" class="form-label">First name</label>
              <input type="text" class="form-control form-control-sm " id="firstName" value="Jake"  disabled>
            </div>
            <div class="col">
              <label for="middleName" class="form-label">Middle name</label>
              <input type="text" id="middleName" class="form-control form-control-sm " value="Reno"  disabled> 
            </div>
            <div class="col">
              <label for="surName" class="form-label">Sur name</label>
              <input type="text" class="form-control form-control-sm " id="surName" value="Garcia"  disabled>
            </div>
            <div class="col">
              <label for="nameExtension" class="form-label">Name Extension</label>
              <input type="text" class="form-control form-control-sm " id="nameExtension" value="N/A"  disabled>
            </div>
            <div class="col">
              <label for="dateOfBirth" class="form-label">Date of Birth</label>
              <input type="text" id="dateOfBirth" class="form-control form-control-sm " value="02/09/2003"  disabled>
            </div>
            <div class="col">
              <label for="religiosAffilication" class="form-label">Religious Affilication</label>
              <input type="text" id="religiosAffilication" class="form-control form-control-sm " value="Catholic"  disabled>
            </div>
            <div class="col">
              <label for="gradeLevel" class="form-label">Grade Level</label>
              <input type="text" class="form-control form-control-sm " id="gradeLevel" value="Grade 11"  disabled>
            </div>
            <div class="col">
              <label for="dateOfAdmission" class="form-label">Date Of Admission</label>
              <input type="text" class="form-control form-control-sm " id="gradeLevel" value="06/03/2020"  disabled>
            </div>
            <div class="col">
              <label for="learningModality" class="form-label">Learning Modality</label>
              <input type="text" class="form-control form-control-sm " id="learningModality" value="Modular (print)"  disabled>
            </div>
          </div> 
        </div>
      </div>

      <!-- complete address -->
      <label for="completeAddress" class="h6 text-center bg-light w-100 mt-4"><u>Complete Address</u></label>
      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 px-3 g-2 g-lg-4"> 

        <div class="col">
          <label for="houseNo" class="form-label">House #/Street/Sitio/Purok</label>
          <input type="text" id="houseNo" class="form-control form-control-sm " value=""  disabled>
        </div>

        <div class="col">
          <label for="barangay" class="form-label">Barangay</label>
          <input type="text" id="barangay" class="form-control form-control-sm " value="San Rafael"  disabled>
        </div>

        <div class="col">
          <label for="municipalityCity" class="form-label">Municipality/ City</label>
          <input type="text" id="municipalityCity" class="form-control form-control-sm " value="Lagonoy"  disabled>
        </div>

        <div class="col">
          <label for="province" class="form-label">Province</label>
          <input type="text" id="province" class="form-control form-control-sm " value="Goa Camarines Sur"  disabled>
        </div>
      </div>
        
      <!-- parent information -->
      <label for="parent" class="h6 text-center bg-light w-100 mt-4"><u>Parents</u></label>
      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 px-3 g-2 g-lg-4">  
        <div class="col ">
          <label for="fathersName" class="form-label">Fathers name</label>
          <input type="text" class="form-control form-control-sm " id="fathersName" value="James A. Garcia"  disabled>
        </div>
        <div class="col ">
          <label for="mothersName" class="form-label">Mothers name</label>
          <input type="text" id="middleName" class="form-control form-control-sm " value="Melody R. Garcia"  disabled> 
        </div>
        <div class="col ">
          <label for="guardian" class="form-label">Guardian </label>
          <input type="text" class="form-control form-control-sm " id="mothersName" value=""  disabled>
        </div>
        <div class="col ">
          <label for="parentGardianNo" class="form-label">ContactNo. Parent or Guardian</label>
          <input type="text" class="form-control form-control-sm " id="parentGardianNo" value=""  disabled>
        </div>
      </div>


      <div class="container-sm bg-light p-3 text-center h5 mt-5">Eligibility For SHS Enrollment</div>
      <!-- student grade in high school and junior high school -->
      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-4 px-3 g-2 g-lg-4">
        <div class="col">
          <label for="middleName" class="form-label">High School Completer</label>
          <div class="input-group-text ">
            <input type="checkbox" aria-label="Checkbox for following text input" value="High School Completer" checked>
          </div>
        </div>
        <div class="col">
          <label for="genAve" class="form-label">Gen. Ave</label>
          <input type="number" class="form-control form-control-sm " id="surName" value="85.7"  disabled>
        </div>
        <div class="col">
          <label for="middleName" class="form-label">Junior High School Completer</label>
          <div class="input-group-text ">
            <input type="checkbox" aria-label="Checkbox for following text input" value="High School Completer" checked>
          </div>
        </div>
        <div class="col">
          <label for="genAve" class="form-label">Gen. Ave</label>
          <input type="number" class="form-control form-control-sm " id="surName" value="85.7"  disabled>
        </div>
      </div>

      <div class="row row-cols-1 row-cols-md-1 row-cols-lg-3 pt-2 px-3 g-2 g-lg-4">
        <div class="col">
          <label for="dateOfGrad" class="form-label">Date Of Graduation/Completion</label>
          <input type="text" class="form-control form-control-sm " id="dateOfGrad" value="04/18/2020"  disabled>
        </div>
        <div class="col">
          <label for="nameOfSchool" class="form-label">Name Of School</label>
          <input type="text" id="nameOfSchool" class="form-control form-control-sm " value="Lagonoy High"  disabled>
        </div>
        <div class="col">
          <label for="schoolAddress" class="form-label">School Address</label>
          <input type="text" class="form-control form-control-sm " id="lrn" value="Sta. Maria, Lagonoy, Camarines Sur"  disabled>
        </div>
      </div>

      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 pt-2 px-3 g-2 g-lg-4">
        <div class="col">
          <label for="peptPasser" class="form-label">PEPT Passer</label>
          <div class="input-group-text ">
            <input type="checkbox" aria-label="Checkbox for following text input" id="peptPasser" value="" disabled>
          </div>
        </div>
        <div class="col">
          <label for="ratingPept" class="form-label">Rating</label>
          <input type="number" class="form-control form-control-sm " id="ratingPept" value=""  disabled>
        </div>
        <div class="col">
          <label for="alsPasser" class="form-label">ALS A&E Passer</label>
          <div class="input-group-text ">
            <input type="checkbox" aria-label="Checkbox for following text input" id="alsPasser" value="" disabled >
          </div>
        </div>
        <div class="col">
          <label for="ratingPept" class="form-label">Rating</label>
          <input type="number" class="form-control form-control-sm " id="ratingPept" value=""  disabled>
        </div>
      </div>

      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 pt-2 px-3 g-2 g-lg-4">
        <div class="col">
          <label for="othesPlsspecify" class="form-label">Others (PLs.Specify)</label>
          <div class="input-group-text ">
            <input type="checkbox" aria-label="Checkbox for following text input" id="othesPlsspecify" value="" disabled>
          </div>
        </div>
        <div class="col">
          <label for="dateOfExam" class="form-label">Date Of Examination/Assessment</label>
          <input type="text" class="form-control form-control-sm " id="dateOfExam" value="06/03/2020"  disabled>
        </div>
      </div>
      
      <div class="col-12 px-3 pt-2">
        <label for="leaningCenter" class="form-label">Name and Address of Cummunity Learning Center</label>
        <input type="text" class="form-control form-control-sm " id="leaningCenter" value=""  disabled>
      </div>

      <div class="gap-2 d-sm-flex justify-content-end mt-3 mb-3 px-3">
        <button type="button" class="btn btn-success">Add</button>
        <button type="button" class="btn btn-danger">Delete</button>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Notify</button>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h6 class="modal-title " id="exampleModalLabel">Send Email to Student</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="input-group ">
                  <span class="input-group-text" id="basic-addon1"><i class="far fa-envelope"></i></span>
                  <input type="text" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" value="jakeGAr@gmail.com" disabled>
                </div>
                <div class="mb-3">
                  <label for="exampleFormControlTextarea1" class="form-label">Message</label>
                  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-primary">Send</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </main>
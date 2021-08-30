<main class="container">
  <div class="bg-white my-4 py-3">
    <!-- form label -->
    <div class="text-center">
      <h5>Education Service Contracting</h5>
      <div>Application Form</div>
      <div>ESC Form 1</div>
    </div>

    <!-- Personal Information -->
    <div class="bg-light text-center h6 mt-3 text-decoration-underline">About Me</div>
    <div class="row">
      <div class="col-lg-3 text-center align-self-center justify-self-center">
        <img src="<?= site_url()?>assets/images/user.jpg" alt="hugenerd" style="width: 200px; height: 200px; background-color: rgba(0,0,255,.1);" class="  img-fluid img-thumbnail mx-4 rounded-circle" alt="">
      </div>
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
            <input type="text" class="form-control form-control-sm " id="nameextension" name="nameextension" placeholder="Name Extendsion here...">
          </div>
          <div class="col">
            <label for="bday" class="form-label">Birth Date</label>
            <input type="date" id="bday" name="bday" class="form-control form-control-sm">
          </div>
          <div class="col">
            <label for="bday_place" class="form-label">Birth Place</label>
            <input type="text" id="bday_place" name="bday_place" class="form-control form-control-sm" placeholder="Place of Birth here...">
          </div>
          <div class="col">
            <label for="sex" class="form-label">Gender</label>
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
            <label for="nationality" class="form-label">Nationality</label>
            <div class="form-control form-control-sm d-flex align-items-center justify-content-center">
              <div class="form-check form-check-inline mb-0">
                <input class="form-check-input" type="radio" name="nationality" id="filipino" value="filipino">
                <label class="form-check-label align-middle" for="male">Filipino</label>
              </div>
              <div class="form-check form-check-inline mb-0">
                <div class="input-group">
                  <div class="input-group-text">
                    <input class="form-check-input" type="radio" name="nationality" id="female" value="others">
                    <label class="form-check-label align-middle" for="others">Others</label>
                  </div>
                  <input type="text" name="" class="form-control">
                </div>
              </div>
            </div>
          </div>
        </div> 
      </div>
    </div>

    <!-- complete address -->
    <label for="address" class="h6 text-center bg-light w-100 mt-4 text-decoration-underline">Address and Contact Details</label>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 px-3 g-2 g-lg-4"> 
      <div class="col">
        <label for="street" class="form-label">Street Address</label>
        <input type="text" id="street" name="street" class="form-control form-control-sm " placeholder="Street Address here...">
      </div>

      <div class="col">
        <label for="barangay" class="form-label">Barangay/District</label>
        <input type="text" id="barangay" name="barangay" class="form-control form-control-sm" placeholder="Barangay/District here...">
      </div>

      <div class="col">
        <label for="mun_city" class="form-label">Municipality/City</label>
        <input type="text" id="mun_city" name="mun_city" class="form-control form-control-sm" placeholder="Municipality/City here...">
      </div>

      <div class="col">
        <label for="province" class="form-label">Province</label>
        <input type="text" id="province" name="province" class="form-control form-control-sm " placeholder="Province here...">
      </div>
      
      <div class="col">
        <label for="zip_code" class="form-label">Zip Code</label>
        <input type="text" id="zip_code" name="zip_code" class="form-control form-control-sm " placeholder="Zip Code here...">
      </div>

      <div class="col">
        <label for="contact_number" class="form-label">Mobile/Landline No.</label>
        <div class="input-group input-group-sm">
          <div class="input-group-text">+63</div>
          <input type="number" id="contact_number" name="contact_number" class="form-control form-control-sm " placeholder="9XXXXXXXXX">
        </div>
      </div>

      <div class="col">
        <label for="email" class="form-label">Email Address</label>
        <input type="email" id="email" name="email" class="form-control form-control-sm " placeholder="Email Address here...">
      </div>
    </div>

    <!-- family background -->
    <label for="familybg" class="h6 text-center bg-light w-100 mt-4 text-decoration-underline">About My Family</label>
    <!-- table -->
    <div class="p-3">
      <div class="fst-italic text-danger">If the family member is your mother, please input her maiden name.</div>
      <div class="table-responsive w-100 p-0">
        <table class="table table-borderless table-light border table-striped mt-2 mb-0">
          <thead>
            <tr class="text-center">
              <th>Last Name</th>
              <th>First Name</th>
              <th>Middle Name</th>
              <th>Relationship</th>
              <th></th>
            </tr>
          </thead>
          <tbody id="tierTable">
            <tr>
              <td><input type="text" class="form-control form-control-sm" name="fbg_fullname_1" placeholder="Last Name Here..."></td>
              <td><input type="text" class="form-control form-control-sm" name="fbg_firstname_1" placeholder="First Name Here..."></td>
              <td><input type="text" class="form-control form-control-sm" name="fbg_middlename_1" placeholder="Middle Name Here..."></td>
              <td><input type="text" class="form-control form-control-sm" name="fbg_relation_1" placeholder="Relationship Here..."></td>
              <td class="text-center align-middle">
                <div class="remove-row">
                  <i class="far fa-times-circle text-secondary fa-fw fa-lg"></i>
                </div>
              </td>
            </tr>
          </tbody>                    
        </table>
      </div>
      <div class="mb-3 mt-2 p-0 w-100">
        <div id="addTierBtn" class="p-0 p-sm-2 btn btn-light form-control">
          <i class="far fa-plus-square text-success fa-fw fa-lg"></i> <span>Add Row</span>
        </div>
      </div>
    </div>
    
    <!-- other family information -->
    <label for="otherfamilyinfo" class="form-label px-3">Does your family own any of the following:</label>
    <div class="row row-cols-1 row-cols-sm-1 px-3 g-2 g-lg-4 small">
      <div class="col d-flex align-items-center justify-content-between justify-content-sm-start">
        <label for="motorcycle_pedicab" class="form-label m-0 pe-1">1.) Motorcycle/Pedicab:</label>
        <div class="border form-control-sm d-flex align-items-center justify-content-center gap-2">
          <div class="form-check  mb-0">
            <input class="form-check-input" type="radio" name="motorcycle_pedicab" id="motorcycle_pedicab_yes" value="yes">
            <label class="form-check-label align-middle" for="motorcycle_pedicab">Yes</label>
          </div>
          <div class="form-check  mb-0">
            <input class="form-check-input" type="radio" name="motorcycle_pedicab" id="motorcycle_pedicab_no" value="no">
            <label class="form-check-label align-middle" for="motorcycle_pedicab">No</label>
          </div>
        </div>
      </div>
      <div class="col d-flex align-items-center justify-content-between justify-content-sm-start">
        <label for="four_wheels" class="form-label m-0 pe-1">2.) Car, Van, Pick-up or Truck:</label>
        <div class="border form-control-sm d-flex align-items-center justify-content-center gap-2">
          <div class="form-check  mb-0">
            <input class="form-check-input" type="radio" name="four_wheels" id="four_wheels_yes" value="yes">
            <label class="form-check-label align-middle" for="four_wheels">Yes</label>
          </div>
          <div class="form-check  mb-0">
            <input class="form-check-input" type="radio" name="four_wheels" id="four_wheels_no" value="no">
            <label class="form-check-label align-middle" for="four_wheels">No</label>
          </div>
        </div>
      </div>
      <div class="col d-flex align-items-center justify-content-between justify-content-sm-start">
        <label for="land_farm" class="form-label m-0 pe-1">3.) Land or Farm:</label>
        <div class="border form-control-sm d-flex align-items-center justify-content-center gap-2">
          <div class="form-check  mb-0">
            <input class="form-check-input" type="radio" name="land_farm" id="land_farm_yes" value="yes">
            <label class="form-check-label align-middle" for="land_farm">Yes</label>
          </div>
          <div class="form-check  mb-0">
            <input class="form-check-input" type="radio" name="land_farm" id="land_farm_no" value="no">
            <label class="form-check-label align-middle" for="land_farm">No</label>
          </div>
        </div>
      </div>
    </div>

    <!-- other family information -->
    <label for="homedetails" class="form-label px-3 mt-3">Home details:</label>
    <div class="row row-cols-1 row-cols-lg-2 g-2 g-lg-4 px-3 small align-items-center">
      <div class="col row g-2 g-lg-4 align-items-center">
        <div class="col-auto my-0">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="land_farm" id="land_farm_yes" value="yes">
            <label class="form-check-label align-middle" for="land_farm">Owned</label>
          </div>
        </div>
        <div class="col-auto my-0">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="land_farm" id="land_farm_yes" value="yes">
            <label class="form-check-label align-middle" for="land_farm">Rented</label>
          </div>
        </div>
        <div class="col-auto my-0">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="land_farm" id="land_farm_yes" value="yes">
            <label class="form-check-label align-middle" for="land_farm">Company Provided/Living with Relatives</label>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="input-group input-group-sm d-flex align-items-center">
          <span class="input-group-text">Number of Bedroom:</span>
          <input class="form-control" type="number" name="bedroom_num" min="0" max="50" id="bedroom_num" placeholder="0">
        </div>
      </div>
    </div>

    <!-- support for cost of schooling -->
    <label for="familybg" class="h6 text-center bg-light w-100 mt-4 text-decoration-underline">Support for Cost of Schooling</label>
    <!-- table -->
    <div class="p-3">
      <div class="table-responsive w-100 p-0">
        <table class="table table-borderless table-light border table-striped mt-2 mb-0">
          <thead>
            <tr class="text-center">
              <th></th>
              <th>Last Name</th>
              <th>First Name</th>
              <th>Source of Income</th>
              <th>Gross Monthly Income</th>
            </tr>
          </thead>
          <tbody id="tierTable" class="align-middle">
            <?php for ($i=0; $i < 4; $i++) : ?>
            <tr>
              <?php 
                switch ($i) {
                  case 0:
                    echo '<td>Father</td>';
                    echo '<td>Tamad</td>';
                    echo '<td>Juan</td>';
                    break;
                  case 1:
                    echo '<td>Mother</td>';
                    echo '<td>Tamad</td>';
                    echo '<td>Juan</td>';
                    break;
                  case 2:
                    echo '<td>Guardian</td>';
                    echo '<td>Tamad</td>';
                    echo '<td>Juan</td>';
                    break;
                  case 3:
                    echo '<td>Person Helping Send the Child to School(If applicable)</td>';
                    echo '<td><input type="text" name="other_person_fname" class="form-control form-control-sm" placeholder="Last Name here..."></td>';
                    echo '<td><input type="text" name="other_person_lname" class="form-control form-control-sm" placeholder="First Name here..."></td>';
                    break;
                  
                  default:
                    # code...
                    break;
                }
              ?>
              <td>
                <select name="source_income" id="source_income" class="form-select form-select-sm">
                  <option value="" disabled selected>Select Source of Income</option>
                  <option value="locally employed">Locally Employed</option>
                  <option value="employed abroad">Employed Abroad</option>
                  <option value="self-employed-professional">Self-employed-Professional</option>
                  <option value="self-employed-business">Self-employed-Business</option>
                  <option value="retired/unemployed">Retired/Unemployed</option>
                  <option value="locally employed">Locally Employed</option>
                  <option value="others">Others</option>
                </select>
                <input type="text" name="source_income" class="form-control d-none">
              </td>
              <td>
                <select name="source_income" id="source_income" class="form-select form-select-sm">
                  <option value="" disabled selected>Select Source of Income</option>
                  <?php $from = 0;?>
                  <?php for ($j=0; $j < 7; $j++) : ?>
                    <?php 
                      $to = ($j === 5) ? 50000 : $from + 5000;
                      $text_start = $from + 1;
                      $value = ($i !== 6) ? $text_start." - ".$to : "More than 50000";
                    ?>
                    <option value="<?= $value?>"> &#8369; <?= $value?></option>
                    <?php $from = $to; ?>
                  <?php endfor?>
                </select>
                <input type="text" class="form-control d-none">
              </td>
            </tr>
            <?php endfor?>
          </tbody>                    
        </table>
      </div>
    </div>
    <div class="text-danger fst-italic px-3">*For employees, it refers to the gross monthly salaries and wages before taxes and other deductions. It includes basic pay, overtime pay, commissions, tips, allowances, and one-twelfth of annual bonuses. For all others, it refers to the average monthly earnings from their business, trade, profession, investments and/or pensions.</div>

    <!-- about my elementary school -->
    <label for="address" class="h6 text-center bg-light w-100 mt-4 text-decoration-underline">About my Elementary School</label>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 px-3 g-2 g-lg-4"> 
      <div class="col">
        <label for="elem_school" class="form-label">Name of Elementary School</label>
        <input type="text" id="elem_school" name="elem_school" class="form-control form-control-sm " placeholder="Name of Elementary School here...">
      </div>

      <div class="col">
        <label for="barangay" class="form-label">School Type</label>
        <div class="form-control form-control-sm d-flex gap-2 py-0 justify-content-center align-items-center">
          <div class="form-check mb-0">
            <input class="form-check-input" type="radio" name="school_type" id="school_type" value="public">
            <label class="form-check-label align-middle" for="school_type">Public</label>
          </div>
          <div class="form-check mb-0">
            <input class="form-check-input" type="radio" name="school_type" id="school_type" value="private">
            <label class="form-check-label align-middle" for="school_type">Private</label>
          </div>
        </div>
      </div>

      <div class="col">
        <label for="mun_city" class="form-label">Province</label>
        <input type="text" id="mun_city" name="mun_city" class="form-control form-control-sm" placeholder="Municipality/City here...">
      </div>

      <div class="col">
        <label for="province" class="form-label">City/Municipality</label>
        <input type="text" id="province" name="province" class="form-control form-control-sm " placeholder="Province here...">
      </div>
      
      <div class="col">
        <label for="barangay" class="form-label">Barangay/District</label>
        <input type="text" id="barangay" name="barangay" class="form-control form-control-sm" placeholder="Barangay/District here...">
      </div>
    </div>
    <div class="fst-italic text-danger p-3">If the Elementary School is Private, please indicate the school fees charged by the Elementary School.</div>
    <div class="px-3">
      <div class="table-responsive mb-3 p-0 w-100">
        <table class="table table-striped table-borderless mb-0">
          <thead>
            <tr>
              <th>Level</th>
              <th>Tuition</th>
              <th>Other</th>
              <th>Miscellaneous</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Grade 6</td>
              <td><input type="number" placeholder="Tuition fee here..." id="tuition" class="form-control form-control-sm"></td>
              <td><input type="number" placeholder="Other fee here..." id="other" class="form-control form-control-sm"></td>
              <td><input type="number" placeholder="Miscellaneous fee here..." id="misc" class="form-control form-control-sm"></td>
            </tr>
          </tbody>
        </table>
      </div>
      <p>
        I certify that my answers are true and correct to the best of my knowledge. 
      </p>
      <p>
        I am aware that the information supplied in this form will be retained by PEAC on a database and will be processed in compliance with the Data Protection Act of 2012.
      </p>
      <p>
        I consent that the Information herein may be used for reports both internally and to the Department of Education.
      </p>
    </div>
    <div class="row">
			<div class="col-md-12">
		 		<canvas id="sig-canvas" width="620" height="160">
		 			Get a better browser, bro.
		 		</canvas>
		 	</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<button class="btn btn-primary" id="sig-submitBtn">Submit Signature</button>
				<button class="btn btn-default" id="sig-clearBtn">Clear Signature</button>
			</div>
		</div>
    <input type="hidden" name="signature_student" id="sig-dataUrl">
  </div>
</main>

<script src="<?= site_url()?>js/addrow_esc.js"></script>
<script src="<?= site_url()?>js/signature_draw.js"></script>
<!-- setup add row functionality -->
<script>
  setAddRow('tierTable', 'addTierBtn');
</script>

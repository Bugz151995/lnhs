<main class="p-4">
  <!-- breadcrumb -->
  <div class="d-flex justify-content-between border-bottom mb-5">
    <h4>ESC Application</h4>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= site_url()?>r/dashboard">Home</a></li>
        <li class="breadcrumb-item">ESC Voucher Management</li>
        <li class="breadcrumb-item active" aria-current="page">ESC Application</li>
      </ol>
    </nav>
  </div>

  <section class="mb-5">
    <div class="bg-white my-4 pb-3 border">
      <!-- form label -->
      <div class="text-center bg-primary text-light py-3">
        <h5>Education Service Contracting</h5>
        <div>Application Form</div>
        <div>ESC Form 1</div>
      </div>

      <!-- Personal Information -->
      <div class="bg-light text-center h6 mt-3 text-decoration-underline">About Me</div>
      <div class="row">
        <div class="col-lg-3 text-center align-self-center justify-self-center">
          <img src="<?= ($application['user_img'] != null) ? $application['user_img'] : site_url().'assets/images/user.jpg'?>" alt="hugenerd" style="width: 200px; height: 200px; background-color: rgba(0,0,255,.1);" class="  img-fluid img-thumbnail mx-4 rounded" alt="">
        </div>
        <div class="col-lg-9">
          <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 g-lg-4 g-2 px-3 mb-2">
            <div class="col">
              <label for="firstname" class="form-label">First name</label>
              <input disabled type="text" class="form-control form-control-sm text-primary " name="firstname" id="firstname" placeholder="First Name here..." value="<?= set_value('firstname', esc($application['firstname']))?>">
            </div>
            <div class="col">
              <label for="middlename" class="form-label">Middle name</label>
              <input disabled type="text" id="middlename" name="middlename" class="form-control form-control-sm text-primary " placeholder="Middle Name here..." value="<?= set_value('middlename', esc($application['middlename']))?>"> 
            </div>
            <div class="col">
              <label for="lastname" class="form-label">Last Name</label>
              <input disabled type="text" class="form-control form-control-sm text-primary  " id="lastname" name="lastname" placeholder="Last Name here..." value="<?= set_value('lastname', esc($application['lastname']))?>">
            </div>
            <div class="col">
              <label for="nameextension" class="form-label">Name Extension</label>
              <input disabled type="text" class="form-control form-control-sm text-primary  " id="nameextension" name="nameextension" placeholder="Name Extendsion here..." value="<?= set_value('nameextension', esc($application['suffix']))?>">
            </div>
            <div class="col">
              <label for="sex" class="form-label">Gender</label>
              <div class="form-control form-control-sm text-primary  d-flex align-items-center justify-content-center">
                <div class="form-check form-check-inline mb-0">
                  <input disabled class="form-check-input" type="radio" name="sex" id="male" value="male" <?= (esc($application['sex'] == 'male')) ? set_radio('sex', $application['sex'], TRUE): '' ?>>
                  <label class="form-check-label align-middle" for="male">Male</label>
                </div>
                <div class="form-check form-check-inline mb-0">
                  <input disabled class="form-check-input" type="radio" name="sex" id="female" value="female" <?= (esc($application['sex'] == 'female')) ? set_radio('sex', $application['sex'], TRUE): '' ?>>
                  <label class="form-check-label align-middle" for="female">Female</label>
                </div>
              </div>
            </div>
            <div class="col">
              <label for="nationality" class="form-label">Nationality</label>
              <input disabled class="form-control form-control-sm text-primary " type="text" name="nationality" id="filipino" placeholder="Nationality here..." value="<?= set_value('nationality', esc($application['nationality']))?>">
            </div>
          </div> 
          <div class="row g-2 px-3">
            <div class="col-lg-3">
              <label for="bday" class="form-label">Birth Date</label>
              <input disabled type="date" id="bday" name="bday" class="form-control form-control-sm text-primary " value="<?= set_value('nameextension', esc($application['birthdate']))?>">
            </div>
            <div class="col-lg-9">
              <label for="bday_place" class="form-label">Birth Place</label>
              <input disabled type="text" id="bday_place" name="bday_place" class="form-control form-control-sm text-primary " placeholder="Place of Birth here..." value="<?= set_value('nameextension', esc($application['birthplace']))?>">
            </div>
          </div>
        </div>
      </div>

      <!-- complete address -->
      <label for="address" class="h6 text-center bg-light w-100 mt-4 text-decoration-underline">Address and Contact Details</label>
      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 px-3 g-2 g-lg-4"> 
        <div class="col">
          <label for="street" class="form-label">Street Address</label>
          <input disabled type="text" id="street" name="street" class="form-control form-control-sm text-primary  " placeholder="Street Address here..." value="<?= set_value('street', esc($application['street']))?>">
        </div>

        <div class="col">
          <label for="barangay" class="form-label">Barangay/District</label>
          <input disabled type="text" id="barangay" name="barangay" class="form-control form-control-sm text-primary " placeholder="Barangay/District here..." value="<?= set_value('barangay', esc($application['barangay']))?>">
        </div>

        <div class="col">
          <label for="mun_city" class="form-label">Municipality/City</label>
          <input disabled type="text" id="mun_city" name="mun_city" class="form-control form-control-sm text-primary " placeholder="Municipality/City here..." value="<?= set_value('mun_city', esc($application['city_municipality']))?>">
        </div>

        <div class="col">
          <label for="province" class="form-label">Province</label>
          <input disabled type="text" id="province" name="province" class="form-control form-control-sm text-primary  " placeholder="Province here..." value="<?= set_value('province', esc($application['province']))?>">
        </div>
        
        <div class="col">
          <label for="zip_code" class="form-label">Zip Code</label>
          <input disabled type="text" id="zip_code" name="zip_code" class="form-control form-control-sm text-primary  " placeholder="Zip Code here..." value="<?= set_value('zip_code', esc($application['zip_code']))?>">
        </div>

        <div class="col">
          <label for="contact_number" class="form-label">Mobile/Landline No.</label>
          <input disabled type="number" id="contact_number" name="contact_number" class="form-control form-control-sm text-primary  " placeholder="9XXXXXXXXX" value="<?= set_value('contact_number', esc($application['contact_num']))?>">
        </div>

        <div class="col">
          <label for="email" class="form-label">Email Address</label>
          <input disabled type="email" id="email" name="email" class="form-control form-control-sm text-primary  " placeholder="Email Address here..." value="<?= set_value('email', esc($application['email']))?>">
        </div>
      </div>

      <!-- family background -->
      <label for="familybg" class="h6 text-center bg-light w-100 mt-4 text-decoration-underline">Other Information</label>
      
      <!-- other family information -->
      <label for="otherfamilyinfo" class="form-label px-3">Does your family own any of the following:</label>
      <div class="row row-cols-1 row-cols-sm-1 px-3 g-2 g-lg-4 small">
        <div class="col d-flex align-items-center justify-content-between justify-content-sm-start">
          <label for="motorcycle_pedicab" class="form-label m-0 pe-1">1.) Motorcycle/Pedicab:</label>
          <div class="border form-control-sm text-primary  d-flex align-items-center justify-content-center gap-2">
            <div class="form-check  mb-0">
              <input disabled class="form-check-input" type="radio" name="motorcycle_pedicab" id="motorcycle_pedicab_yes" value="1" <?= (esc($application['is2or3wheelsowned'] == '1')) ? set_radio('motorcycle_pedicab', $application['is2or3wheelsowned'], TRUE): '' ?>>
              <label class="form-check-label align-middle" for="motorcycle_pedicab">Yes</label>
            </div>
            <div class="form-check  mb-0">
              <input disabled class="form-check-input" type="radio" name="motorcycle_pedicab" id="motorcycle_pedicab_no" value="0" <?= (esc($application['is2or3wheelsowned'] == '0')) ? set_radio('motorcycle_pedicab', $application['is2or3wheelsowned'], TRUE): '' ?>>
              <label class="form-check-label align-middle" for="motorcycle_pedicab">No</label>
            </div>
          </div>
        </div>
        <div class="col d-flex align-items-center justify-content-between justify-content-sm-start">
          <label for="four_wheels" class="form-label m-0 pe-1">2.) Car, Van, Pick-up or Truck:</label>
          <div class="border form-control-sm text-primary  d-flex align-items-center justify-content-center gap-2">
            <div class="form-check  mb-0">
              <input disabled class="form-check-input" type="radio" name="four_wheels" id="four_wheels_yes" value="1" <?= (esc($application['is4wheelsowned'] == '1')) ? set_radio('four_wheels', $application['is4wheelsowned'], TRUE): '' ?>>
              <label class="form-check-label align-middle" for="four_wheels">Yes</label>
            </div>
            <div class="form-check  mb-0">
              <input disabled class="form-check-input" type="radio" name="four_wheels" id="four_wheels_no" value="0" <?= (esc($application['is4wheelsowned'] == '0')) ? set_radio('four_wheels', $application['is4wheelsowned'], TRUE): '' ?>>
              <label class="form-check-label align-middle" for="four_wheels">No</label>
            </div>
          </div>
        </div>
        <div class="col d-flex align-items-center justify-content-between justify-content-sm-start">
          <label for="land_farm" class="form-label m-0 pe-1">3.) Land or Farm:</label>
          <div class="border form-control-sm text-primary  d-flex align-items-center justify-content-center gap-2">
            <div class="form-check  mb-0">
              <input disabled class="form-check-input" type="radio" name="land_farm" id="land_farm_yes" value="1" <?= (esc($application['islandorfarmowned'] == '1')) ? set_radio('land_farm', $application['islandorfarmowned'], TRUE): '' ?>>
              <label class="form-check-label align-middle" for="land_farm">Yes</label>
            </div>
            <div class="form-check  mb-0">
              <input disabled class="form-check-input" type="radio" name="land_farm" id="land_farm_no" value="0" <?= (esc($application['islandorfarmowned'] == '0')) ? set_radio('land_farm', $application['islandorfarmowned'], TRUE): '' ?>>
              <label class="form-check-label align-middle" for="land_farm">No</label>
            </div>
          </div>
        </div>
      </div>

      <!-- other family information -->
      <label for="homedetails" class="form-label px-3 mt-3">Home details:</label>
      <div class="row g-2 g-lg-4 px-3 small align-items-center text-primary">
        <div class="col-md-7 row g-2 g-lg-4 align-items-center">
          <div class="col-auto my-0">
            <div class="form-check">
              <input disabled class="form-check-input" type="radio" name="home_details" id="Owned" value="Owned" <?= (esc($application['home_details'] == 'Owned')) ? set_radio('home_details', $application['home_details'], TRUE): '' ?>>
              <label class="form-check-label align-middle" for="Owned">Owned</label>
            </div>
          </div>
          <div class="col-auto my-0">
            <div class="form-check">
              <input disabled class="form-check-input" type="radio" name="home_details" id="Rented" value="Rented" <?= (esc($application['home_details'] == 'Rented')) ? set_radio('home_details', $application['home_details'], TRUE): '' ?>>
              <label class="form-check-label align-middle" for="Rented">Rented</label>
            </div>
          </div>
          <div class="col-auto my-0">
            <div class="form-check">
              <input disabled class="form-check-input" type="radio" name="home_details" id="Comp" value="Company Provided/Living with Relatives" <?= (esc($application['home_details'] == 'Company Provided/Living with Relatives')) ? set_radio('home_details', $application['home_details'], TRUE): '' ?>>
              <label class="form-check-label align-middle" for="Comp">Company Provided/Living with Relatives</label>
            </div>
          </div>
        </div>
        <div class="col-md-5">
          <div class="input-group input-group-sm d-flex align-items-center">
            <span class="input-group-text">Number of Bedroom:</span>
            <input disabled class="form-control text-primary" type="number" name="bedroom_num" min="0" max="50" id="bedroom_num" placeholder="0" value="<?= set_value('bedroom_num', esc($application['beds']))?>">
          </div>
        </div>
      </div>

      <!-- support for cost of schooling -->
      <label for="familybg" class="h6 text-center bg-light w-100 mt-4 text-decoration-underline">Support for Cost of Schooling</label>
      <!-- table -->
      <div class="p-3">
        <?php foreach($relatives as $key => $relative): ?>
          <?= form_hidden('p['.$key.']', $relative['person_id']) ?>
          <div class="row g-3 mb-4">
            <div class="col">
              <label for="person" class="form-label"></label>
              <div id="person" class="h6 mb-0 text-decoration-underline">
                <span class="text-capitalize"><?= '('.$relative['relationship'].') ' ?></span> 
                <?= $relative['firstname'].' '.substr($relative['middlename'], 0, 1).'. '.$relative['lastname'] ?>
              </div>
            </div>

            <div class="col">
              <label for="income_src" class="form-label"><span class="text-danger">*</span> Source of Income</label>
              <select disabled name="income_src[<?= $key?>]" id="<?= $relative['relationship']?>" class="form-select disabled form-select-sm text-primary ">
                <option value="" disabled selected>Select Source of Income</option>
                <option <?= ($relative['income_source'] == 'Locally Employed') ? set_select('income_src['.$key.']', $relative['income_source'], TRUE): '' ?> value="Locally Employed">Locally Employed</option>
                <option <?= ($relative['income_source'] == 'Employed Abroad') ? set_select('income_src['.$key.']', $relative['income_source'], TRUE): '' ?> value="Employed Abroad">Employed Abroad</option>
                <option <?= ($relative['income_source'] == 'Self-employed Professional') ? set_select('income_src['.$key.']', $relative['income_source'], TRUE): '' ?> value="Self-employed Professional">Self-employed Professional</option>
                <option <?= ($relative['income_source'] == 'Self-employed Business') ? set_select('income_src['.$key.']', $relative['income_source'], TRUE): '' ?> value="Self-employed Business">Self-employed Business</option>
                <option <?= ($relative['income_source'] == 'Retired/Unemployed') ? set_select('income_src['.$key.']', $relative['income_source'], TRUE): '' ?> value="Retired/Unemployed">Retired/Unemployed</option>
                <option <?= ($relative['income_source'] == 'Locally Employed') ? set_select('income_src['.$key.']', $relative['income_source'], TRUE): '' ?> value="Locally Employed">Locally Employed</option>
                <option <?= ($relative['income_source'] == 'Others') ? set_select('income_src['.$key.']', $relative['income_source'], TRUE): '' ?> value="Others">Others</option>
              </select>
              <?php if(isset($validation) && $validation->getError('income_src['.$key.']')): ?>
                <div class="fst-italic text-danger"><i class="fas fa-exclamation-triangle me-1"></i> <?= $validation->getError('income_src['.$key.']') ?></div>
              <?php endif ?>
            </div>

            <div class="col">
              <label for="gross_income" class="form-label"><span class="text-danger">*</span> Gross Monthly Income</label>
              <select disabled name="gross_income[<?= $key?>]" id="<?= $relative['relationship']?>" class="form-select disabled form-select-sm text-primary ">
                <option value="" disabled selected>Select Gross Monthly Income</option>
                <?php $from = 0;?>
                <?php for ($j=0; $j < 7; $j++) : ?>
                  <?php 
                    $to = ($j === 5) ? 50000 : $from + 5000;
                    $text_start = $from + 1;
                    $value = ($j !== 6) ? $text_start." - ".$to : "More than 50000";
                  ?>

                  <option <?= ($relative['gross_income'] == $value) ? set_select('gross_income['.$key.']', $value, TRUE) : '' ?> value="<?= $value?>"> &#8369; <?= $value?></option>
                  <?php $from = $to; ?>
                <?php endfor?>
              </select>
              <?php if(isset($validation) && $validation->getError('income_src['.$key.']')): ?>
                <div class="fst-italic text-danger"><i class="fas fa-exclamation-triangle me-1"></i> <?= $validation->getError('income_src['.$key.']') ?></div>
              <?php endif ?>
            </div>
          </div>
        <?php endforeach?>
      </div>
      <div class="text-danger fst-italic px-3">*For employees, it refers to the gross monthly salaries and wages before taxes and other deductions. It includes basic pay, overtime pay, commissions, tips, allowances, and one-twelfth of annual bonuses. For all others, it refers to the average monthly earnings from their business, trade, profession, investments and/or pensions.</div>

      <!-- about my elementary school -->
      <label for="address" class="h6 text-center bg-light w-100 mt-4 text-decoration-underline">About my Elementary School</label>
      <div class="row row-cols-1 row-cols-lg-2 px-3 g-2 g-lg-4 mb-3"> 
        <div class="col">
          <label for="elem_school" class="form-label">Name of Elementary School</label>
          <input disabled type="text" id="elem_school" name="elem_school" class="form-control form-control-sm text-primary  " placeholder="Name of Elementary School here..." value="<?= set_value('elem_school', esc($application['school_name']))?>">
        </div>

        <div class="col">
          <label for="barangay" class="form-label">School Type</label>
          <div class="form-control form-control-sm text-primary  d-flex gap-2 py-0 justify-content-center align-items-center">
            <div class="form-check mb-0">
              <input disabled class="form-check-input" type="radio" name="school_type" id="school_type" value="public" <?= (esc($application['school_type'] == 'public')) ? set_radio('school_type', $application['school_type'], TRUE): '' ?>>
              <label class="form-check-label align-middle" for="school_type">Public</label>
            </div>
            <div class="form-check mb-0">
              <input disabled class="form-check-input" type="radio" name="school_type" id="school_type" value="private" <?= (esc($application['school_type'] == 'private')) ? set_radio('school_type', $application['school_type'], TRUE): '' ?>>
              <label class="form-check-label align-middle" for="school_type">Private</label>
            </div>
          </div>
        </div>
      </div>
      <div class="row px-3">
        <div class="col">
          <label for="school_address" class="form-label">School Address</label>
          <input disabled type="text" id="school_address" name="school_address" class="form-control form-control-sm text-primary " placeholder="School Address here..." value="<?= set_value('school_address', esc($application['school_address']))?>">
        </div>
      </div>
      <div class="fst-italic text-danger p-3">If the Elementary School is Private, please indicate the school fees charged by the Elementary School.</div>
      <div class="px-3">
        <div class="table-responsive mb-3 p-0 w-100">
          <table class="table table-striped table-borderless mb-0 align-middle">
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
                <td>
                  <input disabled type="number" placeholder="Tuition fee here..." id="tuition" class="form-control form-control-sm text-primary " value="<?= set_value('tuition', esc($application['tuition']))?>">
                </td>
                <td>
                  <input disabled type="number" placeholder="Other fee here..." id="other" class="form-control form-control-sm text-primary " value="<?= set_value('other', esc($application['other_fee']))?>">
                </td>
                <td>
                  <input disabled type="number" placeholder="Miscellaneous fee here..." id="misc" class="form-control form-control-sm text-primary " value="<?= set_value('misc', esc($application['misc_fee']))?>">
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <hr>
      <div class="row g-3 justify-content-between px-3 align-items-center">
        <div class="col">
          <a href="<?= site_url()?>r/esc_request" class="btn btn-secondary"><i class="fas fa-arrow-left fa-fw me-1"></i>Back</a>
        </div>
        <div class="col">
          <div class="row g-3 justify-content-end">
            <div class="col-auto">
              <?= form_open('r/esc_request/approve') ?>
                <?= csrf_field() ?>
                <?= form_hidden('e', esc($application['esc_application_id'])) ?>
                <button type="submit" class="btn btn-primary"><i class="fas fa-check-circle fa-fw me-1"></i>Approve</button>
              <?= form_close() ?>
            </div>
            <div class="col-auto">
              <?= form_open('r/esc_request/deny') ?>
                <?= csrf_field() ?>
                <?= form_hidden('e', esc($application['esc_application_id'])) ?>
                <button type="submit" class="btn btn-danger"><i class="fas fa-times-circle fa-fw me-1"></i>Deny</button>
              <?= form_close() ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
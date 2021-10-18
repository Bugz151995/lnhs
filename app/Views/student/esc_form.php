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

  <!-- enrolment form -->
  <?= form_open('esc/register')?>
    <?= csrf_field() ?>
    <?= form_hidden('s', esc($student["student_id"])) ?>
    <!-- trigger -->
    <a class="btn btn-sm btn-primary d-none" id="escBtn" data-bs-toggle="modal" href="#page" role="button"></a>

    <!-- INSTRUCTIONS -->
    <div class="modal fade" id="page" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" aria-hidden="true" aria-labelledby="pageLabel" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header bg-primary text-light">
            <h5 class="modal-title" id="pageLabel"><i class="fas fa-list fa-fw me-1"></i>ESC Registration Form</h5>
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
    <!-- other family info -->
    <div class="modal fade" id="page0" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" aria-hidden="true" aria-labelledby="page0Label" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header bg-primary text-light">
            <h5 class="modal-title" id="page0Label"><i class="fas fa-list fa-fw me-1"></i>ESC Registration Form</h5>
          </div>
          <div class="modal-body">
            <div class="progress mb-3">
              <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
            </div>
            <!-- field -->            
            <label for="otherfamilyinfo" class="form-label">Does your family own any of the following:</label>
            <div class="row row-cols-1 row-cols-sm-1 g-3 small">
              <div class="col d-flex align-items-center justify-content-between justify-content-sm-start">
                <label for="motorcycle_pedicab" class="form-label m-0 pe-1 me-2"><span class="text-danger">*</span> 1.) Motorcycle/Pedicab:</label>
                <div class="border form-control-sm d-flex align-items-center justify-content-center gap-2">
                  <div class="form-check  mb-0">
                    <input class="form-check-input" <?= set_radio('motorcycle_pedicab', '0') ?> type="radio" name="motorcycle_pedicab" id="motorcycle_pedicab_yes" value="1">
                    <label class="form-check-label align-middle" for="motorcycle_pedicab_yes">Yes</label>
                  </div>
                  <div class="form-check mb-0">
                    <input class="form-check-input" <?= set_radio('motorcycle_pedicab', '1') ?> type="radio" name="motorcycle_pedicab" id="motorcycle_pedicab_no" value="0">
                    <label class="form-check-label align-middle" for="motorcycle_pedicab_no">No</label>
                  </div>
                </div>
              </div>
              <?php if(isset($validation) && $validation->getError('motorcycle_pedicab')): ?>
                <div class="fst-italic text-danger"><i class="fas fa-exclamation-triangle me-1"></i> <?= $validation->getError('motorcycle_pedicab') ?></div>
              <?php endif ?>

              <div class="col d-flex align-items-center justify-content-between justify-content-sm-start">
                <label for="four_wheels" class="form-label m-0 pe-1 me-2"><span class="text-danger">*</span> 2.) Car, Van, Pick-up or Truck:</label>
                <div class="border form-control-sm d-flex align-items-center justify-content-center gap-2">
                  <div class="form-check  mb-0">
                    <input class="form-check-input" <?= set_radio('four_wheels', '1') ?> type="radio" name="four_wheels" id="four_wheels_yes" value="1">
                    <label class="form-check-label align-middle" for="four_wheels_yes">Yes</label>
                  </div>
                  <div class="form-check  mb-0">
                    <input class="form-check-input" <?= set_radio('four_wheels', '0') ?> type="radio" name="four_wheels" id="four_wheels_no" value="0">
                    <label class="form-check-label align-middle" for="four_wheels_no">No</label>
                  </div>
                </div>
              </div>
              <?php if(isset($validation) && $validation->getError('four_wheels')): ?>
                <div class="fst-italic text-danger"><i class="fas fa-exclamation-triangle me-1"></i> <?= $validation->getError('four_wheels') ?></div>
              <?php endif ?>

              <div class="col d-flex align-items-center justify-content-between justify-content-sm-start">
                <label for="land_farm" class="form-label m-0 pe-1 me-2"><span class="text-danger">*</span> 3.) Land or Farm:</label>
                <div class="border form-control-sm d-flex align-items-center justify-content-center gap-2">
                  <div class="form-check  mb-0">
                    <input class="form-check-input" <?= set_radio('land_farm', '1') ?> type="radio" name="land_farm" id="land_farm_yes" value="1">
                    <label class="form-check-label align-middle" for="land_farm_yes">Yes</label>
                  </div>
                  <div class="form-check  mb-0">
                    <input class="form-check-input" <?= set_radio('land_farm', '0') ?> type="radio" name="land_farm" id="land_farm_no" value="0">
                    <label class="form-check-label align-middle" for="land_farm_no">No</label>
                  </div>
                </div>
              </div>
              <?php if(isset($validation) && $validation->getError('land_farm')): ?>
                <div class="fst-italic text-danger"><i class="fas fa-exclamation-triangle me-1"></i> <?= $validation->getError('land_farm') ?></div>
              <?php endif ?>
            </div>

            <!-- other family information -->
            <label for="homedetails" class="form-label mt-3"><span class="text-danger">*</span> Home details:</label>
            <div class="row row-cols-1 row-cols-lg-2 g-3 align-items-center">
              <div class="col row g-3 align-items-center small">
                <div class="col-auto my-0">
                  <div class="form-check">
                    <input class="form-check-input" <?= set_radio('home_detail', 'Owned') ?> type="radio" name="home_detail" id="home_detail_owned" value="Owned">
                    <label class="form-check-label align-middle" for="home_detail_owned">Owned</label>
                  </div>
                </div>
                <div class="col-auto my-0">
                  <div class="form-check">
                    <input class="form-check-input" <?= set_radio('home_detail', 'Rented') ?> type="radio" name="home_detail" id="home_detail_rented" value="Rented">
                    <label class="form-check-label align-middle" for="home_detail_rented">Rented</label>
                  </div>
                </div>
                <div class="col-auto my-0">
                  <div class="form-check">
                    <input class="form-check-input" <?= set_radio('home_detail', 'Company Provided/Living with Relatives') ?> type="radio" name="home_detail" id="home_detail_comp" value="Company Provided/Living with Relatives">
                    <label class="form-check-label align-middle" for="home_detail_comp">Company Provided/Living with Relatives</label>
                  </div>
                </div>
              </div>
              <?php if(isset($validation) && $validation->getError('home_detail')): ?>
                <div class="fst-italic text-danger"><i class="fas fa-exclamation-triangle me-1"></i> <?= $validation->getError('home_detail') ?></div>
              <?php endif ?>

              <div class="col">
                <label for="beds" class="form-label"><span class="text-danger">*</span> Number of Bedroom:</label>
                <input class="form-control form-control-sm" type="number" name="beds" min="0" max="50" id="beds" value="<?=  set_value('beds')?>"" placeholder="0">
              </div>
              <?php if(isset($validation) && $validation->getError('beds')): ?>
                <div class="fst-italic text-danger"><i class="fas fa-exclamation-triangle me-1"></i> <?= $validation->getError('beds') ?></div>
              <?php endif ?>
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
    <!-- support for schooling -->
    <div class="modal fade" id="page1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" aria-labelledby="page1Label" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header bg-primary text-light">
            <h5 class="modal-title" id="page1Label"><i class="fas fa-list fa-fw me-1"></i>ESC Registration Form</h5>
          </div>
          <div class="modal-body">
            <div class="progress mb-3">
              <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
            </div>
            <!-- support for cost of schooling -->
            <label for="familybg" class="h6 text-center bg-light w-100 mt-4 text-decoration-underline">Support for Cost of Schooling</label>
            <div class="text-danger fst-italic mb-3">*For employees, it refers to the gross monthly salaries and wages before taxes and other deductions. It includes basic pay, overtime pay, commissions, tips, allowances, and one-twelfth of annual bonuses. For all others, it refers to the average monthly earnings from their business, trade, profession, investments and/or pensions.</div>

            <div class="row row-cols-1 row-cols-lg-3 g-3">
              <?php foreach($relatives as $key => $relative): ?>
              <?= form_hidden('p['.$key.']', $relative->person_id) ?>
              <div class="col">
                <label for="person" class="form-label"></label>
                <div id="person" class="h6 mb-0 text-decoration-underline">
                  <span class="text-capitalize"><?= '('.$relative->relationship.') ' ?></span> 
                  <?= $relative->firstname.' '.substr($relative->middlename, 0, 1).'. '.$relative->lastname ?>
                </div>
              </div>

              <div class="col">
                <label for="income_src" class="form-label"><span class="text-danger">*</span> Source of Income</label>
                <select name="income_src[<?= $key?>]" id="<?= $relative->relationship?>" class="form-select form-select-sm">
                  <option value="" disabled selected>Select Source of Income</option>
                  <option <?= set_select('income_src['.$key.']', 'Locally Employed') ?> value="Locally Employed">Locally Employed</option>
                  <option <?= set_select('income_src['.$key.']', 'Employed Abroad') ?> value="Employed Abroad">Employed Abroad</option>
                  <option <?= set_select('income_src['.$key.']', 'Self-employed Professional') ?> value="Self-employed Professional">Self-employed Professional</option>
                  <option <?= set_select('income_src['.$key.']', 'Self-employed Business') ?> value="Self-employed Business">Self-employed Business</option>
                  <option <?= set_select('income_src['.$key.']', 'Retired/Unemployed') ?> value="Retired/Unemployed">Retired/Unemployed</option>
                  <option <?= set_select('income_src['.$key.']', 'Locally Employed') ?> value="Locally Employed">Locally Employed</option>
                  <option <?= set_select('income_src['.$key.']', 'Others') ?> value="Others">Others</option>
                </select>
                <?php if(isset($validation) && $validation->getError('income_src['.$key.']')): ?>
                  <div class="fst-italic text-danger"><i class="fas fa-exclamation-triangle me-1"></i> <?= $validation->getError('income_src['.$key.']') ?></div>
                <?php endif ?>
              </div>

              <div class="col">
                <label for="gross_income" class="form-label"><span class="text-danger">*</span> Gross Monthly Income</label>
                <select name="gross_income[<?= $key?>]" id="<?= $relative->relationship?>" class="form-select form-select-sm">
                  <option value="" disabled selected>Select Gross Monthly Income</option>
                  <?php $from = 0;?>
                  <?php for ($j=0; $j < 7; $j++) : ?>
                    <?php 
                      $to = ($j === 5) ? 50000 : $from + 5000;
                      $text_start = $from + 1;
                      $value = ($j !== 6) ? $text_start." - ".$to : "More than 50000";
                    ?>

                    <option <?= set_select('gross_income['.$key.']', $value) ?> value="<?= $value?>"> &#8369; <?= $value?></option>
                    <?php $from = $to; ?>
                  <?php endfor?>
                </select>
                <?php if(isset($validation) && $validation->getError('income_src['.$key.']')): ?>
                  <div class="fst-italic text-danger"><i class="fas fa-exclamation-triangle me-1"></i> <?= $validation->getError('income_src['.$key.']') ?></div>
                <?php endif ?>
              </div>
              <?php endforeach?>
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
      <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header bg-primary text-light">
            <h5 class="modal-title" id="page2Label"><i class="fas fa-list fa-fw me-1"></i>ESC Registration Form</h5>
          </div>
          <div class="modal-body">
            <div class="progress">
              <div class="progress-bar" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
            </div>
            <!-- about my elementary school -->
            <label for="address" class="h6 text-center bg-light w-100 mt-4 text-decoration-underline">About my Elementary School (Grade 6)</label>
            <div class="row row-cols-1 row-cols-lg-3 g-3"> 
              <div class="col">
                <label for="school_name" class="form-label"><span class="text-danger">*</span> Name of Elementary School</label>
                <input type="text" id="school_name" value="<?= set_value('school_name')?>" name="school_name" class="form-control form-control-sm " placeholder="Name of Elementary School here...">
                <?php if(isset($validation) && $validation->getError('school_name')): ?>
                  <div class="fst-italic text-danger"><i class="fas fa-exclamation-triangle me-1"></i> <?= $validation->getError('school_name') ?></div>
                <?php endif ?>
              </div>

              <div class="col">
                <label for="" class="form-label"><span class="text-danger">*</span> School Type</label>
                <div class="form-control form-control-sm d-flex gap-2 py-0 justify-content-center align-items-center">
                  <div class="form-check mb-0">
                    <input class="form-check-input" <?= set_radio('school_type', 'public') ?> type="radio" name="school_type" id="school_type_pu" value="public">
                    <label class="form-check-label align-middle" for="school_type_pu">Public</label>
                  </div>
                  <div class="form-check mb-0">
                    <input class="form-check-input" <?= set_radio('school_type', 'private') ?> type="radio" name="school_type" id="school_type_pr" value="private">
                    <label class="form-check-label align-middle" for="school_type_pr">Private</label>
                  </div>
                </div>
                <?php if(isset($validation) && $validation->getError('school_type')): ?>
                  <div class="fst-italic text-danger"><i class="fas fa-exclamation-triangle me-1"></i> <?= $validation->getError('school_type') ?></div>
                <?php endif ?>
              </div>

              <div class="col">
                <label for="address" class="form-label"><span class="text-danger">*</span> School Address</label>
                <input type="text" id="address" value="<?= set_value('school_address')?>" name="school_address" class="form-control form-control-sm" placeholder="School Address here...">
                <?php if(isset($validation) && $validation->getError('school_address')): ?>
                  <div class="fst-italic text-danger"><i class="fas fa-exclamation-triangle me-1"></i> <?= $validation->getError('school_address') ?></div>
                <?php endif ?>
              </div>
            </div>
            <div class="fst-italic text-danger p-3">If the Elementary School is Private, please indicate the school fees charged by the Elementary School.</div>
            <div class="row row-cols-1 row-cols-lg-3 g-3">
              <div class="col">
                <label for="tuition" class="form-label">Tuition Fee</label>
                <div class="input-group input-group-sm">
                  <div class="input-group-text">&#8369;</div>
                  <input type="number" placeholder="Tuition fee here..." id="tuition" name="tuition" disabled class="form-control form-control-sm">
                </div>                
              </div>
              <div class="col">
                <label for="other" class="form-label">Other Fee</label>
                <div class="input-group input-group-sm">
                  <div class="input-group-text">&#8369;</div>
                  <input type="number" placeholder="Other fee here..." id="other" name="other" disabled class="form-control form-control-sm">
                </div>          
              </div>
              <div class="col">
                <label for="misc" class="form-label">Miscellaneous Fee</label>
                <div class="input-group input-group-sm">
                  <div class="input-group-text">&#8369;</div>
                  <input type="number" placeholder="Miscellaneous fee here..." id="misc" name="misc" disabled class="form-control form-control-sm">
                </div>          
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
      <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header bg-primary text-light">
            <h5 class="modal-title" id="page3Label"><i class="fas fa-list fa-fw me-1"></i>ESC Registration Form</h5>
          </div>
          <div class="modal-body">
            <div class="progress mb-3">
              <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div>
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
          <div class="modal-footer d-flex justify-content-between">
            <a class="btn btn-sm btn-secondary" data-bs-target="#page2" data-bs-toggle="modal" data-bs-dismiss="modal"><i class="fas fa-arrow-left me-1"></i>Prev</a>
            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
          </div>
        </div>
      </div>
    </div>
  <?= form_close()?>
</main>

<script>
  document.addEventListener('DOMContentLoaded', ()=>{
    const trigger = document.getElementById('escBtn');
    trigger.click();

    const tuition = document.getElementById('tuition');
    const other   = document.getElementById('other');
    const misc    = document.getElementById('misc');

    const sc_type_pu = document.getElementById('school_type_pu');
    const sc_type_pr = document.getElementById('school_type_pr');

    sc_type_pu.addEventListener('click', ()=>{
      tuition.setAttribute('disabled', '');
      other.setAttribute('disabled', '');
      misc.setAttribute('disabled', '');
    });

    sc_type_pr.addEventListener('click', ()=>{
      tuition.removeAttribute('disabled', '');
      other.removeAttribute('disabled', '');
      misc.removeAttribute('disabled', '');
    });

    const fname = document.getElementById('other_person_fname');
    const mname = document.getElementById('other_person_mname');
    const lname = document.getElementById('other_person_lname');
    const sc_other = document.getElementById('source_income_3');
    const gi_other = document.getElementById('gross_income_3');

    const is_other_y = document.getElementById('isother_yes');
    const is_other_n = document.getElementById('isother_no');

    is_other_y.addEventListener('click', ()=>{
      fname.removeAttribute('disabled', '');
      mname.removeAttribute('disabled', '');
      lname.removeAttribute('disabled', '');
      sc_other.removeAttribute('disabled', '');
      gi_other.removeAttribute('disabled', '');
    });

    is_other_n.addEventListener('click', ()=>{
      fname.setAttribute('disabled', '');
      mname.setAttribute('disabled', '');
      lname.setAttribute('disabled', '');
      sc_other.setAttribute('disabled', '');
      gi_other.setAttribute('disabled', '');
    });
  });
</script>
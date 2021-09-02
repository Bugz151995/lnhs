<main class="container px-4">
  <div class="bg-white mt-4">
    <?php
      if(isset($validation)) {
        echo $validation->listErrors();
      }
    ?>
    <ul class="nav nav-pills nav-fill">
      <li class="nav-item">
        <?php 
          if(session()->getFlashData('student_id') !== NULL) {
            $page = "r/assessment/".session()->getFlashData('student_id');
          } else {
            $page = "r/enrollments";
            session()->setFlashData('info', 'Session has expired.');
          }
        ?>
        <a class="nav-link" href="<?= site_url().$page?>">Requirements Assessment</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active text-decoration-underline" aria-current="page" href="<?= site_url()?>r/assessment/evaluation">Evaluation</a>
      </li>
    </ul>
    <?= form_open() ?>
    <!-- header -->
      <div class="bg-primary p-3 text-light text-center border-top border-white h5">Student Evaluation</div>
      <div class="p-3">
        <label for="" class="form-label"><span class="text-danger">*</span> Student Name</label>
        <div class="form-group row row-cols-sm-3">
          <div class="col">
            <input type="text" class="form-control form-control-sm" name="firstname" value="<?= (isset($enrollments)) ? $enrollments[0]->firstname : set_value('firstname')?>" id="firstname" placeholder="First Name here...">
          </div>
          <div class="col">
            <input type="text" id="middlename" name="middlename" value="<?= (isset($enrollments)) ? $enrollments[0]->middlename : set_value('middlename')?>" class="form-control form-control-sm" placeholder="Middle Name here..."> 
          </div>
          <div class="col">
            <input type="text" class="form-control form-control-sm " id="lastname" name="lastname" value="<?= (isset($enrollments)) ? $enrollments[0]->lastname : set_value('lastname')?>" placeholder="Last Name here...">
          </div>
        </div>

        <div class="form-group row mt-4">
          <div class="col-sm-9">
            <label for="" class="form-label"><span class="text-danger">*</span> Track and Strands</label>
            <input type="text" class="form-control form-control-sm" name="firstname" value="<?= (isset($enrollments)) ? $enrollments[0]->firstname : set_value('firstname')?>" id="firstname" placeholder="First Name here...">
          </div>
          <div class="col-sm-3">
           <label for="" class="form-label"><span class="text-danger">*</span> Section</label>
            <input type="text" id="middlename" name="middlename" value="<?= (isset($enrollments)) ? $enrollments[0]->middlename : set_value('middlename')?>" class="form-control form-control-sm" placeholder="Middle Name here..."> 
          </div>
        </div>

        <table class="table table-light table-striped table-borderless mt-4 text-center">
          <thead>
            <tr>
              <th>Subject Code</th>
              <th>Begin</th>
              <th>Dismiss</th>
              <th>Day</th>
              <th>Teacher</th>
              <th>Room</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>OCOMM1</td>
              <td>7:30 AM</td>
              <td>8:30 AM</td>
              <td>MWF</td>
              <td>Ms. Doe</td>
              <td>1</td>
            </tr>
          </tbody>
        </table>

        <div class="form-group d-flex justify-content-end">
          <button type="submit" class="btn btn-outline-primary"><i class="far fa-save"></i> Save</button>
        </div>
      </div>
    <?= form_close() ?>
  </div>
</main>

<script src="<?= site_url()?>js/returneeform_toggle.js"></script>
<script src="<?= site_url()?>js/guardianfield_toggle.js"></script>
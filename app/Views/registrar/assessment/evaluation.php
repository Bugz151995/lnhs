<main class="p-4">
  <!-- breadcrumb -->
  <div class="d-flex justify-content-between border-bottom mb-5">
    <h4>Evaluation</h4>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= site_url()?>r/dashboard">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Enrollments</li>
        <li class="breadcrumb-item active" aria-current="page">Evaluation</li>
      </ol>
    </nav>
  </div>

  <div class="bg-white mt-4">
    <?php
      if(isset($validation)) {
        echo $validation->listErrors();
      }
    ?>
    <?= form_open('r/assessment/evaluation/save') ?>
      <?= csrf_field() ?>
      <?= form_hidden('s', esc($student_id)) ?>
      <?= form_hidden('sem', esc($student['semester'])) ?>
      <?= form_hidden('ay', esc($student['acad_year'])) ?>
      <!-- header -->
      <div class="bg-primary text-light text-center border-top border-white h5 p-3 mb-0">Student Evaluation</div>
      <div class="p-4 border">
        <table class="table table-borderless align-middle">
          <tbody>
            <tr>
              <th>Student's Name:</th>
              <td>
                <?= $student['firstname'].' ' ?>
                <?php if($student['middlename']): ?>
                  <?= substr($student['middlename'], 0, 1).'. ' ?>
                <?php endif ?>
                <?= $student['lastname'].' ' ?>
                <?php if($student['suffix']): ?>
                  <?= $student['suffix'] ?>
                <?php endif ?>
              </td>
            </tr>

            <tr>
              <th>Grade Level:</th>
              <td>
                <?= $student['grade_level']?>
              </td>
            </tr>

            <tr>
              <th>Class:</th>
              <td>
                <?= $student['class_name']?>
              </td>
            </tr>

            <tr>
              <th>Course:</th>
              <td>
                <?= $student['track_name']?> - 
                <?= $student['strand_name']?>
              </td>
            </tr>

            <tr>
              <th>Semester:</th>
              <td>
                <?php if($student['semester'] == 1): ?>
                  <?= $student['semester']?>st Semester
                <?php else: ?>
                  <?= $student['semester']?>nd Semester
                <?php endif ?>
              </td>
            </tr>

            <tr>
              <th>Academic Year:</th>
              <td>
                <?= $student['acad_year']?>
              </td>
            </tr>

            <tr>
              <th>Assessment Status:</th>
              <td>
                <?php if($student['status'] == 'pending'): ?>
                  <div class="alert alert-warning p-1 mb-0"><strong><i class="fas fa-exclamation-circle me-1 fa-fw"></i> <span class="text-capitalize"><?= $student['status'] ?></span></strong></div>
                <?php else: ?>
                  <div class="alert alert-success p-1 mb-0"><strong><i class="fas fa-check-circle me-1 fa-fw"></i> <span class="text-capitalize"><?= $student['status'] ?></span></strong></div>
                <?php endif ?>
              </td>
            </tr>

            <tr>
              <th>Requirement Status:</th>
              <td>
                <?php if($student['isDocumentComplete'] == '0'): ?>
                  <div class="alert alert-warning p-1 mb-0">
                    <strong><i class="fas fa-exclamation-circle me-1 fa-fw"></i> 
                    <span class="text-capitalize">incomplete requirements</span></strong>
                  </div>
                <?php else: ?>
                  <div class="alert alert-success p-1 mb-0">
                    <strong><i class="fas fa-check-circle me-1 fa-fw"></i> 
                    <span class="text-capitalize">Compete requirements</span></strong>
                  </div>
                <?php endif ?>
              </td>
            </tr>

            <tr>
              <th>Date of Enrollment:</th>
              <td>
                <?= date('M d, Y @ h:i:s a', strtotime($student['submitted_at']))?>
              </td>
            </tr>
          </tbody>
        </table>
        
        <!-- edit subject table -->
        <div class="table-responsive">
          <table class="table table-bordered table-light border table-striped mt-4 align-middle">
            <thead>
              <tr>
                <th colspan="7" class="h5 text-center">Student's Schedule</th>
              </tr>
              <tr class="text-center">
                <th></th>
                <th>Subject Code</th>
                <th>Start Time</th>
                <th>Dismiss Time</th>
                <th>Day</th>
                <th>Teacher</th>
                <th>Room</th>
              </tr>
            </thead>
            <tbody>
              <?php if(isset($section_scheds)) : ?>
                <?php foreach($section_scheds as $key => $section_sched) : ?>
                <tr>
                  <th>
                    <?php 
                      $i = $key + 1;
                      echo $i;
                    ?>
                  </th>
                  <th>
                    <input type="hidden" name="e_schedule[<?= $key?>]" value="<?= $section_sched->schedule_id ?>">
                    <input type="text" disabled value="<?= $section_sched->subject_code ?>" class="form-control form-control-sm fw-bold" disabled>
                  </th>
                  <td><input type="time" disabled name="e_st_<?= $key?>" value="<?= $section_sched->start_time?>" class="form-control form-control-sm" placeholder="Start Time Here..."></td>
                  <td><input type="time" disabled name="e_et_<?= $key?>" value="<?= $section_sched->dismiss_time?>" class="form-control form-control-sm" placeholder="Dismiss Time Here..."></td>
                  <td><input type="text" disabled name="e_d_<?= $key?>" value="<?= $section_sched->days?>" class="form-control form-control-sm" placeholder="Day Here..."></td>
                  <td>
                    <input type="text" disabled name="e_teacher_<?= $key?>" value="<?= $section_sched->teacher_id?>" list="teacher" class="form-control form-control-sm" placeholder="Teacher Here...">
                    <datalist id="teacher">
                      <?php foreach($teachers as $index => $teacher) :?>
                        <option value="<?= $teacher['teacher_id']?>"><?=  $teacher['firstname'].' '.$teacher['lastname']?></option>
                      <?php endforeach ?>
                    </datalist>
                  </td>
                  <td><input type="text" disabled name="e_rm_<?= $key?>" value="<?= $section_sched->room?>" class="form-control form-control-sm" placeholder="Room Here..."></td>
                </tr>
                <?php endforeach ?>
              <?php endif ?>
            </tbody>                    
          </table>    
        </div>
        <hr>
        <div class="row justify-content-between">
          <div class="col-auto">
            <a href="<?= site_url()?>r/assessment/<?= esc($student_id)?>" class="btn btn-secondary"><i class="fas fa-arrow-left me-1 fa-fw"></i>Back</a>
          </div>
          <div class="col-auto">
            <button type="submit" class="btn btn-outline-primary"><i class="fas fa-save fa fw me-1"></i>Save</button>
          </div>
        </div>
      </div>
    <?= form_close() ?>
  </div>
</main>

<script src="<?= site_url()?>js/returneeform_toggle.js"></script>
<script src="<?= site_url()?>js/guardianfield_toggle.js"></script>
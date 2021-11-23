<main class="p-4">
  <!-- breadcrumb -->
  <div class="d-flex justify-content-between border-bottom mb-5">
    <h4>Schedule</h4>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= site_url()?>r/dashboard">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Course Management</li>
        <li class="breadcrumb-item active" aria-current="page">Schedule</li>
      </ol>
    </nav>
  </div>

  <section class="row justify-content-between g-3 mb-5">
    <div class="col-auto">
      <div class="row g-3">
        <div class="col-auto">
          <button class="btn btn-sm btn-primary float-end" id="asBtn" data-bs-toggle="modal" data-bs-target="#addTrackStrands1">
            <i class="fas fa-plus-square fa-fw me-1"></i> Add Schedule
          </button>
        </div>
        <div class="col-auto">
          <button class="btn btn-sm btn-secondary float-end" data-bs-toggle="modal" data-bs-target="#addClass">
            <i class="fas fa-plus-square fa-fw me-1"></i> Add Class
          </button>
        </div>
      </div>
    </div>
    <div class="col-auto">
      <?= form_open('r/crs_schedule/search') ?>
        <?= csrf_field() ?>
        <div class="input-group input-group-sm">
          <div class="input-group-text bg-white border-0"><i class="fas fa-search"></i></div>
          <input type="search" name="search" id="search" class="form-control border-0" placeholder="Search Course or Class...">
          <input type="submit" value="Search" class="btn btn-primary">
        </div>
      <?= form_close() ?>
    </div>
  </section>

  <!-- Modal -->
  <div class="modal fade" id="addTrackStrands1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addTrackStrands1Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addTrackStrands1Label"><i class="far fa-plus-square me-1"></i>Add Schedule</h5>
          <a href="<?=site_url()?>r/crs_schedule" role="button" class="btn-close" aria-label="Close"></a>
        </div> 
        <?= form_open('r/crs_schedule/view_schedule') ?>
        <div class="modal-body">
          <div class="alert alert-info">
            <h6 class="fw-bold"><i class="fas fa-info-circle fa-fw me-1"></i> Notice:</h6><p>Please select the desired Course(Track and Strands), Semester, and Grade Level.</p>
          </div>
          <div class="row g-3 row-cols-1 py-4 align-items-center">
            <div class="col">
              <label for="crs_id" class="form-label"><span class="text-danger me-1">*</span> Course</label>
              <select name="crs_id" id="crs_id" class="form-select text-uppercase">
                <option value="" selected disabled>Select Course...</option>

                  <?php foreach ($track_strands as $key => $c) :?>
                    <option value="<?= $c->course_id?>" <?= set_select('crs_id', $c->course_id) ?>>
                      <?= $c->track_name?> - <?= $c->strand_name?>
                    </option>
                  <?php endforeach ?>  
              </select>
            </div>
            <div class="col">
              <label for="sem" class="form-label"><span class="text-danger me-1">*</span> Semester</label>
              <select name="sem" id="sem" class="form-select text-uppercase">
                <option value="" selected disabled>Select Semester...</option>

                  <?php for ($i=1; $i <= 2; $i++) :?>
                    <option value="<?= $i?>" <?= set_select('sem', $i) ?>>
                      <?= $i?>
                    </option>
                  <?php endfor ?>  
              </select>
            </div>
            <div class="col form-group">
              <label for="grade" class="form-label"><span class="text-danger me-1">*</span> Grade Level</label>
              <select name="grade" id="grade" class="form-select form-select-sm text-uppercase">
                <option value="" selected disabled>Select Grade level</option>
                <option value="11" <?= set_select('grade', '11') ?>>GRADE 11</option>
                <option value="12" <?= set_select('grade', '12') ?>>GRADE 12</option>
              </select>
            </div>
          </div>          
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-outline-primary">Next<i class="fas fa-arrow-right fa-fw ms-1"></i></button>
        </div>        
        <?= form_close() ?>  
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="addTrackStrands2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addTrackStrands2Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addTrackStrands2Label"><i class="far fa-plus-square me-1"></i>Add Schedule</h5>
          <a href="<?=site_url()?>r/crs_schedule" role="button" class="btn-close" aria-label="Close"></a>
        </div> 
        <?= form_open('r/crs_schedule/new_schedule') ?>
        <div class="modal-body">
          <?= csrf_field() ?>
          <?php 
            $flashdata = set_value('selected_course');
            if (isset($selected_course)) {
              $course_name = $selected_course;
            } elseif($flashdata != "") {
              $course_name = $flashdata;
            } else $course_name = '<span class="text-danger">* Please Select a Course</span>';
          ?>
          <h6 class="text-center bg-light w-100 my-4 text-uppercase text-primary"><?= $course_name?></h6>
          <?php 
            $flashdata_row = set_value('row_count');
            if(isset($subjects) && count($subjects) > 0){
              $row_num = count($subjects);
            } elseif($flashdata_row !== 0) {
              $row_num = $flashdata_row;
            } else $row_num = 0;
          ?>

          <input type="hidden" name="course" value="<?= ($course_name != '<span class="text-danger">* Please Select a Course</span>') ? $course_name : '' ?>">

          <?php if(isset($course_id)) :?>
            <input type="hidden" name="crs_id" value="<?= $course_id?>">
            <input type="hidden" name="sem" value="<?= $sem?>">
          <?php endif ?>
          
          <input type="hidden" name="row_count" value="<?= $row_num?>">
          <div class="row g-3">
            <div class="col-auto form-group">
              <label for="acadyear" class="form-label"><span class="text-danger">*</span> Academic Year</label>
              <div class="input-group d-flex gap-3 align-items-center">
                <input type="number" name="s_acadyear" id="s_acadyear" value="<?= set_value('s_acadyear')?>" class="form-control form-control-sm form-control form-control-sm-sm" placeholder="YYYY" min="2019">
                <span class="fw-bold"> - </span>
                <input type="number" name="e_acadyear" id="e_acadyear" value="<?= set_value('e_acadyear')?>" class="form-control form-control-sm form-control form-control-sm-sm" placeholder="YYYY" min="2020">
              </div>
            </div>
            <div class="col-auto form-group">
              <label for="class" class="form-label"><span class="text-danger">*</span> Class</label>
              <select name="class" id="class" class="form-select form-select-sm">
                <option value="" selected disabled>Select a Class...</option>
                <?php for ($i=0; $i < count($sections); $i++) :?>
                  <option value="<?= $sections[$i]['class_id']?>" <?= set_select('class', $sections[$i]['class_id']) ?>><?= $sections[$i]['class_name'] ?></option>
                <?php endfor ?>
              </select>
            </div>
            <div class="col-auto form-group">
              <label for="grade_level" class="form-label"><span class="text-danger">*</span> Grade Level</label>
              <select name="grade_level" id="grade_level" class="form-select form-select-sm">
                <option value="" selected disabled>Select Grade Level</option>
                <?php for ($i=0; $i < 2; $i++) :?>
                  <option value="<?= $i + 11?>" <?= (isset($grade_level) && $grade_level == ($i + 11)) ? set_select('grade', $i + 11, TRUE) : '' ?>>
                    Grade <?=  $i + 11?>
                  </option>
                <?php endfor?>
              </select>
            </div>
          </div>

          <!-- add subject table -->
          <table class="table table-bordered table-light border table-striped mt-4 align-middle">
            <thead>
              <tr class="text-center">
                <th>Subject</th>
                <th>Begin</th>
                <th>Dismiss</th>
                <th>Day</th>
                <th>Teacher</th>
                <th>Room</th>
              </tr>
            </thead>
            <tbody>
              <?php if($row_num != 0): ?>
              <?php for ($j=0; $j < $row_num; $j++) :?>
              <tr>
                <td>
                  <input type="hidden" name="subject_<?= $j?>" value="<?= $subjects[$j]->course_subject_id ?>">
                  <input type="text" value="<?= $subjects[$j]->subject_code ?>" class="form-control form-control-sm" disabled>
                </td>
                <td><input type="time" name="st_<?= $j?>" value="<?= set_value('st_'.$j)?>" class="form-control form-control-sm"></td>
                <td><input type="time" name="et_<?= $j?>" value="<?= set_value('et_'.$j)?>" class="form-control form-control-sm"></td>
                <td><input type="text" name="d_<?= $j?>" value="<?= set_value('d_'.$j)?>" class="form-control form-control-sm" placeholder="Day Here..."></td>
                <td>
                  <input type="text" class="form-control form-control-sm" name="teacher_<?= $j?>" value="<?= set_value('teacher_'.$j)?>" list="teacher" placeholder="Teacher Here...">
                  <datalist id="teacher">
                    <?php for($i=0;$i<count($teachers);$i++) :?>
                      <option value="<?= $teachers[$i]['teacher_id']?>"><?=  $teachers[$i]['firstname'].' '.$teachers[$i]['lastname']?></option>
                    <?php endfor ?>
                  </datalist>
                </td>
                <td><input type="text" name="rm_<?= $j?>" value="<?= set_value('rm_'.$j)?>" class="form-control form-control-sm" placeholder="Room Here..."></td>
              </tr>
              <?php endfor ?>
              <?php endif ?>
            </tbody>                    
          </table>        
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-outline-primary"><i class="far fa-save"></i> Save</button>
        </div>
        <?= form_close()?>  
      </div>
    </div>
  </div>

  <!-- VIEW CLASS SCHEDULES-->
  <section class="bg-white">
    <table class="table table-bordered table-striped border align-middle">
      <thead class="text-center">
        <tr>
          <th></th>
          <th>Course</th>
          <th>Semester</th>
          <th>Class</th>
          <th>Grade Level</th>
          <th>Academic Year</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody class="text-center align-middle small">
        <?php if(isset($schedules) && count($schedules) > 0) : ?>
          <?php $row_num = count($schedules) ?>
          <?php for($i=0; $i < $row_num; $i++) :?>
            <tr>
              <th>
                <?php 
                  $key = $i + 1;
                  echo $key;
                ?>
              </th>
              <td><?= $schedules[$i]->strand_name?></td>
              <td><?= $schedules[$i]->semester?></td>
              <td><?= $schedules[$i]->class_name?></td>
              <td><?= $schedules[$i]->grade_level?></td>
              <td><?= $schedules[$i]->acad_year?></td>
              <td class="align-middle text-center">
                <?= form_open('r/crs_schedule/edit_schedule') ?>
                  <input type="hidden" name="class" value="<?= $schedules[$i]->class_id?>">
                  <input type="hidden" name="sem" value="<?= $schedules[$i]->semester?>">
                  <button type="submit" class="btn btn-sm btn-outline-primary"><i class="far fa-edit"></i> Edit</button>
                <?= form_close() ?>
              </td>
            </tr>
          <?php endfor ?>
        <?php else: ?>
          <tr>
            <td colspan="7"><span class="text-danger fst-italic">No Records Found!</span></td>
          </tr>
        <?php endif ?>
      </tbody>
    </table>
  </section>
</main>

<!-- ADD CLASS MODAL -->
<div class="modal fade" id="addClass" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addClassLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addClassLabel">
          <i class="far fa-plus-square"></i> Add Class
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h6 class="fst-italic text-danger mb-4">Add the Classes in each courses in this institution.</h6>
        <?= form_open('r/crs_schedule/new_class')?>
          <?= csrf_field()?>
          <div class="row row-cols-1 g-2 g-lg-4">
            <div class="col form-group">
              <label for="course" class="form-label"><span class="text-danger">*</span> Course</label>
              <select name="course" id="course" class="form-select form-select-sm">
                <option value="" selected disabled>Select a Course</option>
                <?php for ($i=0; $i < count($courses); $i++) :?>
                  <option value="<?= $courses[$i]->course_id?>">
                    <?= $courses[$i]->track_name?> - <?= $courses[$i]->strand_name?>
                  </option>
                <?php endfor?>
              </select>
            </div>
            <div class="col form-group">
              <label for="grade" class="form-label"><span class="text-danger">*</span> Grade Level</label>
              <select name="grade" id="grade" class="form-select form-select-sm">
                <option value="" selected disabled>Select Grade Level</option>
                <?php for ($i=0; $i < 2; $i++) :?>
                  <option value="<?= $i + 11?>">
                    Grade <?=  $i + 11?>
                  </option>
                <?php endfor?>
              </select>
            </div>
            <div class="col form-group">
              <label for="class_name" class="form-label"><span class="text-danger">*</span> Class Name</label>
              <input type="text" name="class_name" id="class_name" class="form-control form-control-sm" placeholder="Class Name here..">
            </div>
            <div class="col form-group d-flex justify-content-end">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        <?= form_close()?>
      </div>
    </div>
  </div>
</div>

<button class="btn btn-sm d-none btn-primary float-end" id="atsBtn" data-bs-toggle="modal" data-bs-target="#addTrackStrands2">
  <i class="fas fa-plus-square fa-fw me-1"></i> Add Schedule
</button>

<?php 
  $uri = service('uri');
  $page = $uri->getSegment(3);
?>

<?php if($page == 'view_schedule'): ?>
  <?php if(isset($subjects) && count($subjects) > 0):?>
  <script>
    document.addEventListener('DOMContentLoaded', ()=>{
      const atsBtn = document.getElementById('atsBtn');
      atsBtn.click();
    });
  </script>
  <?php endif ?>

  <?php if(isset($subjects) && count($subjects) == 0):?>
  <script>
    document.addEventListener('DOMContentLoaded', ()=>{
      const asBtn = document.getElementById('asBtn');
      asBtn.click();
    });
  </script>
  <?php endif ?>
<?php endif ?>
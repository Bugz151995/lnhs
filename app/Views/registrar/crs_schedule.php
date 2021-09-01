<!-- TOAST SCRIPT -->
<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', () => {
    <?php if(session()->getFlashdata('success')){ ?>
        toastr.success("<?= session()->getFlashdata('success'); ?>");
    <?php }else if(session()->getFlashdata('error')){  ?>
      <?php if(!isset($validation)) :?>
        toastr.error("<?= session()->getFlashdata('error'); ?>");
      <?php else :?>
        toastr.error("<?= session()->getFlashdata('error') . $validation->getError('section_name')?>");
      <?php endif?>
    <?php }else if(session()->getFlashdata('warning')){  ?>
        toastr.warning("<?= session()->getFlashdata('warning'); ?>");
    <?php }else if(session()->getFlashdata('info')){  ?>
        toastr.info("<?= session()->getFlashdata('info'); ?>");
    <?php } ?>
  });
</script>

<!-- ADD SCHEDULE FORM -->
<section class="border bg-white m-4 p-0">
  <div class="w-100 bg-secondary text-light p-3 text-center d-flex">
    <h5 class="mb-0 justify-self-center align-self-middle w-100">Course Schedule</h5>
    <button class="btn btn-sm btn-secondary float-end" data-bs-toggle="modal" data-bs-target="#addSection">
      <i class="fas fa-cogs"></i>
    </button>
  </div>

  <!-- FORM -->
  <div class="px-4 py-2 pb-4">
    <div class="row g-2 g-lg-4">
      <div class="form-group">
        <label for="course" class="form-label"><span class="text-danger">*</span> Course</label>
        <?php $att = ['id' => 'course'] ?>
        <?= form_open('r/crs_schedule/view_schedule', $att) ?>
        <select name="course" id="" class="form-select text-uppercase" onchange="onSelectChange()">
          <option value="" selected disabled>Select Course...</option>
          <?php for ($i=0; $i < count($courses); $i++) :?>
            <option value="(<?= ($courses[$i]->semester == 1) ? $courses[$i]->semester.'st' : $courses[$i]->semester.'nd' ?> SEM) <?= $courses[$i]->track_name?> - <?= $courses[$i]->strand_name?>" <?= set_select('course', $courses[$i]->course_id) ?>>
              (<?= $courses[$i]->semester?> SEM) <?= $courses[$i]->track_name?> - <?= $courses[$i]->strand_name?>
            </option>
            <input type="hidden" name="crs_id" value="<?= $courses[$i]->course_id?>">
            <input type="hidden" name="sem" value="<?= $courses[$i]->semester?>">
          <?php endfor?>
        </select>
        <?= form_close() ?>
      </div>
    </div>

    <?= form_open('r/crs_schedule/new_schedule') ?>
      <?= csrf_field() ?>
      <?php 
        $flashdata = set_value('selected_course');
        if (isset($selected_course)) {
          $course_name = $selected_course;
        } elseif($flashdata != "") {
          $course_name = $flashdata;
        } else $course_name = '<span class="text-danger">* Please Select a Course</span>';
      ?>
      <h6 class="text-center bg-light w-100 my-4"><?= $course_name?></h6>
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
      <div class="row">
        <div class="col-sm-3 form-group">
          <label for="acadyear" class="form-label"><span class="text-danger">*</span> Academic Year</label>
          <div class="input-group d-flex gap-3 align-items-center">
            <input type="number" name="s_acadyear" id="s_acadyear" value="<?= set_value('s_acadyear')?>" class="form-control form-control-sm" placeholder="YYYY" min="2019">
            <span class="fw-bold"> - </span>
            <input type="number" name="e_acadyear" id="e_acadyear" value="<?= set_value('e_acadyear')?>" class="form-control form-control-sm" placeholder="YYYY" min="2020">
          </div>
        </div>
        <div class="col-sm-3 form-group">
          <label for="acadyear" class="form-label"><span class="text-danger">*</span> Section</label>
          <select name="section" id="" class="form-select form-select-sm">
            <option value="" selected disabled>Select a Section...</option>
            <?php for ($i=0; $i < count($sections); $i++) :?>
              <option value="<?= $sections[$i]['section_id']?>" <?= set_select('section', $sections[$i]['section_id']) ?>><?= $sections[$i]['section_name'] ?></option>
            <?php endfor ?>
          </select>
        </div>
      </div>

      <!-- add subject table -->
      <table class="table table-borderless table-light border table-striped mt-4 align-middle">
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
              <input type="text" value="<?= $subjects[$j]->subject_code ?>" class="form-control" disabled>
            </td>
            <td><input type="time" name="st_<?= $j?>" value="<?= set_value('st_'.$j)?>" class="form-control"></td>
            <td><input type="time" name="et_<?= $j?>" value="<?= set_value('et_'.$j)?>" class="form-control"></td>
            <td><input type="text" name="d_<?= $j?>" value="<?= set_value('d_'.$j)?>" class="form-control" placeholder="Day Here..."></td>
            <td>
              <input type="text" class="form-control" name="teacher_<?= $j?>" value="<?= set_value('teacher_'.$j)?>" list="teacher" placeholder="Teacher Here...">
              <datalist id="teacher">
                <?php for($i=0;$i<count($teachers);$i++) :?>
                  <option value="<?= $teachers[$i]['teacher_id']?>"><?=  $teachers[$i]['firstname'].' '.$teachers[$i]['lastname']?></option>
                <?php endfor ?>
              </datalist>
            </td>
            <td><input type="text" name="rm_<?= $j?>" value="<?= set_value('rm_'.$j)?>" class="form-control" placeholder="Room Here..."></td>
          </tr>
          <?php endfor ?>
          <?php endif ?>
        </tbody>                    
      </table>  
      <hr>
      <div class="d-flex justify-content-end">
        <button class="btn btn-outline-primary"><i class="far fa-save"></i> Save</button>
      </div>    
    <?= form_close()?>
  </div>
</section>

<!-- VIEW SECTION SCHEDULE-->
<section class="border bg-white m-4 mt-5 p-0">
  <h5 for="" class="w-100 bg-secondary p-3 text-light text-center">View Schedule</h5>
  <div class="px-4 py-2 pb-4">
    <table class="table table-borderless table-striped border">
      <thead class="text-center">
        <tr>
          <th>Section</th>
          <th>Semester</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody class="text-center align-middle">
        <?php $row_num = count($schedules) ?>
        <?php for($i=0; $i < $row_num; $i++) :?>
          <tr>
            <td><?= $schedules[$i]->section_name?></td>
            <td><?= $schedules[$i]->semester?></td>
            <td class="align-middle text-center">
              <?= form_open('r/crs_schedule/edit_schedule') ?>
                <input type="hidden" name="section" value="<?= $schedules[$i]->section_id?>">
                <input type="hidden" name="sem" value="<?= $schedules[$i]->semester?>">
                <button type="submit" class="btn btn-sm btn-outline-primary"><i class="far fa-edit"></i> Edit</button>
              <?= form_close() ?>
            </td>
          </tr>
        <?php endfor ?>
      </tbody>
    </table>
  </div>
</section>

<!-- ADD SECTION MODAL -->
<div class="modal fade" id="addSection" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addSectionLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addSectionLabel">
          <i class="far fa-plus-square"></i> Add Section
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h6 class="fst-italic text-danger mb-4">Add the sections of courses in this institution.</h6>
        <?= form_open('r/crs_schedule/new_section')?>
          <?= csrf_field()?>
          <div class="row row-cols-1 g-2 g-lg-4">
            <div class="col form-group">
              <label for="course" class="form-label"><span class="text-danger">*</span> Course</label>
              <select name="course" id="course" class="form-select">
                <option value="" selected disabled>Select a Course</option>
                <?php for ($i=0; $i < count($courses); $i++) :?>
                  <option value="<?= $courses[$i]->course_id?>">
                    <?= $courses[$i]->track_name?> - <?= $courses[$i]->strand_name?>
                  </option>
                <?php endfor?>
              </select>
            </div>
            <div class="col form-group">
              <label for="section_name" class="form-label"><span class="text-danger">*</span> Section Name</label>
              <input type="text" name="section_name" id="section_name" class="form-control" placeholder="Section Name here..">
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

<script src="<?= site_url()?>js/submit_sched.js"></script>
<!-- edit course model -->
<div class="modal fade show d-block" id="editTrackStrands" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editTrackStrandsLabel" aria-modal="true" role="dialog" modal="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white px-4">
        <h5 class="modal-title" id="editTrackStrandsLabel"><i class="far fa-edit fa-3x"></i> Edit Course</h5>
        <a href="<?= site_url()?>r/crs_mgt" class="btn-close bg-white me-3" data-bs-dismiss="modal" aria-label="Close"></a>
      </div>
      <div class="modal-body">
        <div class="px-4 py-2 ">
          <?= form_open('r/crs_mgt/update_course')?> 
            <?= csrf_field()?>
            <?php 
              $row_count = count($subjects);
              print_r(session()->getFlashData('row_count'));
              if ($row_count === 0) {
                $row_count = session()->getFlashData('row_count');
              }
            ?>

            <input type="hidden" name="row_count" value="<?= $row_count?>" id="e_rows">
            <div class="row g-2 g-lg-4">
              <div class="col-sm-6 form-group">
                <label for="course" class="form-label"><span class="text-danger">*</span> Track and Strand</label>
                <select name="course" id="" class="form-select form-select-sm text-uppercase">
                  <option value="" selected disabled>Select Track and Strand...</option>
                  <?php for ($i=0; $i < count($track_strands); $i++) :?>
                    <?php $s_ts = ($track_strands[$i]->course_id == $sel_courseid) ? TRUE : FALSE ?>
                    <option value="<?= $track_strands[$i]->course_id?>" <?= set_select('course', $track_strands[$i]->course_id, $s_ts) ?>><?= $track_strands[$i]->track_name?> - <?= $track_strands[$i]->strand_name?></option>
                  <?php endfor?>
                </select>
              </div>
              <div class="col-sm-3 form-group">
                <label for="semester" class="form-label"><span class="text-danger">*</span> Semester</label>
                <select name="semester" id="" class="form-select form-select-sm text-uppercase">
                  <option value="" selected disabled>Select semester</option>
                  <?php for ($i=1; $i <= 2 ; $i++) :?>
                    <?php $s_sem = ($i == $sel_sem) ? TRUE : '' ?>
                    <option value="<?= $i?>" <?= set_select('semester', $i, $s_sem) ?>>
                      <?= $i?>st Semester
                    </option>
                  <?php endfor ?>
                </select>
              </div>
              <div class="col-sm-3 form-group">
                <label for="grade" class="form-label"><span class="text-danger">*</span> Grade Level</label>
                <select name="grade" id="" class="form-select form-select-sm text-uppercase">
                  <option value="" selected disabled>Select Grade level</option>
                  <option value="11" <?= ($subjects[0]->grade_level == 11) ?set_select('grade', '11', TRUE) : set_select('grade', '11') ?>>GRADE 11</option>
                  <option value="12" <?= ($subjects[0]->grade_level == 12) ?set_select('grade', '12', TRUE) : set_select('grade', '12') ?>>GRADE 12</option>
                </select>
              </div>
            </div>

            <!-- edit subject table -->
            <table class="table table-bordered table-light border table-striped mt-4">
              <thead>
                <tr class="text-center">
                  <th></th>
                  <th>Subject Category</th>
                  <th>Subject Code</th>
                  <th>Subject Name</th>
                  <th>Remove</th>
                </tr>
              </thead>
              
              <tbody id="editTable">
                <?php for ($i=0; $i < $row_count; $i++) :?>
                  <tr>
                    <?php $row = $i  + 1 ?>
                    <input type="hidden" name="crs_subjectid_<?= $row?>" value="<?= $subjects[$i]->course_subject_id?>">
                    <input type="hidden" name="subjectid_<?= $row?>" value="<?= $subjects[$i]->subject_id?>">
                    <td class="align-middle"><?= $row ?></td>
                    <td>
                      <select name="category_<?= $row ?>" class="form-select form-select-sm form-select form-select-sm-sm">
                        <option value="" disabled selected class="disabled">Select Category</option>
                        <option value="core" <?= set_select('category_'.$row, 'core', ($subjects[$i]->subject_category == 'core') ? TRUE : FALSE) ?>>Core</option>
                        <option value="applied" <?= set_select('category_'.$row, 'applied', ($subjects[$i]->subject_category == 'applied') ? TRUE : FALSE) ?>>Applied</option>
                        <option value="specialized" <?= set_select('category_'.$row, 'specialized', ($subjects[$i]->subject_category == 'specialized') ? TRUE : FALSE) ?>>Specialized</option>
                      </select>
                    </td>
                    <td><input type="text" name="code_<?= $row ?>" value="<?= set_value('code_'.$i, $subjects[$i]->subject_code) ?>" class="form-control form-control-sm" placeholder="Subject Code Here..."></td>
                    <td><input type="text" name="name_<?= $row ?>" value="<?= set_value('name_'.$i, $subjects[$i]->subject_name) ?>" class="form-control form-control-sm" placeholder="Subject Name Here..."></td>
                    <td id="e_remove_<?= $row?>" class="text-center align-middle">
                      <a href="<?= site_url()?>r/crs_mgt/delete_subject/<?= $subjects[$i]->subject_id?>/<?= $subjects[$i]->course_subject_id?>" type="submit" class="remove-row btn btn-transparent">
                        <i class="far fa-times-circle text-danger fa-fw fa-lg"></i>
                      </a>
                    </td>
                  </tr>
                <?php endfor ?>
              </tbody>                    
            </table>

            <div class="mb-3">
              <div id="e_saveBtn" class="p-2 btn btn-light form-control disabled">
                <i class="far fa-plus-square text-success fa-fw fa-lg"></i> <span>Add Row</span>
              </div>
            </div>
            <hr>
            <div class="d-flex justify-content-end">
              <button class="btn btn-outline-primary"><i class="far fa-save"></i> Save</button>
            </div>
          <?= form_close()?>
        </div>
      </div>
    </div>
  </div>
</div>
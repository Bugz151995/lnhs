<!-- EDIT SCHEDULE MODAL -->
<div class="modal fade show d-block" id="editSchedule" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editTrackStrandsLabel" aria-modal="true" role="dialog" modal="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white px-4">
        <h5 class="modal-title align-middle" id="editTrackStrandsLabel"><i class="far fa-edit fa-3x"></i> <span class="align-middle h-100">Edit Course Schedule</span> </h5>
        <a href="<?= site_url()?>r/crs_schedule" class="btn-close bg-white me-3" data-bs-dismiss="modal" aria-label="Close"></a>
      </div>
      <div class="modal-body">
        <div class="px-4 py-2 ">
          <?= form_open('r/crs_schedule/update_schedule')?>
            <?= csrf_field()?>
            <input type="hidden" name="e_row_count" value="<?= count($section_scheds)?>">
            <input type="hidden" name="e_crs_id" value="<?= $section_scheds[0]->course_id?>">
            <input type="hidden" name="e_sem" value="<?= $section_scheds[0]->semester?>">
            <div class="row row-cols-1 row-cols-lg-3 mb-2">
              <div class="col form-group">
                <label for="class" class="form-label"><span class="text-danger">*</span> Class</label>
                <select name="class" id="class" class="form-select form-select-sm">
                  <option value="" disabled>Select a Class...</option>
                  <?php foreach($sections as $key => $section) : ?>
                    <option value="<?= $section['class_id']?>" <?= ($section['class_id'] == $section_scheds[0]->class_id) ? set_select('e_section', $section_scheds[0]->class_id, TRUE) : set_select('e_section', $section['class_id']) ?>>
                      <?= $section['class_name'] ?>
                    </option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="col form-group">
                <label for="semester" class="form-label"><span class="text-danger">*</span> Semester</label>
                <select name="e_semester" id="e_semester" class="form-select form-select-sm">
                  <option value="" disabled>Select a Semester...</option>
                  <?php for ($i=1; $i <= 2; $i++) :?>
                    <option value="<?= $i?>" <?= ($section_scheds[0]->semester == $i) ? set_select('e_semester', $section_scheds[0]->semester, TRUE) : set_select('e_semester', $i)  ?>>
                      <?= ($i == 1) ? $i.'st' : $i.'nd' ?> Semester
                    </option>
                  <?php endfor ?>
                </select>
              </div>
              <div class="col form-group">
                <label for="acadyear" class="form-label"><span class="text-danger">*</span> Academic Year</label>
                <div class="input-group d-flex gap-3 align-items-center">
                  <?php $acadyear = explode('-', $section_scheds[0]->acad_year); ?>
                  <input type="number" name="e_s_acadyear" id="acadyear" value="<?= $acadyear[0]?>" class="form-control form-control-sm" placeholder="YYYY">
                  <span> - </span>
                  <input type="number" name="e_e_acadyear" id="acadyear" value="<?= $acadyear[1]?>" class="form-control form-control-sm" placeholder="YYYY">
                </div>
              </div>
            </div>

            <!-- add subject table -->
            <div class="table-responsive">
              <table class="table table-bordered table-light border table-striped mt-4 align-middle">
                <thead>
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
                      <td>
                        <input type="hidden" name="e_schedule_<?= $key?>" value="<?= $section_sched->schedule_id ?>">
                        <input type="hidden" name="e_subject_<?= $key?>" value="<?= $section_sched->course_subject_id ?>">
                        <input type="text" value="<?= $section_sched->subject_code ?>" class="form-control form-control-sm" disabled>
                      </td>
                      <td><input type="time" name="e_st_<?= $key?>" value="<?= $section_sched->start_time?>" class="form-control form-control-sm" placeholder="Start Time Here..."></td>
                      <td><input type="time" name="e_et_<?= $key?>" value="<?= $section_sched->dismiss_time?>" class="form-control form-control-sm" placeholder="Dismiss Time Here..."></td>
                      <td><input type="text" name="e_d_<?= $key?>" value="<?= $section_sched->days?>" class="form-control form-control-sm" placeholder="Day Here..."></td>
                      <td>
                        <input type="text" name="e_teacher_<?= $key?>" value="<?= $section_sched->teacher_id?>" list="teacher" class="form-control form-control-sm" placeholder="Teacher Here...">
                        <datalist id="teacher">
                          <?php foreach($teachers as $index => $teacher) :?>
                            <option value="<?= $teacher['teacher_id']?>"><?=  $teacher['firstname'].' '.$teacher['lastname']?></option>
                          <?php endforeach ?>
                        </datalist>
                      </td>
                      <td><input type="text" name="e_rm_<?= $key?>" value="<?= $section_sched->room?>" class="form-control form-control-sm" placeholder="Room Here..."></td>
                    </tr>
                    <?php endforeach ?>
                  <?php endif ?>
                </tbody>                    
              </table>    
            </div>
            
            <div class="d-flex gap-2 gap-lg-3 justify-content-end">
              <a href="<?= site_url()?>r/crs_schedule" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</a>
              <button type="submit" class="btn btn-primary"><i class="fas fa-save fa-fw"></i> Save</button> 
            </div>
          <?= form_close()?>
        </div>
      </div>
    </div>
  </div>
</div>
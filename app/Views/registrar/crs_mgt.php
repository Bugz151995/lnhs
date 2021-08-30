<!-- TOAST SCRIPT -->
<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', () => {
    <?php if(session()->getFlashdata('success')){ ?>
        toastr.success("<?= session()->getFlashdata('success'); ?>");
    <?php }else if(session()->getFlashdata('error')){  ?>
      <?php if(!isset($validation)) :?>
        toastr.error("<?= session()->getFlashdata('error'); ?>");
      <?php else :?>
        toastr.error("<?= session()->getFlashdata('error') . $validation->getError('strand')?>");
      <?php endif?>
    <?php }else if(session()->getFlashdata('warning')){  ?>
        toastr.warning("<?= session()->getFlashdata('warning'); ?>");
    <?php }else if(session()->getFlashdata('info')){  ?>
        toastr.info("<?= session()->getFlashdata('info'); ?>");
    <?php } ?>
  });
</script>

<!-- SET COURSE FORM -->
<section class="border bg-white m-4 p-0">
  <div class="w-100 bg-secondary text-light p-3 text-center d-flex">
    <h5 class="mb-0 justify-self-center align-self-middle w-100">Add Course</h5>
    <button class="btn btn-sm btn-secondary float-end" data-bs-toggle="modal" data-bs-target="#addTrackStrands">
      <i class="fas fa-cogs"></i>
    </button>
  </div>

  <!-- set course form -->
  <div class="px-4 py-2 pb-4">
    <?= form_open('r/crs_mgt/set_course')?> 
      <?= csrf_field()?>
      <input type="hidden" name="row_count" value="<?= (session()->getFlashData('row_count')) ? session()->getFlashData('row_count') : '1'?>" id="a_rows">
      <div class="row g-2 g-lg-4">
        <div class="col-sm-9 form-group">
          <label for="course" class="form-label"><span class="text-danger">*</span> Track and Strand</label>
          <select name="course" id="" class="form-select text-uppercase">
            <option value="" selected disabled>Select Track and Strand...</option>
            <?php for ($i=0; $i < count($track_strands); $i++) :?>
              <option value="<?= $track_strands[$i]->course_id?>" <?= set_select('course', $track_strands[$i]->course_id) ?>>
                <?= $track_strands[$i]->track_name?> - <?= $track_strands[$i]->strand_name?>
              </option>
            <?php endfor?>
          </select>
        </div>
        <div class="col-sm-3 form-group">
          <label for="semester" class="form-label"><span class="text-danger">*</span> Semester</label>
          <select name="semester" id="" class="form-select text-uppercase">
            <option value="" selected disabled>Select semester</option>
            <option value="1" <?= set_select('semester', '1') ?>>1st Semester</option>
            <option value="2" <?= set_select('semester', '2') ?>>2nd Semester</option>
          </select>
        </div>
      </div>

      <!-- add subject table -->
      <div class="table-responsive">
        <table class="table table-borderless table-light border table-striped mt-4 mb-0">
          <thead>
            <tr class="text-center">
              <th></th>
              <th>Subject Category</th>
              <th>Subject Code</th>
              <th>Subject Name</th>
              <th>Remove</th>
            </tr>
          </thead>
          <tbody id="addTable">
            <?php if (session()->getFlashdata('error')) :?>
              <?php for ($i=1; $i <= session()->getFlashData('row_count'); $i++) :?>
                <tr>
                  <td class="align-middle"><?= $i ?></td>
                  <td>
                    <select name="category_<?= $i ?>" class="form-select">
                      <option value="" disabled selected class="disabled">Select Category</option>
                      <option value="core" <?= set_select('category_'.$i, 'core') ?>>Core</option>
                      <option value="applied" <?= set_select('category_'.$i, 'applied') ?>>Applied</option>
                      <option value="specialized" <?= set_select('category_'.$i, 'specialized') ?>>Specialized</option>
                    </select>
                  </td>
                  <td><input type="text" name="code_<?= $i ?>" value="<?= set_value('code_'.$i) ?>" class="form-control" placeholder="Subject Code Here..."></td>
                  <td><input type="text" name="name_<?= $i ?>" value="<?= set_value('name_'.$i) ?>" class="form-control" placeholder="Subject Name Here..."></td>
                  <td id="remove_<?= $i?>" class="text-center align-middle">
                    <?php if($i == 1) :?>
                      <div class="remove-row">
                        <i class="far fa-times-circle text-secondary fa-fw fa-lg"></i>
                      </div>
                    <?php else :?>
                      <div class="remove-row">
                        <i class="far fa-times-circle text-danger fa-fw fa-lg"></i>
                      </div>
                    <?php endif ?>
                  </td>
                </tr>
              <?php endfor ?>
            <?php else :?>
              <tr>
                <td class="align-middle">1</td>
                <td>
                  <select name="category_1" class="form-select">
                    <option value="" disabled selected class="disabled">Select Category</option>
                    <option value="core">Core</option>
                    <option value="applied">Applied</option>
                    <option value="specialized">Specialized</option>
                  </select>
                </td>
                <td><input type="text" name="code_1" class="form-control" placeholder="Subject Code Here..."></td>
                <td><input type="text" name="name_1" class="form-control" placeholder="Subject Name Here..."></td>
                <td class="text-center align-middle">
                  <div class="remove-row">
                    <i class="far fa-times-circle text-secondary fa-fw fa-lg"></i>
                  </div>
                </td>
              </tr>
            <?php endif ?>
          </tbody>
        </table>
      </div>
          
      <div class="mb-3">
        <?php if(session()->getFlashData('row_count') != '10') :?>
        <div id="a_saveBtn" class="p-2 btn btn-light form-control">
          <i class="far fa-plus-square text-success fa-fw fa-lg"></i> <span>Add Row</span>
        </div>
        <?php endif ?>
      </div>
      <hr>
      <div class="d-flex justify-content-end">
        <button class="btn btn-outline-primary"><i class="far fa-save"></i> Save</button>
      </div>
    <?= form_close()?>
  </div>
</section>

<!-- VIEW COURSE -->
<section class="border bg-white m-4 mt-5 p-0">
  <h5 for="" class="w-100 bg-secondary text-light p-3 text-center">View Courses</h5>
  <div class="px-4 py-2 pb-4">
    <table class="table table-light table-borderless table-striped border">
      <thead class="text-center">
        <tr>
          <th>Track</th>
          <th>Strand</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody class="align-middle text-uppercase">
        <?php for ($i=0; $i < count($course); $i++) :?>
          <tr>
            <td><?= $course[$i]->track_name?></td>
            <td><?= $course[$i]->strand_name?></td>
            <td class="align-middle text-center">
              <?= form_open('r/crs_mgt/edit_course') ?>
                <?= csrf_field() ?>
                <input type="hidden" name="crs" value="<?= $course[$i]->course_id?>">
                <input type="hidden" name="sem" value="<?= $course[$i]->semester?>">
                <button type="submit" class="btn btn-sm btn-outline-primary">
                  <i class="far fa-edit"></i> Edit
                </button>
              <?= form_close() ?>
            </td>
          </tr>
        <?php endfor?>
      </tbody>
    </table>
  </div>
</section>

<!-- MODALS -->
<!-- ADD COURSE MODAL -->
<div class="modal fade" id="addTrackStrands" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addTrackStrandsLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addTrackStrandsLabel">
          <i class="far fa-plus-square"></i> Add Track and Strands
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h6 class="fst-italic text-danger mb-4">Add only the track and strands offered in this institution.</h6>
        <?= form_open('r/crs_mgt/new_course')?>
          <?= csrf_field()?>
          <div class="row row-cols-1 g-2 g-lg-4">
            <div class="col form-group">
              <label for="track" class="form-label"><span class="text-danger">*</span> Track</label>
              <select name="track" id="" class="form-select">
                <option value="" selected disabled>Select a Track</option>
                <?php for ($i=0; $i < count($track); $i++) :?>
                  <option value="<?= $track[$i]['track_id']?>"><?= $track[$i]['track_name']?></option>
                <?php endfor?>
              </select>
            </div>
            <div class="col form-group">
              <label for="track" class="form-label"><span class="text-danger">*</span> Strand</label>
              <input type="text" name="strand" class="form-control text-uppercase" placeholder="Strand here..">
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

<?php 
  $uri = service('uri');
  $page = $uri->getSegment(3);
  if ($page === NULL):
?>

<script>
  window.addEventListener("DOMContentLoaded", () => {
    for (let index = 2; index <= <?= session()->getFlashData('row_count')?>; index++) {
      var addrowbtn = document.getElementById('a_saveBtn');
      var rows = document.getElementById('a_rows');

      document.getElementById('remove_' + index).addEventListener('click', () => {
        addrowbtn.classList.replace('d-none', 'd-block');
        document.getElementById('remove_' + index).parentElement.remove();
        rows.setAttribute('value', <?= session()->getFlashData('row_count')?> - 1);
      });
    }
  })
</script>

<?php endif ?>
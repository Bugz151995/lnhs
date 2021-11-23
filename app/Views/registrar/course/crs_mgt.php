<main class="p-4">
  <!-- breadcrumb -->
  <div class="d-flex justify-content-between border-bottom mb-5">
    <h4>Track and Strands</h4>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= site_url()?>r/dashboard">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Course Management</li>
        <li class="breadcrumb-item active" aria-current="page">Track and Strands</li>
      </ol>
    </nav>
  </div>

  <section class="row justify-content-between g-3 mb-5">
    <div class="col-auto">
      <div class="row g-3">
        <div class="col-auto">
          <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addCourse">
            <i class="fas fa-plus-square fa-fw me-1"></i> Add Course
          </button>
        </div>
        <div class="col-auto">
          <button class="btn btn-sm btn-secondary float-end" data-bs-toggle="modal" data-bs-target="#addTrackStrands">
            <i class="fas fa-plus-square fa-fw me-1"></i> Add Strand
          </button>
        </div>
      </div>
    </div>
    <div class="col-auto">
      <div class="row">
        <div class="col-auto">
      <a href="<?= site_url()?>r/crs_mgt" class="btn btn-sm btn-primary">Show All</a>
        </div>
        <div class="col-auto">
          <?= form_open('r/crs_mgt/search') ?>
          <?= csrf_field() ?>
          <div class="input-group input-group-sm text-uppercase">
            <select name="searchstrand" id="searchstrand" class="form-select">
              <option value="" selected disabled>Select a Strand</option>
              <?php foreach ($track_strands as $key => $strand):?>
                <option value="<?= $strand->strand_id?>"><?= $strand->strand_name?></option>
              <?php endforeach ?>
            </select>
            <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-search"></i></button>
          </div>
          <?= form_close() ?>
        </div>
      </div>
      
    </div>
  </section>
  
  <!-- Modal -->
  <div class="modal fade" id="addCourse" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addCourseLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addCourseLabel"><i class="far fa-plus-square me-1"></i>Add Course</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <?= form_open('r/crs_mgt/set_course')?> 
        <div class="modal-body">
          <!-- set course form -->
          <div class="px-4 py-2">
              <?= csrf_field()?>
              <input type="hidden" name="row_count" value="<?= (session()->getFlashData('row_count')) ? session()->getFlashData('row_count') : '1'?>" id="a_rows">
              <div class="row g-2 g-lg-4">
                <div class="col-sm-6 form-group">
                  <label for="course" class="form-label"><span class="text-danger">*</span> Track and Strand</label>
                  <select name="course" id="" class="form-select form-select-sm text-uppercase">
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
                  <select name="semester" id="" class="form-select form-select-sm text-uppercase">
                    <option value="" selected disabled>Select semester</option>
                    <option value="1" <?= set_select('semester', '1') ?>>1st Semester</option>
                    <option value="2" <?= set_select('semester', '2') ?>>2nd Semester</option>
                  </select>
                </div>
                <div class="col-sm-3 form-group">
                  <label for="grade" class="form-label"><span class="text-danger">*</span> Grade Level</label>
                  <select name="grade" id="" class="form-select form-select-sm text-uppercase">
                    <option value="" selected disabled>Select Grade level</option>
                    <option value="11" <?= set_select('grade', '11') ?>>GRADE 11</option>
                    <option value="12" <?= set_select('grade', '12') ?>>GRADE 12</option>
                  </select>
                </div>
              </div>

              <!-- add subject table -->
              <div class="table-responsive">
                <table class="table table-bordered table-light border table-striped mt-4 mb-0">
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
                            <select name="category_<?= $i ?>" class="form-select form-select-sm">
                              <option value="" disabled selected class="disabled">Select Category</option>
                              <option value="core" <?= set_select('category_'.$i, 'core') ?>>Core</option>
                              <option value="applied" <?= set_select('category_'.$i, 'applied') ?>>Applied</option>
                              <option value="specialized" <?= set_select('category_'.$i, 'specialized') ?>>Specialized</option>
                            </select>
                          </td>
                          <td><input type="text" name="code_<?= $i ?>" value="<?= set_value('code_'.$i) ?>" class="form-control form-control-sm" placeholder="Subject Code Here..."></td>
                          <td><input type="text" name="name_<?= $i ?>" value="<?= set_value('name_'.$i) ?>" class="form-control form-control-sm" placeholder="Subject Name Here..."></td>
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
                          <select name="category_1" class="form-select form-select-sm">
                            <option value="" disabled selected class="disabled">Select Category</option>
                            <option value="core">Core</option>
                            <option value="applied">Applied</option>
                            <option value="specialized">Specialized</option>
                          </select>
                        </td>
                        <td><input type="text" name="code_1" class="form-control form-control-sm" placeholder="Subject Code Here..."></td>
                        <td><input type="text" name="name_1" class="form-control form-control-sm" placeholder="Subject Name Here..."></td>
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
                <div id="a_saveBtn" class="p-2 btn btn-light form-control form-control-sm">
                  <i class="far fa-plus-square text-success fa-fw fa-lg"></i> <span>Add Row</span>
                </div>
                <?php endif ?>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-outline-primary"><i class="far fa-save"></i> Save</button>
        </div>
        <?= form_close()?>
      </div>
    </div>
  </div>

  <!-- VIEW COURSE -->
  <section class="bg-white">
    <table class="table table-light table-bordered table-striped">
      <thead class="text-center">
        <tr>
          <th></th>
          <th>Track</th>
          <th>Strand</th>
          <th>Semester</th>
          <th>Grade Level</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody class="align-middle text-center text-uppercase small">
        <?php if(count($course) > 0): ?>
          <?php for ($i=0; $i < count($course); $i++) :?>
            <tr>
              <th>
                <?php 
                  $key = $i + 1;
                  echo $key;
                ?>
              </th>
              <td><?= $course[$i]->track_name?></td>
              <td><?= $course[$i]->strand_name?></td>
              <td><?= $course[$i]->semester?></td>
              <td><?= $course[$i]->grade_level?></td>
              <td class="align-middle text-center">
                <?= form_open('r/crs_mgt/edit_course') ?>
                  <?= csrf_field() ?>
                  <input type="hidden" name="crs" value="<?= $course[$i]->course_id?>">
                  <input type="hidden" name="sem" value="<?= $course[$i]->semester?>">
                  <input type="hidden" name="grade" value="<?= $course[$i]->grade_level?>">
                  <button type="submit" class="btn btn-sm btn-outline-primary">
                    <i class="far fa-edit"></i> Edit
                  </button>
                <?= form_close() ?>
              </td>
            </tr>
          <?php endfor?>
        <?php else: ?>
          <tr>
            <td colspan="6"><span class="fst-italic text-danger">No Records found!</span></td>
          </tr>
        <?php endif ?>
      </tbody>
    </table>
  </section>
</main>

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
              <select name="track" id="" class="form-select form-select-sm">
                <option value="" selected disabled>Select a Track</option>
                <?php for ($i=0; $i < count($track); $i++) :?>
                  <option value="<?= $track[$i]['track_id']?>"><?= $track[$i]['track_name']?></option>
                <?php endfor?>
              </select>
            </div>
            <div class="col form-group">
              <label for="track" class="form-label"><span class="text-danger">*</span> Strand</label>
              <input type="text" name="strand" class="form-control form-control-sm text-uppercase" placeholder="Strand here..">
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
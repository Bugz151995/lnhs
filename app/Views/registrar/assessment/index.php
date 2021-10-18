  <!-- MAIN CONTENT -->
    <main class="p-4 my-container">
      <!-- breadcrumb -->
      <div class="d-flex justify-content-between border-bottom mb-5">
        <h4>Enrollments</h4>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= site_url()?>a/dashboard">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Enrollments</li>
          </ol>
        </nav>
      </div>

      <!-- sort and search tool -->
      <div class="d-flex justify-content-between gap-3 mb-5">        
        <button class="btn btn-danger btn-sm" onclick="print('eTable', 'enrollments_report_<?= date('now')?>')"><i class="fas fa-download"></i> Download</button>
        <div class="d-flex justify-content-end gap-3">
          <a href="<?= site_url()?>r/enrollments" class="btn btn-sm btn-primary">Show All</a>
          <?= form_open('r/enrollments/searchdate') ?>
            <?= csrf_field() ?>
            <div class="input-group input-group-sm">
              <input type="date" name="searchdate" id="searchdate" class="form-control border-0">
              <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
            </div>
          <?= form_close() ?>

          <?= form_open('r/enrollments/searchclass') ?>
            <?= csrf_field() ?>
            <div class="input-group input-group-sm">
              <select name="searchclass" id="searchclass" class="form-select">
                <option value="" selected disabled>Select Class</option>
                <?php foreach($class as $key => $c): ?>
                  <option value="<?= $c['class_id']?>"><?= $c['class_name'] ?></option>
                <?php endforeach ?>
              </select>
              <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
            </div>
          <?= form_close() ?>

          <?= form_open('r/enrollments/search') ?>
            <?= csrf_field() ?>
            <div class="input-group input-group-sm">
              <div class="input-group-text bg-white border-0"><i class="fas fa-search"></i></div>
              <input type="search" name="search" id="search" class="form-control border-0" placeholder="Search Name...">
              <input type="submit" value="Search" class="btn btn-primary">
            </div>
          <?= form_close() ?>
        </div>
      </div>
      
      <div class="col-sm-12 justify-content-center">
        <table id="eTable" class="table table-bordered bg-light text-center table-striped">
          <thead>
            <tr>
              <th></th>
              <th scope="col">Date Submitted</th>
              <th scope="col">Image</th>
              <th scope="col">Enrollee's Name</th>
              <th scope="col">Grade Level</th>
              <th scope="col">Class</th>
              <th scope="col">Academic Year</th>
              <th scope="col">Assessment</th>
              <th scope="col">Schedule</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if(count($enrollments) > 0): ?>
            <?php foreach ($enrollments as $key => $enrollment): ?>
              <tr class="align-middle">
                <td>
                  <?php $i = $key + 1; ?>
                  <?= $i ?>.)
                </td>
                <td><?= date('M d, Y', strtotime($enrollment->submitted_at)) ?></td>
                <td>
                  <img src="<?= $enrollment->user_img?>" style="height:50px; width: 50px; object-fit:contain" alt="">
                </td>
                <td>
                  <?= $enrollment->firstname.' ' ?>
                  <?php if($enrollment->middlename): ?>
                    <?= substr($enrollment->middlename, 0, 1).'. ' ?>
                  <?php endif ?>
                  <?= $enrollment->lastname.' ' ?>
                  <?php if($enrollment->suffix): ?>
                    <?= $enrollment->suffix ?>
                  <?php endif ?>
                </td>
                <td><?= $enrollment->grade_level ?></td>
                <td class="text-nowrap"><?= $enrollment->class_name ?></td>
                <td><?= $enrollment->acad_year ?></td>
                <td class="text-nowrap">
                  <?php if($enrollment->status == 'pending'): ?>
                    <span class="alert alert-warning p-1 mb-0"><i class="fas fa-exclamation-circle me-1"></i><?= $enrollment->status ?></span>
                  <?php else: ?>
                    <span class="alert alert-success p-1 mb-0"><i class="fas fa-check-circle me-1"></i><?= $enrollment->status ?></span>
                  <?php endif ?>
                </td>
                <td>
                  <?php if($schedule[$key] == 0): ?>
                    <span class="alert alert-danger p-1 mb-0"><i class="fas fa-times-circle fa-fw"></i></span>
                  <?php else: ?>
                    <span class="alert alert-success p-1 mb-0"><i class="fas fa-check-circle fa-fw"></i></span>
                  <?php endif ?>
                </td>
                <td>
                  <div class="dropdown dropstart">
                    <button class="btn btn-primary" type="button" id="actions" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="actions">
                      <li>
                        <div class="dropdown-item">
                          <a href="<?= site_url()?>r/assessment/<?= $enrollment->student_id?>" type="button" class="btn btn-outline-primary btn-sm w-100">Assess</a>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <a href="<?= site_url()?>r/assessment/evaluation/<?= $enrollment->student_id?>" type="button" class="btn btn-outline-danger btn-sm w-100">Evaluate</a>
                        </div>
                      </li>
                    </ul>
                  </div>
                </td>
              </tr>
            <?php endforeach?>
            <?php else: ?>
                <tr>
                  <td colspan="8"><span class="text-danger fst-italic">No Records Found!</span></td>
                </tr>
            <?php endif ?>
          </tbody>
        </table>
      </div>
    </main> 
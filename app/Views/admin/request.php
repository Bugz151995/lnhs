<main class="p-4">
  <!-- breadcrumb -->
  <div class="d-flex justify-content-between border-bottom mb-5">
    <h4>Token Request</h4>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= site_url()?>a/dashboard">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Student</li>
        <li class="breadcrumb-item active" aria-current="page">Token Request</li>
      </ol>
    </nav>
  </div>
  
  <!-- sort and search tool -->
  <div class="row justify-content-end mb-5">
    <div class="col-auto">
      <a href="<?= site_url()?>a/request" class="btn btn-sm btn-primary">Show All</a>
    </div>
    <div class="col">
      <div class="row">
        <div class="col">
          <?= form_open('a/request/searchclass') ?>
            <?= csrf_field() ?>
            <div class="input-group input-group-sm">
              <select name="searchclass" id="searchclass" class="form-select form-select-sm">
                <option value="" selected disabled>Select a Class...</option>
                <?php foreach ($class as $key => $c) :?>
                <option value="<?= $c['class_id']?>"><?= $c['class_name'] ?></option>
                <?php endforeach ?>
              </select>
              <div class="input-group-text p-0">
                <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-search"></i></button>
              </div>
            </div>        
          <?= form_close() ?>
        </div>

        <div class="col">
          <?= form_open('a/request/searchdate') ?>
            <?= csrf_field() ?>
            <div class="input-group input-group-sm">
              <input type="date" name="searchdate" id="searchdate" class="form-control">
              <div class="input-group-text p-0">
                <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-search"></i></button>
              </div>
            </div>        
          <?= form_close() ?>
        </div>

        <div class="col">
          <?= form_open('a/request/search') ?>
            <?= csrf_field() ?>
            <div class="input-group input-group-sm shadow-sm">
              <div class="input-group-text bg-white border-0"><i class="fas fa-search"></i></div>
              <input type="search" name="searchstudent" id="searchstudent" class="form-control border-0" placeholder="Search Name...">
              <input type="submit" value="Search" class="btn btn-primary">
            </div>
          <?= form_close() ?>
        </div>
      </div>
    </div>
  </div>

  <ul class="nav nav-tabs nav-fill">
    <li class="nav-item">
      <a class="nav-link h5 py-3 active bg-primary text-light" aria-current="page" href="<?= site_url()?>a/request">Student</a>
    </li>
    <li class="nav-item">
      <a class="nav-link h5 py-3" href="<?= site_url()?>a/r_request">Registrar</a>
    </li>
  </ul>
  <div class="table-responsive">
    <table class="table table-primary table-striped table-bordered text-center align-middle" id="reqTable">
      <thead>
        <tr>
          <th></th>
          <th>Date Requested</th>
          <th>ID Picture</th>
          <th>Student Name</th>
          <th>Contact Information</th>
          <th>Class</th>
          <th>Academic Year</th>
          <th>Semester</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if(count($students) != 0) : ?>
          <?php foreach($students as $key => $student) : ?>
          <tr>
            <td>
              <?php $i = $key + 1; ?>
              <?= $i ?>.)
            </td>
            <td><?= date('M d, Y', strtotime($student->requested_at)) ?></td>
            <td width="100"><img src="<?= $student->valid_id ?>" class="img-fluid" alt=""></td>
            <td class="text-nowrap">
              <?= $student->firstname.' '?>
                <?php if($student->middlename): ?>
                  <?= substr($student->middlename, 0, 1).'. ' ?>
                <?php endif ?>
              <?= $student->lastname ?>
            </td>
            <td>
              <span class="text-decoration-underline">
                <?= $student->email ?>
              </span>
              <br>
              (<?= $student->contact_num ?>)
            </td>
            <td class="text-nowrap"><?= $student->class_name ?></td>
            <td><?= $student->acad_year ?></td>
            <td><?= $student->semester ?></td>
            <td>
              <div class="dropdown dropstart">
                <button class="btn btn-primary" type="button" id="actions" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fas fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="actions">
                  <li>
                    <div class="dropdown-item">
                      <?= form_open('a/request/approve') ?>
                        <?= csrf_field() ?>
                        <input type="hidden" name="email" value="<?= $student->email?>">
                        <input type="hidden" name="request_id" value="<?= $student->token_request_id?>">
                        <button type="submit" class="btn btn-outline-success btn-sm w-100 text-nowrap"><i class="far fa-check-circle"></i> Approve</button>
                      <?= form_close() ?>
                    </div>
                  </li>
                  <li>
                    <div class="dropdown-item">
                      <?= form_open('a/request/deny') ?>
                        <?= csrf_field() ?>
                        <input type="hidden" name="student_id" value="<?= $student->student_id?>">
                        <input type="hidden" name="request_id" value="<?= $student->token_request_id?>">
                        <button type="submit" class="btn btn-outline-danger btn-sm w-100"><i class="far fa-times-circle"></i> Deny</button>
                      <?= form_close() ?>
                    </div>
                  </li>
                </ul>
              </div>
            </td>
          </tr>
          <?php endforeach ?>
        <?php else : ?>
          <tr>
            <td colspan="9"><span class="text-danger fst-italic">No Records Found</span></td>
          </tr>
        <?php endif ?>
      </tbody>
    </table>
  </div>
</main>
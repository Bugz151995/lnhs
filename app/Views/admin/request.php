<main class="p-4">
  <?= form_open() ?>
    <div class="form-control-sm input-group mb-4">
      <input type="text" class="form-control" placeholder="Search here...">
        <button type="submit" class="input-group-text btn btn-white bg-white border"><i class="fas fa-search"></i></button>
    </div>
  <?= form_close() ?>

  <ul class="nav nav-pills nav-fill">
    <li class="nav-item">
      <a class="nav-link active text-decoration-underline" aria-current="page" href="<?= site_url()?>a/request">Student</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?= site_url()?>a/r_request">Registrar</a>
    </li>
  </ul>
  <label for="reqTable" class="bg-primary text-light text-center w-100 p-3 h5 mb-0 border-top border-light">Token Requests</label>
  <table class="table table-secondary table-striped table-borderless text-center align-middle" id="reqTable">
    <thead>
      <tr>
        <th>Date Requested</th>
        <th>Picture</th>
        <th>Student Name</th>
        <th>Email</th>
        <th>Contact #</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php if(count($students) != 0) : ?>
        <?php foreach($students as $key => $student) : ?>
        <tr>
          <td><?= $student->requested_at ?></td>
          <td width="100"><img src="<?= site_url().$student->valid_id ?>" class="img-fluid" alt=""></td>
          <td><?= $student->firstname . ' ' . $student->lastname ?></td>
          <td><?= $student->email ?></td>
          <td><?= $student->contact_num ?></td>
          <td>
            <div class="d-flex justify-content-around">
              <?= form_open('a/request/approve') ?>
                <?= csrf_field() ?>
                <input type="hidden" name="email" value="<?= $student->email?>">
                <input type="hidden" name="request_id" value="<?= $student->token_request_id?>">
                <button type="submit" class="btn btn-outline-success btn-sm"><i class="far fa-check-circle"></i> Approve</button>
              <?= form_close() ?>

              <?= form_open('a/request/deny') ?>
                <?= csrf_field() ?>
                <input type="hidden" name="student_id" value="<?= $student->student_id?>">
                <input type="hidden" name="request_id" value="<?= $student->token_request_id?>">
                <button type="submit" class="btn btn-outline-danger btn-sm"><i class="far fa-times-circle"></i> Deny</button>
              <?= form_close() ?>
            </div>
          </td>
        </tr>
        <?php endforeach ?>
      <?php else : ?>
        <tr>
          <td colspan="6"><span class="text-danger fst-italic">No Records Found</span></td>
        </tr>
      <?php endif ?>
    </tbody>
  </table>
</main>
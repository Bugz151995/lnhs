<main class="container px-5 py-3">
  <!-- breadcrumb -->
  <div class="d-flex justify-content-between">
    <h4>Teacher</h4>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= site_url()?>r/dashboard">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Teacher</li>
      </ol>
    </nav>
  </div>

  <!-- sort and search tool -->
  <div class="d-flex justify-content-between py-5">
    <!-- Button trigger modal -->    
    <a href="<?= site_url()?>r/teacher_list/add" class="btn btn-primary"><i class="fas fa-plus-square"></i> New Teacher</a>
    <div class="d-flex gap-3">
      <a href="<?= site_url()?>r/teacher_list" class="btn btn-primary">Show All</a>
      <?= form_open('r/teacher_list/search') ?>
        <?= csrf_field() ?>
        <div class="input-group">
          <div class="input-group-text bg-white border-0"><i class="fas fa-search"></i></div>
          <input type="search" name="searchteacher" id="searchteacher" class="form-control border-0" placeholder="Search Teacher...">
          <input type="button" value="Search" class="btn btn-primary">
        </div>
      <?= form_close() ?>
    </div>
  </div>

  <section class="table-responsive">
    <table class="table table-striped text-center align-middle">
      <thead>
        <tr>
          <th>Teacher Image</th>
          <th>Teacher's Name</th>
          <th>Email</th>
          <th>Contact Number</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if(isset($teachers) && count($teachers) > 0): ?>
        <?php foreach ($teachers as $key => $t) :?>
          <tr>
            <td><img src="<?= $t['teacher_img']?>" alt="" id="teacher_img" style="height: 50px; width: 50px; object-fit: contain"></td>
            <td>
              <?= esc($t['firstname']).' ' ?>
              <?php if($t['middlename']): ?>
                <?= substr(esc($t['middlename']), 0, 1).'. ' ?>
              <?php endif ?>
              <?= esc($t['lastname']).' ' ?>
              <?php if($t['suffix']): ?>
                <?= esc($t['suffix']).' ' ?>
              <?php endif ?>
            </td>
            <td><?= esc($t['email']) ?></td>
            <td><?= esc($t['contact_number']) ?></td>
            <td>
              <div class="d-flex gap-3 justify-content-center">
              <?= form_open('r/teacher_list/edit') ?>
                <?= csrf_field() ?>
                <?= form_hidden('teacher_id', esc($t['teacher_id'])) ?>
                <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
              <?= form_close() ?>
              <?= form_open('r/teacher_list/confirm_delete') ?>
                <?= csrf_field() ?>
                <?= form_hidden('teacher_id', esc($t['teacher_id'])) ?>
                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
              <?= form_close() ?>
              </div>
            </td>
          </tr>
        <?php endforeach ?>
        <?php else: ?>
          <tr class="text-center">
            <td colspan="5"><span class="text-danger fst-italic">No Records Found</span></td>
          </tr>
        <?php endif ?>
      </tbody>
    </table>
  </section>
</main>

<input type="button" value="" id="deleteTeacherBtn" class="d-none" data-bs-toggle="modal" data-bs-target="#deleteTeacher">
<!-- Modal -->
<div class="modal fade" id="deleteTeacher" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteTeacherLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title" id="deleteTeacherLabel"><i class="fas fa-question-circle"></i> <span class="align-middle">Confirm Delete</span></h5>
        <a href="<?= site_url()?>r/teacher_list" role="button" class="btn-close" aria-label="Close"></a>
      </div>
      
      <?= form_open_multipart('r/teacher_list/delete') ?>
        <?= csrf_field() ?>
        <?= form_hidden('teacher_id', $teacher_id) ?>
      <div class="modal-body px-3">
          Are you sure that you want to delete the record of this teacher?
      </div>
      <div class="modal-footer">
        <a href="<?= site_url()?>r/teacher_list" role="button" class="btn btn-secondary"> Cancel</a>
        <button type="submit" class="btn btn-primary">Confirm</button>
      </div>
      <?= form_close() ?>
    </div>
  </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('deleteTeacherBtn').click();
  });
</script>
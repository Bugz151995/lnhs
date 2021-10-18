<main class="container px-5 py-3">
  <!-- breadcrumb -->
  <div class="d-flex justify-content-between">
    <h4>Teacher</h4>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
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
    <table class="table table-striped table-bordered text-center align-middle">
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

<input type="button" value="" id="editTeacherBtn" class="d-none" data-bs-toggle="modal" data-bs-target="#editTeacher">
<!-- Modal -->
<div class="modal fade" id="editTeacher" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editTeacherLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editTeacherLabel"><i class="fas fa-plus-square"></i> <span class="align-middle">Add New Teacher</span></h5>
        <a href="<?= site_url()?>r/teacher_list" role="button" class="btn-close" aria-label="Close"></a>
      </div>
      
      <?= form_open_multipart('r/teacher_list/save') ?>
        <?= csrf_field() ?>
        <?= form_hidden('teacher_id', $teacher['teacher_id']) ?>
      <div class="modal-body px-3">
        <div class="mb-3 d-flex justify-content-center">
          <img src="https://dummyimage.com/150x150/000/fff" alt="" style="height: 150px; width: 150px; object-fit: contain" id="img_preview">
        </div>
        <div class="mb-3">
          <label for="img" class="form-label">Teacher's Picture</label>
          <input type="file" name="img" id="img" class="form-control">
          <?php if(isset($validation) && $validation->getError('img')) : ?>
            <div class="text-danger fst-italic"><i class="fas fa-exclamation-circle fa-fw mt-2"></i><?= $validation->getError('img') ?></div>
          <?php endif ?>
        </div>
        <div class="row mb-3 g-3">
          <div class="col">
            <label for="fname" class="form-label">Firstname</label>
            <input type="text" name="fname" id="fname" value="<?= set_value('fname', $teacher['firstname'])?>" class="form-control" placeholder="Firstname">
            <?php if(isset($validation) && $validation->getError('fname')) : ?>
              <div class="text-danger fst-italic"><i class="fas fa-exclamation-circle fa-fw mt-2"></i><?= $validation->getError('fname') ?></div>
            <?php endif ?>
          </div>
          <div class="col">
            <label for="mname" class="form-label">MiddleName</label>
            <input type="text" name="mname" id="mname" value="<?= set_value('mname', $teacher['middlename'])?>" class="form-control" placeholder="MiddleName">
          </div>
          <div class="col">
            <label for="lname" class="form-label">Lastname</label>
            <input type="text" name="lname" id="lname" value="<?= set_value('lname', $teacher['lastname'])?>" class="form-control" placeholder="Lastname">
            <?php if(isset($validation) && $validation->getError('lname')) : ?>
              <div class="text-danger fst-italic"><i class="fas fa-exclamation-circle fa-fw mt-2"></i><?= $validation->getError('lname') ?></div>
            <?php endif ?>
          </div>
          <div class="col">
            <label for="suf" class="form-label">Suffix</label>
            <input type="text" name="suf" id="suf" value="<?= set_value('suf', $teacher['suffix'])?>" class="form-control" placeholder="Suffix">
          </div>
        </div>

        <div class="row mb-3">
          <div class="col">
            <label for="email" class="form-label">Email</label>
            <input type="text" name="email" id="email" value="<?= set_value('email', $teacher['email'])?>" class="form-control" placeholder="Suffix">
            <?php if(isset($validation) && $validation->getError('email')) : ?>
              <div class="text-danger fst-italic"><i class="fas fa-exclamation-circle fa-fw mt-2"></i><?= $validation->getError('email') ?></div>
            <?php endif ?>
          </div>
          <div class="col">
            <label for="cn" class="form-label">Contact Number</label>
            <input type="text" name="cn" id="cn" value="<?= set_value('cn', $teacher['contact_number'])?>" class="form-control" placeholder="Contact Number">
            <?php if(isset($validation) && $validation->getError('cn')) : ?>
              <div class="text-danger fst-italic"><i class="fas fa-exclamation-circle fa-fw mt-2"></i><?= $validation->getError('cn') ?></div>
            <?php endif ?>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
      </div>
      <?= form_close() ?>
    </div>
  </div>
</div>
<script>
  document.getElementById('img').onchange = evt => {
    const [file] = document.getElementById('img').files
    if (file) {
      document.getElementById('img_preview').src = URL.createObjectURL(file)
    }
  }

  document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('editTeacherBtn').click();
  });
</script>
<main class="p-4">
  <!-- breadcrumb -->
  <div class="d-flex justify-content-between border-bottom mb-5">
    <h4>Approved Applications</h4>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= site_url()?>a/dashboard">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">ESC Voucher Management</li>
        <li class="breadcrumb-item active" aria-current="page">Approved Applications</li>
      </ol>
    </nav>
  </div>

  <section class="mb-5">
    <!-- sort and search tool -->
    <div class="d-flex justify-content-between gap-3">
      <button class="btn btn-danger btn-sm" onclick="print('atable', 'esc_approved_report_<?= date('now')?>')"><i class="fas fa-download"></i> Download</button>
      <div class="d-flex justify-content-end gap-3">
        <a href="<?= site_url()?>r/esc_approved" class="btn btn-sm btn-primary">Show All</a>
        <?= form_open('r/esc_approved/searchdate/a') ?>
          <?= csrf_field() ?>
          <div class="input-group input-group-sm">
            <input type="date" name="searchdate" id="searchdate" class="form-control border-0">
            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
          </div>
        <?= form_close() ?>

        <?= form_open('r/esc_approved/searchclass/a') ?>
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

        <?= form_open('r/esc_approved/search/a') ?>
          <?= csrf_field() ?>
          <div class="input-group input-group-sm">
            <div class="input-group-text bg-white border-0"><i class="fas fa-search"></i></div>
            <input type="search" name="search" id="search" class="form-control border-0" placeholder="Search Name...">
            <input type="submit" value="Search" class="btn btn-primary">
          </div>
        <?= form_close() ?>
      </div>
    </div>
  </section>

  <section class="mb-5">
    <div class="table-responsive">
      <table id="atable" class="table table-bordered table-striped align-middle text-center">
        <thead>
          <tr>
            <th></th>
            <th>Request Date</th>
            <th>Image</th>
            <th>Student Name</th>
            <th>Class</th>
            <th>Email</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php if(isset($applications) && count($applications) > 0): ?>
          <?php foreach ($applications as $key => $a) :?>
            <tr>
              <td>
                <?php $i = $key + 1 ?>
                <?= $i ?>.)
              </td>
              <td><?= date('M d, Y', strtotime($a['submitted_at'])) ?></td>
              <td><img src="<?= $a['user_img']?>" alt="" id="teacher_img" style="height: 50px; width: 50px; object-fit: contain"></td>
              <td>
                <?= esc($a['firstname']).' ' ?>
                <?php if($a['middlename']): ?>
                  <?= substr(esc($a['middlename']), 0, 1).'. ' ?>
                <?php endif ?>
                <?= esc($a['lastname']).' ' ?>
                <?php if($a['suffix']): ?>
                  <?= esc($a['suffix']).' ' ?>
                <?php endif ?>
              </td>
              <td><?= esc($a['class_name']) ?></td>
              <td><?= esc($a['email']) ?></td>
              <td>
                <?php if($a['status'] == null):?>
                  <div class="alert alert-primary mb-0 p-1"><i class="fas fa-info-circle me-1"></i>New</div>
                <?php elseif($a['status'] == 'approved'): ?>
                  <div class="alert alert-success mb-0 p-1"><i class="fas fa-check-circle me-1"></i>Approved</div>
                <?php else: ?>
                  <div class="alert alert-danger mb-0 p-1"><i class="fas fa-times-circle me-1"></i>Denied</div>
                <?php endif ?>
              </td>
              <td>
                <?= form_open('r/esc_request/verify') ?>
                  <?= csrf_field() ?>
                  <?= form_hidden('e', esc($a['esc_application_id'])) ?>
                  <?= form_hidden('s', esc($a['student_id'])) ?>
                  <button type="submit" class="btn btn-sm btn-primary">Verify</button>
                <?= form_close() ?>
              </td>
            </tr>
          <?php endforeach ?>
          <?php else: ?>
            <tr class="text-center">
              <td colspan="8"><span class="text-danger fst-italic">No Records Found</span></td>
            </tr>
          <?php endif ?>

        </tbody>
      </table>
    </div>
  </section>
</main>
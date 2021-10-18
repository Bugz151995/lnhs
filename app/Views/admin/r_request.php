<main class="p-4">
  <!-- breadcrumb -->
  <div class="d-flex justify-content-between border-bottom mb-5">
    <h4>Account Approval Request</h4>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= site_url()?>a/dashboard">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Registrar</li>
        <li class="breadcrumb-item active" aria-current="page">Account Approval Request</li>
      </ol>
    </nav>
  </div>

  <!-- sort and search tool -->
  <div class="row justify-content-end mb-5">
    <div class="col">
      <a href="<?= site_url()?>a/r_request" class="btn btn-sm btn-primary">Show All</a>
    </div>
    <div class="col">
      <?= form_open('a/r_request/searchdate') ?>
        <?= csrf_field() ?>
        <div class="input-group input-group-sm">
          <input type="date" name="searchdate" id="searchdate" class="form-control">
          <div class="input-group-text p-0">
            <input type="submit" value="Search Date" class="btn btn-sm btn-primary">
          </div>
        </div>
        
      <?= form_close() ?>
    </div>
    <div class="col">
      <?= form_open('a/r_request/search') ?>
        <?= csrf_field() ?>
        <div class="input-group input-group-sm shadow-sm">
          <div class="input-group-text bg-white border-0"><i class="fas fa-search"></i></div>
          <input type="search" name="searchuser" id="searchuser" class="form-control border-0" placeholder="Search Name...">
          <input type="submit" value="Search" class="btn btn-sm btn-primary shadow-sm">
        </div>
      <?= form_close() ?>
    </div>
  </div>

  <ul class="nav nav-tabs nav-fill">
    <li class="nav-item">
      <a class="nav-link h5 py-3" href="<?= site_url()?>a/request">Student</a>
    </li>
    <li class="nav-item">
      <a class="nav-link h5 py-3 active bg-secondary text-light" aria-current="page" href="<?= site_url()?>a/r_request">Registrar</a>
    </li>
  </ul>

  <table class="table table-secondary table-striped table-bordered text-center align-middle" id="reqTable">
    <thead>
      <tr>
        <th></th>
        <th>Date Requested</th>
        <th>Registrar</th>
        <th>Contact #</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php if(count($registrar) != 0) : ?>
        <?php foreach($registrar as $key => $r) : ?>
        <tr>
          <td>
            <?php $i = $key + 1; ?>
            <?= $i ?>.)
          </td>
          <td><?= date('M d, Y', strtotime($r->requested_at)) ?></td>
          <td>
            <?= $r->firstname.' '?>
              <?php if($r->middlename): ?>
                <?= substr($r->middlename, 0, 1).'. ' ?>
              <?php endif ?>
            <?= $r->lastname ?>
            <br>
            <span class="fst-italic">(<?= $r->username ?>)</span>
          </td>
          <td><?= $r->contact_number ?></td>
          <td>
            <div class="dropdown dropstart">
              <button class="btn btn-primary" type="button" id="actions" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-ellipsis-v"></i>
              </button>
              <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="actions">
                <li>
                  <div class="dropdown-item">
                    <?= form_open('a/r_request/approve') ?>
                      <?= csrf_field() ?>
                      <input type="hidden" name="registrar_id" value="<?= $r->registrar_id?>">
                      <button type="submit" class="btn btn-outline-success btn-sm w-100"><i class="far fa-check-circle"></i> Approve</button>
                    <?= form_close() ?>
                  </div>
                </li>
                <li>
                  <div class="dropdown-item">
                    <?= form_open('a/r_request/deny') ?>
                      <?= csrf_field() ?>
                      <input type="hidden" name="registrar_id" value="<?= $r->registrar_id?>">
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
          <td colspan="7"><span class="text-danger fst-italic">No Records Found</span></td>
        </tr>
      <?php endif ?>
    </tbody>
  </table>
</main>
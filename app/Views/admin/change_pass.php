<main class="p-4">
  <!-- breadcrumb -->
  <div class="d-flex justify-content-between border-bottom mb-5">
    <h4>Dashboard</h4>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= site_url()?>a/dashboard">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
      </ol>
    </nav>
  </div>

  <section class="mb-5">
    <div class="row">
      <div class="col">
        <a href="<?= site_url()?>a/request" class="btn btn-primary w-100 p-4 shadow">
          <div class="d-flex justify-content-between">
            <div id="figures_s">
              <i class="fas fa-users fa-5x fa-fw"></i>
            </div>
            <div>
              <label for="figures_s" class="form-label h4 mb-4">Token Request</label>
              <h5 class="mb-0 h2"><?= $pending_s ?></h5>
            </div>
          </div>
        </a>
      </div>
      <div class="col">
        <a href="<?= site_url()?>a/r_request" class="btn btn-primary w-100 p-4 shadow">
          <div class="d-flex justify-content-between">
            <div id="figures_r">
              <i class="fas fa-chalkboard-teacher fa-5x fa-fw"></i>
            </div>
            
            <div>
              <label for="figures_r" class="form-label h4 mb-4">Account Request</label>
              <h5 class="mb-0 h2"><?= $pending_r ?></h5>
            </div>
            
          </div>
        </a>
      </div>
    </div>
  </section>

  <!-- charts -->
  <section class="mb-5">
    <div class="row g-4">
      <div class="col">
        <div id="s_req" class="d-flex justify-content-center"></div>
      </div>
      <div class="col">
        <div id="r_req" class="d-flex justify-content-center"></div>
      </div>
    </div>
  </section>
</main>

<!-- Button trigger modal -->
<button type="button" id="cpBtn" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#changepass">
  Launch static backdrop modal
</button>

<!-- Modal -->
<div class="modal fade" id="changepass" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="changepassLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered ">
    <div class="modal-content">
      <div class="modal-header bg-primary text-light">
        <h5 class="modal-title" id="changepassLabel"><i class="fas fa-lock-open fa-fw me-1"></i>Change Password</h5>
        <a href="<?= site_url()?>a/dashboard" class="btn-close" aria-label="Close"></a>
      </div>
      <div class="modal-body">
        <?= form_open('a/changepass/save') ?>
          <?= csrf_field() ?>
          <div class="mb-3">
            <label for="password" class="form-label"><span class="text-danger">*</span> Old Password</label>
            <input name="password" id="password" placeholder="Old Password here..." value="<?= set_value('password')?>" type="password" class="form-control form-control-sm">
            <?php if(isset($validation) && $validation->getError('password')) : ?>
              <div class="text-danger fst-italic"><i class="fas fa-exclamation-circle fa-fw mt-2"></i><?= $validation->getError('password') ?></div>
            <?php endif ?>
          </div>
          <div class="mb-3">
            <label for="newpass" class="form-label"><span class="text-danger">*</span> New Password</label>
            <input name="newpass" id="newpass" placeholder="New Password here..." value="<?= set_value('newpass')?>" type="password" class="form-control form-control-sm">
            <?php if(isset($validation) && $validation->getError('newpass')) : ?>
              <div class="text-danger fst-italic"><i class="fas fa-exclamation-circle fa-fw mt-2"></i><?= $validation->getError('newpass') ?></div>
            <?php endif ?>
          </div>
          <div class="mb-3">
            <label for="passconf" class="form-label"><span class="text-danger">*</span> Password Confirmation</label>
            <input name="passconf" id="passconf" placeholder="Password Confirmation here..." value="<?= set_value('pass')?>" type="password" class="form-control form-control-sm">
            <?php if(isset($validation) && $validation->getError('passconf')) : ?>
              <div class="text-danger fst-italic"><i class="fas fa-exclamation-circle fa-fw mt-2"></i><?= $validation->getError('passconf') ?></div>
            <?php endif ?>
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Save</button>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', ()=>{
    const trigger = document.getElementById('cpBtn');
    trigger.click();
  });

  google.charts.load("current", {packages:["corechart"]});
  google.charts.setOnLoadCallback(drawChart1);
  google.charts.setOnLoadCallback(drawChart2);
  function drawChart1() {
    var data = google.visualization.arrayToDataTable([
      ['Category', 'Total Number'],
      ['Approved',     <?= $approved_s?>],
      ['Pending',      <?= $pending_s?>],
    ]);

    var options = {
      title: 'Token Requests this year',
      pieHole: 0.4,
      sliceVisibilityThreshold: .2,
      is3D: true,
      legend: {
        position: 'bottom'
      },
      backgroundColor: {
        fill: '#E3F2FD'
      }
    };

    var chart = new google.visualization.PieChart(document.getElementById('s_req'));
    chart.draw(data, options);
  }

  function drawChart2() {
    var data = google.visualization.arrayToDataTable([
      ['Category', 'Total Number'],
      ['Approved',     <?= $approved_r?>],
      ['Pending',      <?= $pending_r?>],
    ]);

    var options = {
      title: 'Registrar\'s Account Approval Requests this year',
      pieHole: 0.4,
      sliceVisibilityThreshold: .2,
      is3D: true,
      legend: {
        position: 'bottom'
      },
      backgroundColor: {
        fill: '#E3F2FD'
      }
    };

    var chart = new google.visualization.PieChart(document.getElementById('r_req'));
    chart.draw(data, options);
  }
</script>
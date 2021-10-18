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

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
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
    <!-- MAIN CONTENT -->
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

      <div class="row g-5 row-cols-lg-2 m-0 justify-content-start">
        <!-- enrolled students button -->
        <div class="col">
          <div class="card shadow border-0">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <a href="#" class="card-link text-dark text-decoration-none">Enrolled Students</a>
                <i class="fas fa-info-circle text-secondary float-end"></i>
              </div>
              <div class="d-flex mt-2 align-items-center justify-content-between">
                <div class="alert-success alert m-0"><i class="fas fa-users"></i></div>
                <span class="h1 m-0 pe-4"><?= $enrolled['enrollment_id'] ?></span>

                <i class="far fa-chart-bar fa-2x text-success"></i>
              </div>
            </div>
          </div>
        </div>

        <!-- esc grantees -->
        <div class="col">
          <div class="card shadow border-0">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <a href="#" class="card-link text-dark text-decoration-none">ESC Grantees</a>
                <i class="fas fa-info-circle text-secondary float-end"></i>
              </div>
              <div class="d-flex mt-2 align-items-center justify-content-between">
                <div class="alert-danger alert m-0"><i class="fas fa-money-check"></i></div>
                <span class="h1 m-0 pe-4"><?= $grants['esc_grant_id'] ?></span>

                <i class="far fa-chart-bar fa-2x text-danger"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- ChartBody -->
      <div class="row g-5 m-0 mt-5">

        <!--EnrolledStudentChart-->
        <div id="curve_chart" class="col-lg-6 col-md-12 d-flex justify-content-center">
          <script>
            function enrolledChart() {
              var data = google.visualization.arrayToDataTable([
                ['Academic Year', 'Enrollees'],                
                <?php foreach ($approved as $key => $a) :?>
                ['<?= $a['acad_year']?>', <?= $a['approved']?>],
                <?php endforeach ?>
              ]);

              var options = {
                title: 'Enrolled Students',
                vAxis: {
                  title: 'Enrollees'
                },
                legend: { position: 'bottom' },
              };

              var chart = new google.visualization.ColumnChart(
                document.getElementById('curve_chart'));

              chart.draw(data, options);

              var container = document.getElementById('curve_chart');

              redraw(chart, data, 'Enrolled Students',container,'','Enrollees');
            }

            document.addEventListener("DOMContentLoaded", function() {
              setChart(enrolledChart);
            });
          </script>
        </div>

        <!--StrandChart-->
        <div id="donutchart" class="col-lg-6 col-md-12 d-flex justify-content-center">
          <script>
            
            function strandsChart() {
              var data = google.visualization.arrayToDataTable([
                ['Task', 'Senior High Strand'],              
                <?php foreach ($e_strand as $key => $a) :?>
                ['<?= $a['strand_name']?>', <?= $a['approved']?>],
                <?php endforeach ?>
              ]);

              var options = {
                title: 'Enrolled in Strands',
                pieHole: 0.4,
                legend: { position: 'bottom' },
                is3D: true,
              };

              var chart = new google.visualization.PieChart(document.getElementById('donutchart'));

              chart.draw(data, options);

              var container = document.getElementById('donutchart');

              redraw(chart, data, 'Enrolled in Strands',container, '', '', true);

            }

            document.addEventListener("DOMContentLoaded", function() {
              setChart(strandsChart);
            });
          </script>
        </div>
      </div>

      <div class="row mt-2 g-5 d-flex justify-content-center">
        <!--BarChart-->
        <div id="barchart" class="col-11">
          <script>
            function drawBasic() {
              var data = google.visualization.arrayToDataTable([
                ['Academic Year', 'Grantees'],                
                <?php foreach ($esc_grant as $key => $a) :?>
                ['<?= $a['acad_year']?>', <?= $a['approved']?>],
                <?php endforeach ?>
              ]);

              var options = {
                title: 'ESC Grantees',
                vAxis: {
                  title: 'Grantees'
                },
                legend: { position: 'bottom' },
              };

              var chart = new google.visualization.ColumnChart(
                document.getElementById('barchart'));

              chart.draw(data, options);

              var container = document.getElementById('barchart');

              redraw(chart, data, 'ESC Grantees',container,'','Grantees');
            }

            document.addEventListener("DOMContentLoaded", function() {
              setChart(drawBasic);
            });
          </script>
        </div>
      </div>
    </main>
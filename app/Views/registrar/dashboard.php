    <!-- MAIN CONTENT -->
    <main class="py-3 container px-3">
      <div class="row g-2 g-lg-4 row-cols-md-2 row-cols-xl-4 m-0 justify-content-start">
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
                <span class="h1 m-0 pe-4">123</span>

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
                <span class="h1 m-0 pe-4">123</span>

                <i class="far fa-chart-bar fa-2x text-danger"></i>
              </div>
            </div>
          </div>
        </div>

        <!-- payment -->
        <div class="col">
          <div class="card shadow border-0">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <a href="#" class="card-link text-dark text-decoration-none">Payment</a>
                <i class="fas fa-info-circle text-secondary float-end"></i>
              </div>
              <div class="d-flex mt-2 align-items-center justify-content-between">
                <div class="alert-warning alert m-0"><i class="fas fa-cash-register"></i></div>
                <span class="h1 m-0 pe-4">123</span>

                <i class="far fa-chart-bar fa-2x text-warning"></i>
              </div>
            </div>
          </div>
        </div>

        <!-- strands -->
        <div class="col">
          <div class="card shadow border-0">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <a href="#" class="card-link text-dark text-decoration-none">Strands</a>
                <i class="fas fa-info-circle text-secondary float-end"></i>
              </div>
              <div class="d-flex mt-2 align-items-center justify-content-between">
                <div class="alert-info alert m-0"><i class="fab fa-keycdn"></i></div>
                <span class="h1 m-0 pe-4">123</span>

                <i class="far fa-chart-bar fa-2x text-info"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
  
      <!-- ChartBody -->
      <div class="row g-4 m-0 mt-5">

        <!--EnrolledStudentChart-->
        <div id="curve_chart" class="col-lg-7 col-md-12">
          <script>
            function enrolledChart() {
              var data = google.visualization.arrayToDataTable([
                ['Year', 'Old', 'New'],
                ['2004',  1000,   400],
                ['2005',  1170,   460],
                ['2006',  660,   1120],
                ['2007',  1030,   540]
              ]);

              var options = {
                title: 'Enrolled Student',
                curveType: 'function',
                width: 296,
                legend: { position: 'bottom' }
              };

              var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

              chart.draw(data, options);

              redraw(chart, data, options);
            }

            document.addEventListener("DOMContentLoaded", function() {
              setChart(enrolledChart);
            });
          </script>
        </div>

        <!--StrandChart-->
        <div id="donutchart" class="col-lg-5 col-md-12">
          <script>
            function strandsChart() {
              var data = google.visualization.arrayToDataTable([
                ['Task', 'Senior High Strand'],
                ['STEM', 11],
                ['ABM',   2],
                ['GA',    2],
                ['HUMSS', 7]
              ]);

              var options = {
                title: 'Strands',
                width: 296,
                pieHole: 0.4,
              };

              var chart = new google.visualization.PieChart(document.getElementById('donutchart'));

              chart.draw(data, options);

              redraw(chart, data, options);
            }

            document.addEventListener("DOMContentLoaded", function() {
              setChart(strandsChart);
            });
          </script>
        </div>
      </div>
    </main>
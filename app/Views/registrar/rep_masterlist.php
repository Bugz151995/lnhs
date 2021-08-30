<main class="m-4">
  <!-- statistical analysis -->
  <!-- 
    representation of enrollees in every semester;
    left: number of enrollees
    bottom: year

    param: bar chart
    @blue = 1st semester
    @red  = 2nd semester
   -->
  <div class="row pb-5" id="barChart">
    <script>
      function masterlistChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales', 'Expenses'],
          ['2014', 1000, 400],
          ['2015', 1170, 460],
          ['2016', 660, 1120],
          ['2017', 1030, 540]
        ]);

        var options = {
          chart: {
            title: 'Company Performance',
            subtitle: 'Sales, Expenses, and Profit: 2014-2017',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('barChart'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
      
      document.addEventListener("DOMContentLoaded", function() {
        setChart(masterlistChart);
      });
    </script>
  </div>

  <!-- masterlist selection -->
  <div class="row g-4">
    <div class="col-sm-2 p-0 bg-white border">
      <nav class="nav flex-column p-0">
        <a class="nav-link active" aria-current="page" href="#">Grade 11</a>
        <ul>
          <li class="text-decoration-none"><a class="nav-link" href="#">ABM-11</a></li>
          <li class="text-decoration-none"><a class="nav-link" href="#">GAS-11</a></li>
        </ul>
        <a class="nav-link active" aria-current="page" href="#">Grade 12</a>
        <ul>
          <li class="text-decoration-none"><a class="nav-link" href="#">ABM-12</a></li>
          <li class="text-decoration-none"><a class="nav-link" href="#">GAS-12</a></li>
        </ul>
      </nav>
    </div>
    <div class="col-sm-10 px-4">
      <table class="table table-dark table-borderless table-striped">
        <thead>
          <tr>
            <th>Sample</th>
            <th>Sample</th>
            <th>Sample</th>
            <th>Sample</th>
            <th>Sample</th>
            <th>Sample</th>
            <th>Sample</th>
            <th>Sample</th>
          </tr>
        </thead>
        <tbody>
          <?php for($i = 0; $i < 10; $i++):?>
          <tr>
            <td>Sample</td>
            <td>Sample</td>
            <td>Sample</td>
            <td>Sample</td>
            <td>Sample</td>
            <td>Sample</td>
            <td>Sample</td>
            <td>Sample</td>
          </tr>
          <?php endfor?>
        </tbody>
      </table>
    </div>
  </div>
</main>
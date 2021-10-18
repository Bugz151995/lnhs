google.charts.load('current', {'packages':['corechart', 'bar']});

function setChart(chart) {
  google.charts.setOnLoadCallback(chart);
}

function redraw(chart, data, title, container, haxis, vaxis, d) {
  window.addEventListener('resize', () => {
    // medium above
    var w = container.getBoundingClientRect().width - 50;

    var options = {
      title: title,
      curveType: 'function',
      width: w,
      legend: { position: 'bottom' },
      hAxis: {
        title: haxis,
      },
      vAxis: {
        title: vaxis
      },
      is3D: d
    };

    chart.draw(data, options);
  });
}

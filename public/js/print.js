function print(table, name, orientation) {
  if(orientation == null) {
    orientation = 'landscape';
  }
  var element = document.getElementById(table);
  html2pdf(element, {
    margin:       10,
    filename:     name,
    image:        { type: 'jpeg', quality: 0.98 },
    html2canvas:  { scale: 1, logging: true, dpi: 200, letterRendering: true },
    jsPDF:        { unit: 'mm', format: 'a4', orientation: orientation }
  });
}
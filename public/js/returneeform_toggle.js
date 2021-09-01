window.addEventListener("DOMContentLoaded", () => {
  const isreturnee_transferee = document.getElementById('isreturneeortransferee');
  const isnotreturnee_transferee = document.getElementById('isnotreturneeortransferee');
  const hea = document.getElementById('hea');
  const hea_ay = document.getElementById('hea_ay');
  const prev_school = document.getElementById('prev_school');
  const prev_school_address = document.getElementById('prev_school_address');

  isreturnee_transferee.addEventListener('change', () => {
    if(isreturnee_transferee.checked) {
      hea.toggleAttribute('disabled');
      hea_ay.toggleAttribute('disabled');
      prev_school.toggleAttribute('disabled');
      prev_school_address.toggleAttribute('disabled');
    }
  });
  isnotreturnee_transferee.addEventListener('change', () => {
    if(isnotreturnee_transferee.checked) {
      hea.toggleAttribute('disabled');
      hea_ay.toggleAttribute('disabled');
      prev_school.toggleAttribute('disabled');
      prev_school_address.toggleAttribute('disabled');
    }
  });
})
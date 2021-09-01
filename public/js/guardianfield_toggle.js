window.addEventListener("DOMContentLoaded", () => {
  const liveswithparent = document.getElementById('liveswithparent');
  const liveswithguardian = document.getElementById('liveswithguardian');

  const firstname = document.getElementById('firstname_2');
  const middlename = document.getElementById('middlename_2');
  const lastname = document.getElementById('lastname_2');
  const relationship = document.getElementById('relationship_2');
  const contact_num = document.getElementById('contact_number_2');

  liveswithparent.addEventListener('change', () => {
    if(liveswithparent.checked) {
      firstname.toggleAttribute('disabled');
      middlename.toggleAttribute('disabled');
      lastname.toggleAttribute('disabled');
      relationship.toggleAttribute('disabled');
      contact_num.toggleAttribute('disabled');
    }
  });
  liveswithguardian.addEventListener('change', () => {
    if(liveswithguardian.checked) {
      firstname.toggleAttribute('disabled');
      middlename.toggleAttribute('disabled');
      lastname.toggleAttribute('disabled');
      relationship.toggleAttribute('disabled');
      contact_num.toggleAttribute('disabled');
    }
  });
})
function setAddRow(body, btn){
  const tbody = document.getElementById(body);
  const addTierBtn = document.getElementById(btn);

  addTierBtn.addEventListener('click', () => {
    let rows = tbody.childElementCount;
    let tierNumber = rows + 1;
    
    if(rows < 12) {
      let tr = document.createElement('tr');
      for (let index = 0; index < 5; index++) {
        let td = document.createElement('td');
        let input = document.createElement('input');
        let icon = document.createElement('i');

        switch (index) {
          case 0:
            input.setAttribute('type', 'text');
            input.setAttribute('name', 'fbg_lastname_' + tierNumber);
            input.setAttribute('class', 'form-control form-control-sm');
            input.setAttribute('placeholder', 'Last Name here...');
            td.appendChild(input);
            break;
          case 1:
            input.setAttribute('type', 'text');
            input.setAttribute('name', 'fbg_firstname_' + tierNumber);
            input.setAttribute('class', 'form-control form-control-sm');
            input.setAttribute('placeholder', 'First Name here...');
            td.appendChild(input);
            break;
          case 2:
            input.setAttribute('type', 'text');
            input.setAttribute('name', 'fbg_middlename_' + tierNumber);
            input.setAttribute('class', 'form-control form-control-sm');
            input.setAttribute('placeholder', 'Middle Name here...');
            td.appendChild(input);
            break;
          case 3:
            input.setAttribute('type', 'text');
            input.setAttribute('name', 'fbg_relation_' + tierNumber);
            input.setAttribute('class', 'form-control form-control-sm');
            input.setAttribute('placeholder', 'Relationship here...');
            td.appendChild(input);
            break;
          case 4:
            td.setAttribute('class', 'text-center align-middle');
            icon.setAttribute('class', 'far fa-times-circle text-danger fa-fw fa-lg');
            td.appendChild(icon);

            td.addEventListener('click', () => {
              addTierBtn.classList.replace('d-none', 'd-block');
              td.parentElement.remove();
            });
            break;
          default:
            break;
        }
        
        tr.appendChild(td);
      }
      tbody.appendChild(tr);

      if(rows === 11) {
        addTierBtn.classList.toggle('d-none');
      }
    } else addTierBtn.classList.toggle('d-none');
  });
}
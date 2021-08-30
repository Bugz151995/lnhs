function setAddRow(body, btn, rows){
  const tbody = document.getElementById(body);
  const addTierBtn = document.getElementById(btn);
  const rowCount = document.getElementById(rows);

  addTierBtn.addEventListener('click', () => {
    let rows = tbody.childElementCount;
    let tierNumber = rows + 1;
    rowCount.setAttribute('value', tierNumber);

    if(rows < 10) {
      let tr = document.createElement('tr');
      for (let index = 0; index < 5; index++) {
        let td = document.createElement('td');
        let input = document.createElement('input');
        let select = document.createElement('select');
        let icon = document.createElement('i');

        switch (index) {
          case 0:
            td.setAttribute('class', 'align-middle');
            td.innerHTML = (tierNumber);
            break;
          case 1:
            let i = 0;
            while(i < 4) {
              option = document.createElement('option');
              switch (i) {
                case 0:
                  option.setAttribute('disabled', 'true');
                  option.setAttribute('selected', 'true');
                  option.innerHTML = "Select Category...";
                  break;
                case 1:
                  option.setAttribute('value', 'core');
                  option.innerHTML = "Core";
                  break;
                case 2:
                  option.setAttribute('value', 'applied');
                  option.innerHTML = "Applied";
                  break;
                case 3:
                  option.setAttribute('value', 'specialized');
                  option.innerHTML = "Specialized";
                  break;
                default:
                  break;
              }
              select.appendChild(option);
              i++;
            }
            select.setAttribute('class', 'form-select');
            select.setAttribute('name', 'category_' + tierNumber);
            td.appendChild(select);
            break;
          case 2:
            input.setAttribute('type', 'text');
            input.setAttribute('name', 'code_' + tierNumber);
            input.setAttribute('class', 'form-control');
            input.setAttribute('placeholder', 'Subject Code here...');
            td.appendChild(input);
            break;
          case 3:
            input.setAttribute('type', 'text');
            input.setAttribute('name', 'name_' + tierNumber);
            input.setAttribute('class', 'form-control');
            input.setAttribute('placeholder', 'Subject Name here...');
            td.appendChild(input);
            break;
          case 4:
            td.setAttribute('class', 'text-center align-middle');
            icon.setAttribute('class', 'far fa-times-circle text-danger fa-fw fa-lg');
            td.appendChild(icon);

            td.addEventListener('click', () => {
              addTierBtn.classList.replace('d-none', 'd-block');
              td.parentElement.remove();
              rowCount.setAttribute('value', tierNumber - 1);
            });
            break;
          default:
            break;
        }
        
        tr.appendChild(td);
      }
      tbody.appendChild(tr);

      if(rows === 9) {
        addTierBtn.classList.toggle('d-none');
      }
    } else addTierBtn.classList.toggle('d-none');
  });
}
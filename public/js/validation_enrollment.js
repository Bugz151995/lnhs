/**
 * 
 * @param {Array} pages 
 * @param {Array<Object>} fieldMap 
 * @param {Boolean} isSubmit
 */
function validate(pages, fieldMap, isSubmit = false) {
  /**
   * validate the field in page
   * if the field does not have value then return 
   * and update the class and append "is-invalid"
   * else set it to is-valid
   * 
   * */
  
  let invalidFieldCount = 0;

  var a = document.querySelectorAll('div#feedback');

  a.forEach((e) => {
    e.remove();
  });

  fieldMap.forEach((field) => {
    let f = document.getElementById(field);
    if (f.value === null || f.value === '') {
      f.classList.add('is-invalid');
      let div = document.createElement('div');
      div.classList.add('invalid-feedback');
      div.setAttribute('id', 'feedback');
      div.innerHTML = "This field is required."
      f.insertAdjacentHTML('afterEnd', div.outerHTML)
      f.setAttribute('onchange', 'toggleValidField(this)');
      invalidFieldCount++;
    }
  });

  /**
   * show the next page and hide the current page
   * if there is no invalid fields
   */
  if (invalidFieldCount == 0 && !isSubmit) {
    let currentPage = new bootstrap.Modal(document.getElementById(pages.current), {
      keyboard: false,
      backdrop: false
    })

    let nextPage = new bootstrap.Modal(document.getElementById(pages.next), {
      keyboard: false,
      backdrop: false
    })
    
    let currentPageElement = document.getElementById(pages.current);
    currentPageElement.classList.remove('show');
    currentPage.hide();
    nextPage.show();
  }

  if(invalidFieldCount == 0 && isSubmit) submitForm();
}

/**
 * 
 * @param {Boolean} isSubmit 
 */
function submitForm() {
  let form = document.getElementById('enrollmentForm');
  form.submit();
}

/**
 * 
 * @param {DomElement} element 
 */
function toggleValidField(element) {
  let val = element.value;
  if (val !== null || val !== '') {
    element.classList.remove('is-invalid');
    element.classList.add('is-valid');
  }
}

/**
 * 
 * @param {Array} pages 
 */
function nextPage(pages) {
  let currentPage = new bootstrap.Modal(document.getElementById(pages.current), {
    keyboard: false,
    backdrop: false
  })

  let currentPageElement = document.getElementById(pages.current);

  let nextPage = new bootstrap.Modal(document.getElementById(pages.next), {
    keyboard: false,
    backdrop: false
  })

  currentPage.hide();
  nextPage.show();
  currentPageElement.classList.remove('show');
}
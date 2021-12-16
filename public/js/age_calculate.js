function calculateAge() {
  let bday_field = document.getElementById('bday');
  let age = document.getElementById('age');

  let now = new Date();
  let bday = new Date(bday_field.value);
  let diff = now.getFullYear() - bday.getFullYear();

  age.setAttribute('value', diff);
}
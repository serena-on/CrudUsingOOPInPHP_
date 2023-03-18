const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const CodEntrep = urlParams.get('CodEntrep');
fetch('./../../back/Api/Entrepot/DeleteEntrepot.php?CodEntrep=' + CodEntrep)
  .then(response => response.json())
  .then(data => {
    if (data === 'Success') {
      window.location.href = './ReadAllEntrepot.html';
    }
  })
  .catch(error => console.log(error));

const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const CodEntrep = urlParams.get('CodEntrep');

fetch('./../../back/Api/ReadEntrepot.php?CodEntrep=' + CodEntrep)
  .then(response => response.json())
  .then(data => {
    const CodEntrep = document.getElementById('CodEntrep');
    CodEntrep.value = data[0].CodEntrep;
    const LibEntrep = document.getElementById('LibEntrep');
    LibEntrep.value = data[0].LibEntrep;
    const AdrEntrep = document.getElementById('AdrEntrep');
    AdrEntrep.value = data[0].AdrEntrep;
    fetch('./../../back/Api/ReadAllLocalite.php')
      .then(response1 => response1.json())
      .then(data1 => {
        const select = document.getElementById('CodLoca');
        for (let i = 0; i < data1.length; i++) {
          const option = document.createElement('option');
          if (data1[i].CodLoca === data[0].CodLoca) {
            option.selected = true;
          }
          option.value = data1[i].CodLoca;
          option.text = data1[i].LibLoca;
          select.appendChild(option);
        }
      })
      .catch(error => console.log(error));
  })
  .catch(error => console.log(error));

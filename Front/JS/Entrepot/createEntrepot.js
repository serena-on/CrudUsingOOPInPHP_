fetch('./../../back/Api/Localite/ReadAllLocalite.php')
  .then(response => response.json())
  .then(data => {
    const select = document.getElementById('CodLoca');
    for (let i = 0; i < data.length; i++) {
      const option = document.createElement('option');
      option.value = data[i].CodLoca;
      option.text = data[i].LibLoca;
      select.appendChild(option);
    }
  })
  .catch(error => console.log(error));

fetch('../../back/Api/Entrepot/ReadAllEntrepot.php')
  .then(response => response.json())
  .then(data => {
    const tbody = document.getElementById('tbody');
    for (let i = 0; i < data.length; i++) {
      tbody.innerHTML += `<tr><th>${data[i].CodEntrep}</th><th>${data[i].LibEntrep}</th><th>${data[i].AdrEntrep}</th><th>${data[i].CodLoca}</th><th><a href="updateEntrepot.html?CodEntrep=${data[i].CodEntrep}">Modifier</a></th><th><a href="../../../back/Api/Entrepot/DeleteEntrepot.php?CodEntrep=${data[i].CodEntrep}">Supprimer</a></th></tr>`;
    }
  })
  .catch(error => console.log(error));

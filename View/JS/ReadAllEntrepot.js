fetch('../../back/Api/ReadAllEntrepot.php')
  .then(response => response.json())
  .then(data => {
    const tbody = document.getElementById('tbody');
    for (let i = 0; i < data.length; i++) {
        // tbody.createElement('tr');
        // const tr = tbody.querySelector('tr');
        // tr.createElement('td');
        // const td1 = tr.querySelector('td');
        // td.innerHTML = data[i].CodEnt;
        // tr.createElement('td');
        // const td = tr.querySelector('td');
        // td.innerHTML = data[i].LibEnt;
        // tr.createElement('td');
        // const td = tr.querySelector('td');
        // td.innerHTML = data[i].LibTypEnt;
        // tr.createElement('td');

    }

})
  .catch(error => console.log(error));

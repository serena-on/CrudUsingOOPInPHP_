const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const Username = urlParams.get('Username');

fetch('./../../back/Api/Agent/ReadAgent1.php?Username=' + Username)
  .then(response => response.json())
  .then(data => {
    const Email = document.getElementById('Email');
    Email.value = data.Email;
    const Username = document.getElementById('Username');
    Username.value = data.Username;
    const NomAgent = document.getElementById('NomAgent');
    NomAgent.value = data.NomAgent;
    const PrenomAgent = document.getElementById('PrenomAgent');
    PrenomAgent.value = data.PrenomAgent;
    const DateNais = document.getElementById('DateNais');
    DateNais.value = data.DateNais;
    const DatePSce = document.getElementById('DatePSce');
    DatePSce.value = data.DatePSce;
    const password = document.getElementById('password');
    password.value = '********';
  })
  .catch(error => console.log(error));

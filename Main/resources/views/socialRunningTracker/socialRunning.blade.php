@include ('header')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" type="text/css" href="css/form.css">

    <title>User Search</title>
</head>
<body>

  <h1>Gebruiker Zoeken</h1>

  <form id="userIdForm">
    <label for="userId">User-ID:</label>
    <input type="number" id="userId" name="userId" required>
    <button type="submit">Zoeken</button>
  </form>

  <form id="usernameForm">
    <label for="username">User-name:</label>
    <input type="text" id="username" name="username" placeholder="bob.miller" required>
    <button type="submit">Zoeken</button>
  </form>

  <form id="runningGroupForm">
    <label for="runningGroupName">RunningGroup-name:</label>
    <input type="text" id="runningGroupName" name="runningGroupName" placeholder="Morning Runners" required>
    <button type="submit">Zoeken</button>
  </form>

  <div id="result"></div>
  
  <script type="importmap">{"imports": {"@urql/core":"https://cdn.jsdelivr.net/npm/@urql/core@4.2.0/+esm"}}</script>
  <script type="module">
    import { Client, createRequest, cacheExchange, fetchExchange, gql } from '@urql/core';

    const client = new Client({
      url: "http://localhost:5000/graphql",
      exchanges: [cacheExchange, fetchExchange]
    });

    function searchUserById() {
      const userId = document.getElementById('userId').value;
      client.query(idQuery, {id:userId})
            .toPromise()
            .then(result => displayResult(result.data))
            .catch(error => {console.error('Error fetching user by ID:', error);});
    }

    function searchUserByUsername() {
      const username = document.getElementById('username').value;
      client.query(usernameQuery, {username:username})
            .toPromise()
            .then(result => displayResult(result.data))
            .catch(error => {console.error('Error fetching user by username:', error);});
    }

    function searchRunningGroupByName(){
      const runningGroupName = document.getElementById('runningGroupName').value;

      client.query(runningGroupQuery, {runningGroupName:runningGroupName})
            .toPromise()
            .then(result => displayResult(result.data))
            .catch(error => {console.error('Error fetching runningGroup by name:', error);});
    } 

    const idQuery = `query GetUserById($id: ID!) {
      getUserById(id: $id) {
        userName
        favRunningSite
        age
        runningGroup {
          runningGroupName
          id
        } 
      }
    }`;
    
    const usernameQuery = `query GetUserByUsername($username: String!){
      getUserByUsername(username: $username) {
        userName
        favRunningSite
        age
        runningGroup {
          runningGroupName
          id
        }
      }
    }`;

    const runningGroupQuery = `query GetRunningGroupByName($runningGroupName: String!){
      getRunningGroupByName(runningGroupName: $runningGroupName){
        id
        users{
          userName
          favRunningSite
         age
        }
      }
    }`;

    function displayResult(data) {
      const resultContainer = document.getElementById('result');
      resultContainer.innerHTML = '';

      if (data.getUserById) {
        resultContainer.innerHTML = `
          <h2>Resultaat:</h2>
          <p><strong>Gebruikersnaam:</strong> ${data.getUserById.userName}</p>
          <p><strong>Favoriete hardlooplocatie:</strong> ${data.getUserById.favRunningSite}</p>
          <p><strong>Leeftijd:</strong> ${data.getUserById.age}</p>
          <p><strong>Hardloopgroep:</strong> ${data.getUserById.runningGroup.runningGroupName}</p>
        `;
      } else if (data.getUserByUsername){
        resultContainer.innerHTML = `
          <h2>Resultaat:</h2>
          <p><strong>Gebruikersnaam:</strong> ${data.getUserByUsername.userName}</p>
          <p><strong>Favoriete hardlooplocatie:</strong> ${data.getUserByUsername.favRunningSite}</p>
          <p><strong>Leeftijd:</strong> ${data.getUserByUsername.age}</p>
          <p><strong>Hardloopgroep:</strong> ${data.getUserByUsername.runningGroup.runningGroupName}</p>
        `;
      } else if (data.getRunningGroupByName){
        const runningGroup = data.getRunningGroupByName;
        resultContainer.innerHTML = `
          <h2>Resultaat:</h2>
          <p><strong>Hardloopgroep:</strong> ${runningGroup.id}</p>
          <p><strong>Gebruikers:</strong></p>
          <ul>
            ${runningGroup.users.map(user => `
              <li>
                <p><strong>Gebruikersnaam:</strong> ${user.userName}</p>
                <p><strong>Favoriete hardlooplocatie:</strong> ${user.favRunningSite}</p>
                <p><strong>Leeftijd:</strong> ${user.age}</p>
              </li>
            `).join('')}
          </ul>
        `;
      }
      
      else {
        resultContainer.innerHTML = '<p>Geen gebruiker gevonden.</p>';
      }
    }

    document.getElementById('userIdForm').addEventListener('submit', function (event) {
      event.preventDefault();
      searchUserById();
    });

    document.getElementById('usernameForm').addEventListener('submit', function (event) {
      event.preventDefault();
      searchUserByUsername();
    });

    document.getElementById('runningGroupForm').addEventListener('submit', function (event) {
      event.preventDefault();
      searchRunningGroupByName();
    });
  </script>

</body>
</html>
@include('footer')
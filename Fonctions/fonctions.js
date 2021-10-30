
function connectionCompte(){
  let login = document.forms["login"].elements["login"].value;
  let password = document.forms["login"].elements["password"].value;
  let utilisateurs_enregistrees = JSON.parse(readFile("user.json")); // TODO: read json file

  if(!login || !password || !utilisateurs_enregistrees[login]["password"] === password){
    document.getElementById("erreur_connection").innerHTML = "Login ou mot de passe invalide";
    return false;
  }

  return true;
}

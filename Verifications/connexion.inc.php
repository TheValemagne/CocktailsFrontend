<?php
if(isset($_POST["connexion"])){ // demande de connexion à un compte client
  if(isset($_POST["login"]) && isset($_POST["password"])){
    $utilisateurs_enregistrees = json_decode(file_get_contents("user.json"), true); // base de données avec les donnees enregistres
    $login = trim($_POST["login"]);
    $password = trim($_POST["password"]);

    if(isset($utilisateurs_enregistrees[$login]) && $utilisateurs_enregistrees[$login]["password"] == $password){ // login et mot de passe coincides
      $_SESSION["login"] = $login; // le login n'est pas dans le dictionnaire du client

      if(isset($_SESSION["recettes"]) && sizeof($_SESSION["recettes"]) > 0){ // le client a ajouté des recettes en préféré avant la connexion au compte
        $utilisateurs_enregistrees[$login]["recettes"] = array_unique(array_merge($utilisateurs_enregistrees[$login]["recettes"], $_SESSION["recettes"]));
        sort($utilisateurs_enregistrees[$login]["recettes"]); // tri les numéros de recettes

        ksort($utilisateurs_enregistrees);
        file_put_contents("user.json", json_encode($utilisateurs_enregistrees, JSON_PRETTY_PRINT)); // enregistrement des changements
      }

      foreach ($utilisateurs_enregistrees[$login] as $donnee_utilisateur => $contenue_donnee) { // recupere et charge les donnees du client dans le fichier json
        $_SESSION[$donnee_utilisateur] = $contenue_donnee;
      }

      if(isset($_GET["page"]) && $_GET["page"] == "inscription"){ // page d'inscription est interdite pour un client authentifié
        header("Location: ./index.php"); // redirection vers la page d'acceuil
        exit;
      }
    }
  }
}

if(isset($_SESSION["login"]) && isset($_SESSION["password"])){ // authentification reussie
  $authentifie = true;
} else { // utilisateur non connecte ou erreur lors de la connexion
  $authentifie = false;
}
?>

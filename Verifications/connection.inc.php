<?php
if(isset($_POST["connection"])){ // demande de connection à un compte client
  if(isset($_POST["login"]) && isset($_POST["password"])){
      $utilisateurs_enregistrees = json_decode(file_get_contents("user.json"), true); // base de données avec les donnees enregistres
      $login = trim($_POST["login"]);
      $password = trim($_POST["password"]);

      if(isset($utilisateurs_enregistrees[$login]) && $utilisateurs_enregistrees[$login]["password"] == $password){ // login et mot de passe coincides
        $_SESSION["login"] = $login;
        $_SESSION["password"] = $password;

        foreach ($utilisateurs_enregistrees[$login] as $donnee_utilisateur => $contenue_donnee) { // recupere et charge les donnees du client
          $_SESSION[$donnee_utilisateur] = $contenue_donnee;
        }

        if(isset($_GET["page"]) && $_GET["page"] == "inscription"){ // page d'inscription est interdite pour un client authentifié
          header("Location: ./index.php"); // redirection vers la page d'acceuil
          exit;
        }
      }

      // TODO: inclure la liste de recettes préférées avant connection
  }
}

if(isset($_SESSION["login"]) && isset($_SESSION["password"])){ // authentification reussie
  $authentifie = true;
} else { // utilisateur non connecte ou erreur lors de la connection
  $authentifie = false;
}
?>

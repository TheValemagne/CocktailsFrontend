<?php // ouverture de la base de donnée user.json
if(sizeof($erreurs_inscription) === 0 && sizeof($donnees_valides) > 0 && isset($_POST["modifier"]) && $authentifie) {
  $donnee_utilisateurs = json_decode(file_get_contents("user.json"), true); // associative = true

  foreach ($donnees_valides as $donnee) {
    // Actualisation des données sauvegardées dans la base de données json
    $donnee_utilisateurs[$_SESSION["login"]][$donnee] = trim($_POST[$donnee]);
    $_SESSION[$donnee] = trim($_POST[$donnee]);
  }

  foreach ($donnee_utilisateurs[$_SESSION["login"]] as $donnee_utilisateur => $contenue_donnee) {
    // une donnée a été supprimer par l'utilisateur. L'utilisateur ne peut pas supprimer le mot de passe ou la liste de recettes.
    if(!in_array($donnee_utilisateur, array("password", "recettes")) && (!isset($_POST[$donnee_utilisateur]) || empty($_POST[$donnee_utilisateur])) ){
      unset($donnee_utilisateurs[$_SESSION["login"]][$donnee_utilisateur]);

      if(isset($_SESSION[$donnee_utilisateur])){
        unset($_SESSION[$donnee_utilisateur]); // supprime la variable de session correspondante
      }
    }
  }

  ksort($donnee_utilisateurs);
  file_put_contents("user.json", json_encode($donnee_utilisateurs, JSON_PRETTY_PRINT)); // formater pour plus de lisibilité
}
?>

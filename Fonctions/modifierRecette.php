<?php
session_start();

include("../Donnees.inc.php"); // la base de donnée avec les recettes et ingrédiants

if(isset($_GET['recette']) && isset($Recettes[$_GET['recette']]) ){ // retire la recette des recettes préférées
  if(isset($_SESSION['recettes']) && in_array($_GET['recette'], $_SESSION['recettes'])){
    unset($_SESSION['recettes'][array_search($_GET['recette'], $_SESSION['recettes'])]);

    if(isset($_SESSION['login']) && isset($_SESSION['password'])){ // l'utilisateur est connecté
        $utilisateurs_enregistrees = json_decode(file_get_contents("../user.json"), true); // base de données avec les donnees enregistres
        $utilisateurs_enregistrees[$_SESSION['login']]["recettes"] = array_diff( $utilisateurs_enregistrees[$_SESSION['login']]["recettes"], array($_GET['recette']));

        sort($utilisateurs_enregistrees[$_SESSION['login']]["recettes"]); // tri les numéros de recettes
        file_put_contents("../user.json", json_encode($utilisateurs_enregistrees, JSON_PRETTY_PRINT)); // enregistrement des changements
    }

  } else { // ajoute la recette des recettes préférées
    $_SESSION['recettes'][] = $_GET['recette'];
    sort($_SESSION['recettes']);

    if(isset($_SESSION['login']) && isset($_SESSION['password'])){ // l'utilisateur est connecté
        $utilisateurs_enregistrees = json_decode(file_get_contents("../user.json"), true); // base de données avec les donnees enregistres
        $utilisateurs_enregistrees[$_SESSION['login']]["recettes"][] = $_GET['recette'];

        sort($utilisateurs_enregistrees[$_SESSION['login']]["recettes"]); // tri les numéros de recettes
        file_put_contents("../user.json", json_encode($utilisateurs_enregistrees, JSON_PRETTY_PRINT)); // enregistrement des changements
    }
  }
}
?>

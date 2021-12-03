<?php
session_start();

include("../Donnees.inc.php"); // la base de donnée avec les recettes et ingrédiants

if(isset($_GET['recette']) && isset($Recettes[$_GET['recette']]) ){ // le numéro de recette existe et est dans le tableau $Recettes

  // $a et $b sont des nombres, les identifiants des recettes dans le "panier"
  $triParTitre =  function ($a, $b) use ($Recettes){ // tri les index de recettes en fonction de l'ordre alphabétique des titres de recettes.
    return strcasecmp($Recettes[$a]['titre'], $Recettes[$b]['titre']); // tri insensible à la case
  };

  if(isset($_SESSION['recettes']) && in_array($_GET['recette'], $_SESSION['recettes'])){ // retire la recette des recettes préférées
    unset($_SESSION['recettes'][array_search($_GET['recette'], $_SESSION['recettes'])]); // suppression de la recette des variables de sessions

    if(isset($_SESSION['login']) && isset($_SESSION['password'])){ // l'utilisateur est connecté
        $utilisateurs_enregistrees = json_decode(file_get_contents("../user.json"), true); // base de données avec les donnees enregistres
        unset($utilisateurs_enregistrees[$_SESSION['login']]["recettes"][array_search($_GET['recette'],
                                                                         $utilisateurs_enregistrees[$_SESSION['login']]["recettes"])]);

        usort($utilisateurs_enregistrees[$_SESSION['login']]["recettes"], $triParTitre); // tri en fonction des titres de recettes
        file_put_contents("../user.json", json_encode($utilisateurs_enregistrees, JSON_PRETTY_PRINT)); // enregistrement des changements
    }

  } else { // ajoute la recette des recettes préférées
    $_SESSION['recettes'][] = $_GET['recette']; // ajout de la recette dans les variables de sessions
    usort($_SESSION["recettes"], $triParTitre);

    if(isset($_SESSION['login']) && isset($_SESSION['password'])){ // l'utilisateur est connecté
        $utilisateurs_enregistrees = json_decode(file_get_contents("../user.json"), true); // base de données avec les donnees enregistres
        $utilisateurs_enregistrees[$_SESSION['login']]["recettes"][] = $_GET['recette'];

        usort($utilisateurs_enregistrees[$_SESSION['login']]["recettes"], $triParTitre); // tri en fonction des titres de recettes
        file_put_contents("../user.json", json_encode($utilisateurs_enregistrees, JSON_PRETTY_PRINT)); // enregistrement des changements
    }
  }

}
?>

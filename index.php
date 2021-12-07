<?php // inclusion des verifications
session_start();

// base de donnée
include("Donnees.inc.php"); // la base de donnée avec les recettes et ingrédiants

// verifications
include("Verifications/deconnexion.inc.php"); // gestion de la déconnexion d'un compte
include("Verifications/connexion.inc.php"); // gestion de la connecxion à un compte existant
include("Verifications/formulaire.inc.php"); // vérification du formulaire d'inscription / modification compte
include("Verifications/validationProfil.php"); // met à jour la base de données lors d'un changement du profil

// fonctions
include("Fonctions/fonctions.inc.php"); // fichier de définition des fonctions

$pages_authentifie = array("monProfil", "navigation", "recette", "recettes", "recherche"); // les pages autorisées pour un client connecté
$pages_non_authentifie = array("inscription", "navigation", "recette", "recettes", "recherche"); // les pages autorisées pour un client non connecté
?>
<!DOCTYPE html>

<html lang ="fr">

  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="Fonctions/fonctions.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css" media="screen"/>
  	<title>Cocktails <?php echo isset($_GET["page"]) ? $_GET["page"] : "" ?></title>
  	<meta charset="utf-8" />
  </head>

  <body>
  	<header>
      <ul>
        <li><a href="index.php?page=navigation" class="btn btn-outline-dark <?php echo (!isset($_GET['page']) || (isset($_GET['page']) && $_GET['page'] == 'navigation')) ? 'active' : ''; ?>">Navigation</a></li>
        <li><a href="index.php?page=recettes" class="btn btn-outline-dark <?php echo (isset($_GET['page']) && $_GET['page'] == 'recettes') ? 'active' : ''; ?>">Recettes ❤️</a></li>
        <li>
          <form action="index.php?page=recherche" method="post">
            Recherche : <input type="text" value='<?php echo isset($_POST["requette"]) ? $_POST["requette"] : "" ; ?>' name="requette"/>
            <input type="submit" value="Rechercher" name="rechercher" class="btn btn-outline-dark <?php echo (isset($_GET['page']) && $_GET['page'] == 'recherche') ? 'active' : ''; ?>" />
          </form>
        </li>
        <li>
          <?php include("Pages/zoneConnexion.inc.php"); // formulaire de connection / espace membre ?>
        </li>
      </ul>
  	</header>

<?php
  if(isset($_GET["page"])) {
    if($authentifie && in_array($_GET["page"], $pages_authentifie) ){ // utilisateur connecté
      include("Pages/".$_GET["page"].".php");
    } else if(!$authentifie && in_array($_GET["page"], $pages_non_authentifie) ){ // utilisateur non connecté
      include("Pages/".$_GET["page"].".php");
    } else { // page inexistante ou interdite
      include("Pages/404.html");
    }
  } else { // page d'accueil par défaut
    include("Pages/navigation.php");
  }
?>

  </body>
</html>

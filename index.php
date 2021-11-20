<?php // inclusion des verifications
session_start();

// base de donnée
include("Donnees.inc.php"); // la base de donnée avec les recettes et ingrédiants

// verifications
include("Verifications/deconnexion.inc.php"); // gestion de la déconnexion d'un compte
include("Verifications/connection.inc.php"); // gestion de la connection à un compte existant
include("Verifications/formulaire.inc.php"); // vérification du formulaire d'inscription / modification compte
include("Verifications/validationProfil.php"); // met à jour la base de données lors d'un changement du profil

// fonctions
include("Fonctions/fonctions.inc.php"); // fichier de définition des fonctions

$pages_authentifie = array("monProfil", "navigation", "recette", "recettes", "recherche");
$pages_non_authentifie = array("inscription", "navigation", "recette", "recettes", "recherche");
?>
<!DOCTYPE html>

<html lang ="fr">

  <head>
    <link rel="stylesheet" type="text/css" href="style.css" media="screen"/>
  	<title>Cocktails <?php echo isset($_GET["page"]) ? $_GET["page"] : "" ?></title>
  	<meta charset="utf-8" />
  </head>

  <body>
  	<header>
      <ul>
        <li><a href="index.php?page=navigation">Navigation</a></li>
        <li><a href="index.php?page=recettes">Recettes</a></li>
        <li>
          <form action="index.php?page=recherche" method="post">
            Recherche : <input type="text" value='<?php echo isset($_POST["requette"]) ? $_POST["requette"] : "" ; ?>' name="requette"/>
            <input type="submit" value="Rechercher" name="rechercher"/>
          </form>
        </li>
        <li>
          <?php include("Pages/zoneConnection.inc.php"); ?>
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

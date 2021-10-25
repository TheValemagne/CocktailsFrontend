<?php // inclusion des verifications
session_start();

// base de donnée
include("Donnees.inc.php"); // la base de donnée avec les recettes et ingrédiants

// verifications
include("verification/deconnection.inc.php"); // gestion de la déconnection d'un compte
include("verification/connection.inc.php"); // gestion de la connection à un compte existant
include("verification/formulaire.inc.php"); // vérification du formulaire d'inscription / modification compte

// fonctions
include("fonction/fonctions.inc.php"); // fichier de définition des fonctions

$pages_authentifie = array("acceuil", "monProfil", "navigation", "recettes");
$pages_non_authentifie = array("acceuil", "inscription", "navigation", "recettes");
?>
<!DOCTYPE html>

<html lang ="fr">

  <head>
    <link rel="stylesheet" type="text/css" href="style.css" media="screen"/>
  	<title>Cocktails</title>
  	<meta charset="utf-8" />
  </head>

  <body>
  	<header>
      <ul>
        <li><a href="index.php?page=navigation">Navigation</a></li>
        <li><a href="index.php?page=recettes">Recettes</a></li>
        <li>
          <form action="#" method="post">
            Recherche : <input type="text" value="<?php isset($_POST["requette"]) ? $_POST["requette"] : "" ; ?>" name="requette"/>
            <input type="submit" value="Rechercher" name="rechercher"/>
          </form>
        </li>
        <li>
          <?php if($authentifie) { ?><ul>
            <li><?php
            if(isset($_SESSION["nom"]) && isset($_SESSION["prenom"]) ){ // client connecte avec nom et prenom connus
              echo $_SESSION["nom"]." ".$_SESSION["prenom"];
            } else if(isset($_SESSION["login"])){ // sinon afficher le login
              echo $_SESSION["login"];
            } ?></li>
            <li><a href="index.php?page=monProfil">Mon compte</a></li>
            <li>
              <form action="#" method="post">
                <input type="submit" name="deconnection" value="Se déconnecter" />
              </form>
              <div id="erreur_connection"></div>
            </li>
          </ul>
        <?php } else { ?><form action="#" method="post">
          <input type="text" name="login" value="<?php isset($_POST["login"]) ? $_POST['login'] : ""; ?>" />
          <input type="password" name="password" value="<?php isset($_POST["password"]) ? $_POST['password'] : ""; ?>" />
          <input type="submit" value="Se connecter" name="connection" />
          <a href="index.php?page=inscription">s'inscrire</a>
        </form>
      <?php } ?></li>
      </ul>
  	</header>

<?php
  // TODO: système pour les vues détaillées des recettes -> index.php?page=recette&recette={nom_recette} ?
  if(isset($_GET["page"])) {
    if($authentifie && in_array($_GET["page"], $pages_authentifie) ){ // utilisateur connecté
      include("page/".$_GET["page"].".php");
    } else if(!$authentifie && in_array($_GET["page"], $pages_non_authentifie) ){ // utilisateur non connecté
      include("page/".$_GET["page"].".php");
    } else { // page inexistante ou interdite
      include("page/404.html");
    }
  } else { // page d'acceuil par défaux
    include("page/acceuil.html");
  }
?>

  </body>
</html>

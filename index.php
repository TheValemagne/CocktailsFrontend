<?php
session_start();

include("Donnees.inc.php");
include("verification/inscription.php");
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
<?php // zone de connection
if(isset($_SESSION["user"]) && isset($_SESSION["password"])) {
          echo $_SESSION["user"].'\n <a href="index.php?page=monProfil">Mon compte</a>\n';
} else { ?>
          <form action="#" method="post">
            <input type="text" name="user" value="<?php isset($_POST["user"]) ? $_POST['user'] : ""; ?>" />
            <input type="password" name="password" value="<?php isset($_POST["password"]) ? $_POST['password'] : ""; ?>" />
            <input type="submit" value="Se connecter" name="connection" />
            <a href="index.php?page=inscription">s'inscrire</a>
          </form>
<?php } ?>
        </li>
      </ul>
  	</header>

<?php
  //TODO include tous les types de pages
  if(isset($_GET["page"])) {

    $fichier = "page/".$_GET["page"].".php";

    if(file_exists($fichier)) {
      include($fichier);
    } else {
      include("page/404.html");
    }

  } else {
    echo "index";
  }
?>

  </body>
</html>

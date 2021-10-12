<?php
session_start();

include("Donnees.inc.php");
?>
<!DOCTYPE html>

<html lang ="fr">

  <head>
    <link rel="stylesheet" type="text/css" href="style.css" media="screen"/>
  	<title>Epicerie</title>
  	<meta charset="utf-8" />
  </head>

  <body>
  	<header>
  		<ul>
        <li><a href="index.php?page=navigation">Navigation</a></li>
        <li><a href="index.php?page=recettes">Recettes</a></li>
        <li>
          <form action="#" method="post">
            Recherche : <input type="text" /> <input type="submit" value="Valider" name="rechercher"/>
          </form>
        </li>
        <li>Zone de connection</li>
      </ul>
  	</header>

    <?php
      //TODO include tous les types de pages
      if(isset($_GET["page"]) && $_GET["page"] == "navigation"){
        include("navigation.php");
      }
    ?>

  </body>
</html>

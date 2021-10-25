<?php
  $fil = array();

  if(isset($_GET["aliment"])) {
    $aliment = urlToStr($_GET["aliment"]);
  } else {
    $aliment = "Aliment";
  }
?>
    <nav>
      Aliment courant
      <br />
      <a href="index.php?page=navigation">Aliment</a>
      <br />

      <?php if(isset($Hierarchie[$aliment]) && isset($Hierarchie[$aliment]["sous-categorie"])){ ?>

      Sous-catégories :
      <ul>
        <?php
          $sous_gategories = $Hierarchie[$aliment]["sous-categorie"];
          $index = 0;

          foreach ($sous_gategories as $index => $sous_gategorie){
            if($index > 0){
              echo "\t\t";
            }
            echo "<li><a href=\"index.php?page=navigation&aliment=".strToUrl($sous_gategorie)."\">$sous_gategorie</a></li>\n";
            $index++;
          }
        ?>
      </ul>
      <?php } ?>
    </nav>

    <main>
      <p>
        Liste des cocktails
      </p>
      <ul>
        <?php //TODO filtrer les recettes avec une fonction
        $index = 0;

        foreach ($Recettes as $recette) {
          if($index > 0){
            echo "\t\t";
          }
          echo "<li>".$recette["titre"]."</li>\n";
          $index++;
        } ?>
      </ul>
    </main>

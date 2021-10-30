<?php
  $fil = array();
  $aliment = isset($_GET["aliment"]) ? urlToStr($_GET["aliment"]) :  "Aliment";
  // TODO: page aliemnt inexistant
?>
    <nav>
      Aliment courant
      <br />
      <a href="index.php?page=navigation">Aliment</a>
      <br />

      <?php if(isset($Hierarchie[$aliment]["sous-categorie"])){ ?>

      Sous-catégories :
      <ul>
        <?php
          $sous_gategories = $Hierarchie[$aliment]["sous-categorie"];
          $index = 0;

          foreach ($sous_gategories as $sous_gategorie){
            if($index > 0){
              echo "\t\t";
            }
            echo '<li><a href="index.php?page=navigation&aliment='.strToUrl($sous_gategorie).'">'.$sous_gategorie."</a></li>\n";
            $index++;
          }
        ?>
      </ul>
    <?php } ?></nav>

    <main>
      <p>
        Liste des cocktails
      </p>

      <ul>
        <?php
        $index = 0;
        $liste_ingredients = getIngredientsList($aliment, $Hierarchie);

        foreach ($Recettes as $recette) {
          if(sizeof(array_intersect($liste_ingredients, $recette['index'])) > 0){ // filtre les recetes contenant l'aliment selectionné
            if($index > 0){ // indentation du code
              echo "\t\t";
            }

            $indice_recette = array_search($recette["titre"], array_column($Recettes, 'titre'));
            // TODO: transformer les liens en cartes cocktails
            echo '<li><a href="index.php?page=recette&recette='.$indice_recette.'">'.$recette["titre"]."</a></li>\n";
            $index++;
          }
        }
        ?>
      </ul>

    </main>

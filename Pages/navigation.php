<?php
  $fil_aliments = isset($_GET["fil"]) ? getFilAliments($_GET["fil"]) : array(); // récupère le fil d'Ariane
  $aliment = isset($_GET["fil"]) ? urlToStr(end($fil_aliments)) :  "Aliment";
  // TODO: page aliment inexistant et fil non valide
?>
    <nav>
      Aliment courant
      <br />
      <a href="index.php?page=navigation">Aliment</a>
      <?php
        $index = 0;

        foreach ($fil_aliments as $ancien_aliment) { // construction du fil d'Ariane
          if($index > 0){ // indentation du code
            echo "\t  ";
          }
          $ancien_fil_aliments = setFilAliments(array_slice($fil_aliments, 0, $index + 1)); // ancien fil d'Ariane pour revenir en arrière
          echo '<a href="index.php?page=navigation&fil='.$ancien_fil_aliments.'">'.urlToStr($ancien_aliment)."</a>\n";
          $index++;
        }
      ?>
      <br />
      <?php if(isset($Hierarchie[$aliment]["sous-categorie"])){ ?>

      Sous-catégories :
      <ul>
        <?php
          $sous_gategories = $Hierarchie[$aliment]["sous-categorie"];
          $index = 0;

          foreach ($sous_gategories as $sous_gategorie){ // construction de la liste des sous-catégories
            if($index > 0){ // indentation du code
              echo "\t\t";
            }
            $nouveau_fil_aliments = setFilAliments(array_merge($fil_aliments, array(strToUrl($sous_gategorie)))); // nouveau fil d'Ariane pour la sous-gatégorie
            echo '<li><a href="index.php?page=navigation&fil='.$nouveau_fil_aliments.'">'.$sous_gategorie."</a></li>\n";
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
        $liste_ingredients = getIngredientsList($aliment, $Hierarchie); // retourne une liste avec tous les ingrédients de la catégorie correspondante

        foreach ($Recettes as $recette) {
          if(sizeof(array_intersect($liste_ingredients, $recette['index'])) > 0){ // filtre les recettes contenant l'aliment selectionné
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

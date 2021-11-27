<?php
  $fil_aliments = isset($_GET["fil"]) ? getFilAliments($_GET["fil"]) : array(); // récupère le fil d'Ariane
  $aliment = isset($_GET["fil"]) ? urlToStr(end($fil_aliments)) :  "Aliment";

  if(checkFilAliments($fil_aliments, $Hierarchie)) { //Si fil d'Ariane valide ou aliment valide ?>
    <nav aria-label="breadcrumb">
      <p>
        Aliment courant
      </p>

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?page=navigation">Aliment</a></li>
        <?php
          $index = 0;

          foreach ($fil_aliments as $ancien_aliment) { // construction du fil d'Ariane
            if($index > 0){ // indentation du code
              echo "\t\t";
            }
            $ancien_fil_aliments = setFilAliments(array_slice($fil_aliments, 0, $index + 1)); // ancien fil d'Ariane pour revenir en arrière
            echo '<li class="breadcrumb-item"><a href="index.php?page=navigation&fil='.$ancien_fil_aliments.'">'.urlToStr($ancien_aliment)."</a></li>\n";
            $index++;
          }
          ?>
      </ol>
      <?php if(isset($Hierarchie[$aliment]["sous-categorie"])){ // liste des ingrédients en sous-catégorie ?>

      <p>
        Sous-catégories :
      </p>

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
      <h1>Liste des cocktails</h1>

      <div class="card-deck">
        <?php // construction de la liste de carte de cocktail
          $index = 0;
          $liste_ingredients = getIngredientsList($aliment, $Hierarchie); // retourne une liste avec tous les ingrédients de la catégorie correspondante

          foreach ($Recettes as $recette) {
            if(sizeof(array_intersect($liste_ingredients, $recette['index'])) > 0){ // filtre les recettes contenant l'aliment selectionné
              if($index > 0){ // indentation du code
                echo "\t\t";
              }

              echo creerCarte($recette, $Recettes); // la carte du cocktail

              $index++;
            }
          }
        ?>

      </div>

    </main>
  <?php } else { // erreur dans le fil d'Ariane ou ingrédient non valide ?><main>
      <p>
        Une erreur est survenue lors de la recherche de votre aliment. Retour vers la <a href="./index.php?page=navigation">page de navigation</a>.
      </p>
    </main>
    <?php } ?>

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

      <div class="card-columns">
        <?php
          $index = 0;
          $liste_ingredients = getIngredientsList($aliment, $Hierarchie); // retourne une liste avec tous les ingrédients de la catégorie correspondante

          foreach ($Recettes as $recette) {
            if(sizeof(array_intersect($liste_ingredients, $recette['index'])) > 0){ // filtre les recettes contenant l'aliment selectionné
              if($index > 0){ // indentation du code
                echo "\t\t";
              }

              echo creerCarte($recette, $Recettes);

              $index++;
            }
          }
        ?>

      </div>

    </main>
    <?php } else { ?><main>
      <p>
        Une erreur est survenue lors de la recherche de votre aliment. Retour vers la <a href="./index.php?page=navigation">page de navigation</a>.
      </p>
    </main>
    <?php } ?>

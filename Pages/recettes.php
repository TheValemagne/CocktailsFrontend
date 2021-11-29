    <main>
      <h1>Recettes préférées</h1>

      <?php
        if(isset($_SESSION["recettes"]) && sizeof($_SESSION["recettes"]) > 0){ // affiche une liste de cartes de cocktails préférés
          $index = 0;

          echo '<div class="card-deck">'."\n";

          foreach ($_SESSION["recettes"] as $indice_recette) {
            if($index > 0){ // indentation du code
              echo "\t\t";
            }

            echo creerCarte($Recettes[$indice_recette], $Recettes); // la carte du cocktail

            $index++;
          }

          echo "
      </div>\n";

    } else { // aucune recette préférée ?><p>Aucune recette préférée pour l'instant</p>
<?php } ?>

    </main>

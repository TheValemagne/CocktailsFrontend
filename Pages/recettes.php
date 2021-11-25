    <main>
      <h1>Recettes préférées</h1>

      <?php
        if(isset($_SESSION["recettes"])){
          $index = 0;

          echo '<div class="card-deck">'."\n";

          foreach ($_SESSION["recettes"] as $indice_recette) {
            if($index > 0){ // indentation du code
              echo "\t\t";
            }

            echo creerCarte($Recettes[$indice_recette], $Recettes);

            $index++;
          }

          echo "
      </div>\n";

        } else { ?><p>Aucune recette préférée pour l'instant</p>
<?php } ?>

    </main>

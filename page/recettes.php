    <main>
      <h1>Recettes préférées</h1>

      <ul>
        <?php
          if(isset($_SESSION["recettes"])){
            $index = 0;

            foreach ($_SESSION["recettes"] as $indice_recette) { // TODO: ajout de favorie en stockant l'indice de la recette
              if($index > 0){ // indentation du code
                echo "\t\t";
              }

              echo '<li><a href="index.php?page=recette&recette='.$indice_recette.'">'.$Recettes[$indice_recette]["titre"]."</a></li>\n";
              $index++;
            }
          } else { ?><li>Auncune recette préférée pour l'instant</li>
<?php } ?>
      </ul>

    </main>

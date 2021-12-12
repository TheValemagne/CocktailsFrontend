    <main>
      <h1>Résultat de recherche</h1>
      <?php

      if (isset($_POST['requette'])) {
          try {
              $split = splitRequete($_POST['requette']); // séparation des éléments en deux listes, ingrédients souhaités et non souhaités

              $alimentsSouhaites = []; // les ingrédients souhaités
              $alimentsNonSouhaites = []; // les ingrédients non souhaités
              $nonReconnus = []; // les ingrédient non reconnus/ inexistant dans la base de données

              foreach ($split['contains'] as $itemSouhaite) { // pourcours des ingrédients souhaités
                  if (findInData($itemSouhaite, $Hierarchie)) {
                      $alimentsSouhaites[] = $itemSouhaite;
                  } else { // ingrédient non reconnu
                      $nonReconnus[] = $itemSouhaite;
                  }
              }
              foreach ($split['notContains'] as $itemNonSouhaite) { // pourcours des ingrédients non souhaités
                  if (findInData($itemNonSouhaite, $Hierarchie)) {
                      $alimentsNonSouhaites[] = $itemNonSouhaite;
                  } else { // ingrédient non reconnu
                      $nonReconnus[] = $itemNonSouhaite;
                  }
              }

              if (!empty($alimentsSouhaites)) {
                  echo "
      <p>Liste des aliments souhaités : " . implode(', ', $alimentsSouhaites) . "</p>\n";
              }
              if (!empty($alimentsNonSouhaites)) {
                  echo "
      <p>Liste des aliments non souhaités : " . implode(', ', $alimentsNonSouhaites) . "</p>\n";
              }
              if (!empty($nonReconnus)) {
                  echo "
      <p>Éléments non reconnus dans la requête : " . implode(', ', $nonReconnus) . "</p>\n";
              }

              if (empty($alimentsSouhaites) && empty($alimentsNonSouhaites)) { // cas où aucun ingrédients est reconnus ou aucun paramètre de recherche
                  echo "
      <p>Problème dans votre requête : recherche impossible</p>\n";
              } else { // recherche des recettes respectant la demande du client
                  $resultats_recherche = findRecipes($alimentsSouhaites, $alimentsNonSouhaites, $Hierarchie, $Recettes);
                  $currentScore = $resultats_recherche[0]["satisfaction"];

                  echo "
      <h2>Satisfaction: $currentScore %</h2>
      <div class=\"card-deck\">\n";

                  foreach($resultats_recherche as $index => $resultat){
                      $satisfaction = $resultat["satisfaction"];
                      $recette = $resultat["recette"];
                      if(!isset($currentScore) || $satisfaction != $currentScore){
                          echo "
      </div>

      <br />
      <h2>Satisfaction: $satisfaction %</h2>
      <div class=\"card-deck\">\n";
                          $currentScore = $satisfaction;
                      }
                      echo creerCarte($recette, $Recettes);
                  }

                  echo "
      </div>\n";
              }

          } catch (Exception $exception) {
              echo $exception->getMessage();
          }

      } else {
        echo "<p>Recherche vide</p>\n";
      }

      ?>

    </main>

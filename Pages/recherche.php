    <main>
      <h1>Résultat de recherche</h1>
      <?php

      if (isset($_POST['requette'])) {
          try {
              $split = splitSearchString($_POST['requette']); // séparation des éléments en deux listes, ingrédients souhaités et non souhaités

              $wanted = []; // les ingrédients souhaités
              $unwanted = []; // les ingrédients non souhaités
              $notRecognized = []; // les ingrédient non reconnus/ inexistant dans la base de données

              foreach ($split['contains'] as $wantedItem) { // pourcours des ingrédients souhaités
                  if (findInData($wantedItem, $Hierarchie)) {
                      $wanted[] = $wantedItem;
                  } else { // ingrédient non reconnu
                      $notRecognized[] = $wantedItem;
                  }
              }
              foreach ($split['notContains'] as $unwantedItem) { // pourcours des ingrédients non souhaités
                  if (findInData($unwantedItem, $Hierarchie)) {
                      $unwanted[] = $unwantedItem;
                  } else { // ingrédient non reconnu
                      $notRecognized[] = $unwantedItem;
                  }
              }

              if (!empty($wanted)) {
                  echo "
      <p>Liste des aliments souhaités : " . implode(', ', $wanted) . "</p>\n";
              }
              if (!empty($unwanted)) {
                  echo "
      <p>Liste des aliments non souhaités : " . implode(', ', $unwanted) . "</p>\n";
              }
              if (!empty($notRecognized)) {
                  echo "
      <p>Éléments non reconnus dans la requête : " . implode(', ', $notRecognized) . "</p>\n";
              }

              if (empty($wanted) && empty($unwanted)) { // cas où aucun ingrédients est reconnus ou aucun paramètre de recherche
                  echo "
      <p>Problème dans votre requête : recherche impossible</p>\n";
              } else { // recherche des recettes respectant la demande du client
                  $resultats_recherche = findRecipies($wanted, $unwanted, $Hierarchie, $Recettes);
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

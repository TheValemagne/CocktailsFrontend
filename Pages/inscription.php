    <main>
      <h1>Formulaire d'inscription</h1>

<?php if(sizeof($erreurs_inscription) > 0 || !isset($_POST["inscription"])) {
    // TODO: modifier la class error pour mettre en rouge les bordures ou un effet meilleur qu'un backgroud: red
    // TODO: focus d'un input avec une couleur grise + inputs alignés
    include("Pages/formulaire.inc.php");

} else { // inscription réussie ?>
      <p>
        Félicitation, vous vous êtes bien inscrit!
      </p>

      <?php
        $donnee_utilisateurs = json_decode(file_get_contents("user.json"), true);

        foreach ($donnees_valides as $donnee) { // tous les champs valides seront sauvegardé dans la base de données json
          $donnee_utilisateurs[$_POST["login"]][$donnee] = trim($_POST[$donnee]);
        }

        if(isset($_SESSION["recettes"])){ // intègre les recettes préférées ajoutées avant l'inscription
            $donnee_utilisateurs[$_POST["login"]]["recettes"] = $_SESSION["recettes"];
        }

        ksort($donnee_utilisateurs);
        file_put_contents("user.json", json_encode($donnee_utilisateurs, JSON_PRETTY_PRINT));
      ?>
    <?php } ?>

      <?php if(sizeof($erreurs_inscription) > 0) { // erreurs lors de l'inscription ?><p>
        Veuillez compléter correctement les champs suivants :
      </p>

      <ul>
        <?php
          $index = 0;

          foreach ($erreurs_messages as $champ) { // affichage des messages d'erreurs à l'utilisateur
            if($index > 0){ // indentation du code
              echo "\t\t";
            }
            echo "<li>$champ</li>\n";
            $index++;
          }
        ?>
      </ul><?php } ?>

    </main>

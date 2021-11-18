    <main>
      <h1>Mon compte</h1>

<?php
  if(isset($_SESSION["login"]) && !isset($_POST["modifier"])){
    // remplie le formulaire avec les informations actuelles du client enregistrée dans la base de donnée lors du premier chargement
    foreach ($_SESSION as $donnee_utilisateur => $contenue_donnee) {
      $_POST[$donnee_utilisateur] = $contenue_donnee;
    }
  }

  if(isset($_SESSION['login'])){ // enregistre le login pour chaque rechargement. Disable ne rcupère pas la value.
    $_POST['login'] = $_SESSION['login'];
  }

  include("Pages/formulaire.inc.php");

if(sizeof($erreurs_inscription) == 0 && sizeof($donnees_valides) > 0 && isset($_POST["modifier"])) { ?>
      <p>
        Données enregistrées!
      </p>
    <?php } ?>

    </main>

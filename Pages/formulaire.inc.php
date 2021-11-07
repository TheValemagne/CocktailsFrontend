<?php // changement de mise en forme en fonction de la page actuelle
if(isset($_GET['page']) && $_GET['page'] == "inscription"){ // inscription, le login doit être saisie
  $option = 'required="required"';
  $nom_submit = "inscription";
  $valeur_submit = "S'inscrire";
} else if (isset($_GET['page']) && $_GET['page'] == "monProfil"){ // modification compte, le login ne peut pas être changé
  $option = 'disabled="disabled"';
  $nom_submit = "modifier";
  $valeur_submit = "modifier";
}
?>
      <form action="#" method="post">

        <fieldset>
          <legend>Connexion</legend>
          <label for="login">Login :</label>
            <input type="text" <?php if(in_array("login", $erreurs_inscription)) { echo 'class="error"'; } ?> name="login" id="login" value="<?php if(isset($_POST["login"])) {echo $_POST["login"]; }; ?>" <?php echo $option; ?> /> <?php echo ($option == 'required="required"') ? "*\n" : "\n" ?>
            <?php if(isset($_GET['page']) && $_GET['page'] == "monProfil") { // récupérer le login quand il est disable ?><input type="text" name="login" id="login" value="<?php if(isset($_POST["login"])) {echo $_POST["login"]; }; ?>" hidden="hidden" />
          <?php } ?><br />
          <label for="password">Mot de passe :</label>
            <input type="password" <?php if(in_array("password",$erreurs_inscription)) { echo 'class="error"'; } ?> name="password" id="password" value="<?php if(isset($_POST["password"])) { echo $_POST["password"]; }; ?>" required="required" /> *
          <br />
        </fieldset>

        <fieldset>
          <legend>Informations personnelles</legend>

          <label for="nom">Nom : </label>
            <input type="text" <?php if(in_array("nom", $erreurs_inscription)) { echo 'class="error"'; } ?> name="nom" id="nom" value="<?php if(isset($_POST["nom"])) { echo $_POST["nom"]; }; ?>" />
          <br />
          <label for="prenom">Prénom : </label>
            <input type="text" <?php if(in_array("prenom", $erreurs_inscription)) { echo 'class="error"'; } ?> name="prenom" id="prenom" value="<?php if(isset($_POST["prenom"])) { echo $_POST["prenom"]; }; ?>" />
          <br />
          <label for="sexe">Vous êtes : </label>
            <span <?php if(in_array("sexe", $erreurs_inscription)) { echo 'class="error"'; } ?> >
              <input type="radio" name="sexe" id="sexe" value="f" <?php if(isset($_POST['sexe']) && $_POST['sexe'] == 'f') { echo 'checked ="checked"'; }; ?> /> une femme
            </span>
            <span <?php if(in_array("sexe", $erreurs_inscription)) { echo 'class="error"'; } ?> >
              <input type="radio" name="sexe" value="h" <?php if(isset($_POST['sexe']) && $_POST['sexe'] == 'h') { echo 'checked ="checked"'; }; ?> /> un homme
            </span>
          <br />
          <label for="mail">Adresse mail : </label>
            <input type="text" <?php if(in_array("mail", $erreurs_inscription)) { echo 'class="error"'; } ?> name="mail" id="mail" value="<?php if(isset($_POST['mail'])) {echo $_POST['mail']; }; ?>" />
          <br />
          <label for="naissance">Date de naissance : </label>
           <input type="date" <?php if(in_array("naissance", $erreurs_inscription)) { echo 'class="error"'; } ?> name="naissance" id="naissance" value="<?php if(isset($_POST['naissance'])) {echo $_POST['naissance']; }; ?>" /> (jj/mm/aaaa)
          <br />
          <label for="adresse">Adresse : </label>
            <input type="text" <?php if(in_array("adresse", $erreurs_inscription)) { echo 'class="error"'; } ?> name="adresse" id="adresse" value="<?php if(isset($_POST['adresse'])) {echo $_POST['adresse']; }; ?>" />
          <br />
          <label for="code_postal">Code postal : </label>
            <input type="text" <?php if(in_array("code_postal", $erreurs_inscription)) { echo 'class="error"'; } ?> name="code_postal" id="code_postal" value="<?php if(isset($_POST['code_postal'])) {echo $_POST['code_postal']; }; ?>" />
          <br />
          <label for="ville">Ville :</label>
            <input type="text" <?php if(in_array("ville", $erreurs_inscription)) { echo 'class="error"'; } ?> name="ville" id="ville" value="<?php if(isset($_POST['ville'])) {echo $_POST['ville']; }; ?>" />
          <br />
          <label for="telephone">Numéro de téléphone : </label>
            <input type="text" <?php if(in_array("telephone", $erreurs_inscription)) { echo 'class="error"'; } ?> name="telephone" id="telephone" value="<?php if(isset($_POST['telephone'])) {echo $_POST['telephone']; }; ?>" />
        </fieldset>
        <br />

        <input type="submit" name="<?php echo $nom_submit ?>" value="<?php echo $valeur_submit ?>" />

      </form>

      <p>
        Les champs marqués avec un * sont obligatoires.
      </p>

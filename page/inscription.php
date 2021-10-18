    <main>
      <h1>Formulaire d'inscription</h1>

      <form action="#" method="post">

        <fieldset>
          <legend>Connexion</legend>
          <label for="login">Login :</label>
            <input type="text" <?php if(in_array("login", $errors)) { echo 'class="error"'; } ?> name="login" id="login" value="<?php if(isset($_POST["login"])) {echo $_POST["login"]; }; ?>"  required="required" /> *
          <br />
          <label for="password">Mot de passe :</label>
            <input type="password" <?php if(in_array("password", $errors)) { echo 'class="error"'; } ?> name="password" id="password" value="<?php if(isset($_POST["password"])) { echo $_POST["password"]; }; ?>" required="required" /> *
          <br />
        </fieldset>

        <fieldset>
          <legend>Informations personnelles</legend>

          <label for="nom">Nom : </label>
            <input type="text" <?php if(in_array("nom", $errors)) { echo 'class="error"'; } ?> name="nom" id="nom" value="<?php if(isset($_POST["nom"])) { echo $_POST["nom"]; }; ?>" />
          <br />
          <label for="prenom">Prénom : </label>
            <input type="test" <?php if(in_array("prenom", $errors)) { echo 'class="error"'; } ?> name="prenom" id="prenom" value="<?php if(isset($_POST["prenom"])) { echo $_POST["prenom"]; }; ?>" />
          <br />
          <label for="sexe">Vous êtes : </label>
            <span <?php if(in_array("sexe", $errors)) { echo 'class="error"'; } ?> >
              <input type="radio" name="sexe" id="sexe" value="f" <?php if(isset($_POST['sexe']) && $_POST['sexe'] == 'f') { echo 'checked ="checked"'; }; ?> /> une femme
            </span>
            <span <?php if(in_array("sexe", $errors)) { echo 'class="error"'; } ?> >
              <input type="radio" name="sexe" value="h" <?php if(isset($_POST['sexe']) && $_POST['sexe'] == 'h') { echo 'checked ="checked"'; }; ?> /> un homme
            </span>
        	<br />
          <label for="mail">Adresse mail : </label>
            <input type="text" <?php if(in_array("mail", $errors)) { echo 'class="error"'; } ?> name="mail" id="mail" value="<?php if(isset($_POST['mail'])) {echo $_POST['mail']; }; ?>" />
          <br />
          <label for="naissance">Date de naissance : </label>
        	 <input type="date" <?php if(in_array("naissance", $errors)) { echo 'class="error"'; } ?> name="naissance" id="naissance" value="<?php if(isset($_POST['naissance'])) {echo $_POST['naissance']; }; ?>" /> (jj/mm/aaaa)
          <br />
          <label for="adresse">Adresse : </label>
            <input type="text" <?php if(in_array("adresse", $errors)) { echo 'class="error"'; } ?> name="adresse" id="adresse" value="<?php if(isset($_POST['adresse'])) {echo $_POST['adresse']; }; ?>" />
          <br />
          <label for="code postal">Code postal : </label>
            <input type="text" <?php if(in_array("code postal", $errors)) { echo 'class="error"'; } ?> name="code_postal" id="code postal" value="<?php if(isset($_POST['code_postal'])) {echo $_POST['code_postal']; }; ?>" />
          <br />
          <label for="ville">Ville :</label>
            <input type="text" <?php if(in_array("ville", $errors)) { echo 'class="error"'; } ?> name="ville" id="ville" value="<?php if(isset($_POST['ville'])) {echo $_POST['ville']; }; ?>" />
          <br />
          <label for="telephone">Numéro de téléphone : </label>
            <input type="text" <?php if(in_array("telephone", $errors)) { echo 'class="error"'; } ?> name="telephone" id="telephone" value="<?php if(isset($_POST['telephone'])) {echo $_POST['telephone']; }; ?>" />
        </fieldset>

        <br />
        <input type="submit" name="inscription" value="S'inscrire" />

      </form>
    </main>

<?php if($authentifie) { // le client est connecté et authentifié ?><ul>
            <li><?php
            if(isset($_SESSION["nom"]) && isset($_SESSION["prenom"]) ){ // client connecte avec nom et prenom connus
              echo $_SESSION["nom"]." ".$_SESSION["prenom"];
            } else if(isset($_SESSION["login"])){ // sinon afficher le login
              echo $_SESSION["login"];
            } ?></li>
            <li><a href="index.php?page=monProfil" class="btn btn-outline-dark" >Profil</a></li>
            <li>
              <form action="#" method="post" name="login">
                <input type="submit" name="deconnexion" value="Se déconnecter" class="btn btn-outline-dark" />
              </form>
            </li>
          </ul>
<?php } else { // le client n'est pas connecté ?><form action="#" method="post">
            Login <input type="text" name="login" value="<?php isset($_POST["login"]) ? $_POST['login'] : ""; ?>" />
            Mot de passe <input type="password" name="password" value="<?php isset($_POST["password"]) ? $_POST['password'] : ""; ?>" />
            <input type="submit" name="connexion" value="Se connecter" class="btn btn-outline-dark" />
            <a href="index.php?page=inscription" class="btn btn-outline-dark" >S'inscrire</a>
          </form>

          <div><?php echo (isset($_POST['connexion']) && !$authentifie) ? "Login ou mot de passe invalide" : ""; ?></div>
<?php } ?>

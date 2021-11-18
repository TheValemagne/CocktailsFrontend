<?php if($authentifie) { ?><ul>
            <li><?php
            if(isset($_SESSION["nom"]) && isset($_SESSION["prenom"]) ){ // client connecte avec nom et prenom connus
              echo $_SESSION["nom"]." ".$_SESSION["prenom"];
            } else if(isset($_SESSION["login"])){ // sinon afficher le login
              echo $_SESSION["login"];
            } ?></li>
            <li><a href="index.php?page=monProfil">Profil</a></li>
            <li>
              <form action="#" method="post" name="login">
                <input type="submit" name="deconnection" value="Déconnection" />
              </form>
            </li>
          </ul>
<?php } else { ?><form action="#" method="post">
            Login <input type="text" name="login" value="<?php isset($_POST["login"]) ? $_POST['login'] : ""; ?>" />
            Mot de passe <input type="password" name="password" value="<?php isset($_POST["password"]) ? $_POST['password'] : ""; ?>" />
            <input type="submit" value="Se connecter" name="connection" />
            <a href="index.php?page=inscription">S'inscrire</a>
          </form>

          <div><?php echo (isset($_POST['connection']) && !$authentifie) ? "Login ou mot de passe invalide" : ""; ?></div>
<?php } ?>

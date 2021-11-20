<?php
if(isset($_POST["deconnexion"])){ // demande de deconnexion du compte actuel
  $_SESSION = array(); // vide le tableau de session
  session_destroy(); // arrête la session en cours
  header("Location: ./index.php"); // redirection vers la page d'acceuil
  exit;
}
?>

<?php
$errors =  array();
$search =  array('é', 'è', 'ä', 'â', "ç", "ï", "î", "û", "ü", "-", "'", " ");
$replace = array('e', 'e', 'a', 'a', "c", "i", "i", "u", "u",  "",  "",  "");

if(isset($_POST["inscription"])){ // verification du formulaire d'inscription
  if(!isset($_POST["login"]) || empty($_POST["login"])){
    array_push($errors, "login");
  }

  if(!isset($_POST["password"]) || empty($_POST["password"])){
    array_push($errors, "password");
  }

  if(isset($_POST["nom"])) { // TODO login unique
    $nom = str_replace($search, $replace, strtolower(trim($_POST['nom'])));

    if(strlen($nom) < 2 || !ctype_alpha($nom)){
      array_push($errors, "nom");
    }
  } else {
    array_push($errors, "nom");
  }

  if(isset($_POST["prenom"]) ) {
    $prenom = str_replace($search, $replace, strtolower(trim($_POST['prenom'])));

    if(strlen($prenom) < 2 || !ctype_alpha($prenom) ){
      array_push($errors, "prenom");
    }
  } else {
    array_push($errors, "prenom");
  }

  if(!isset($_POST["sexe"]) || !in_array($_POST["sexe"], array('f', 'h')) ){
    array_push($errors, "sexe");
  }

  if(!isset($_POST["mail"]) || !filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL) ){
    array_push($errors, "adresse mail");
  }

  if (!isset($_POST["naissance"]) || $_POST["naissance"] == "") {
    array_push($errors, "date de naissance");
  } else {
    if(preg_match('#([0-9]{1,2})/([0-9]{1,2})/([0-9]{4})#', $_POST["naissance"]) ){ // input type date non supporté
      list($jour, $mois, $annee) = explode( "/", trim($_POST["naissance"])); // jj/mm/aaaa
    } else {
      list($annee, $mois, $jour) = explode( "-", $_POST["naissance"]); // yyyy-mm-dd
    }

    if(!checkdate($mois, $jour, $annee)){
      array_push($errors, "date de naissance");
    }
  }

  if(!isset($_POST["adresse"])){ // TODO ajouter des tests
    array_push($errors, "adresse");
  }

  if(!isset($_POST["code_postal"]) || strlen(str_replace(array(" "), array(""), trim($_POST["code_postal"]))) != 5){
    array_push($errors, "code postal");
  }

  if(isset($_POST["ville"])){
    $ville = str_replace($search, $replace, strtolower(trim($_POST['ville'])));

    if(strlen($ville) < 2 || !ctype_alpha($ville) ){
      array_push($errors, "ville");
    }

  } else {
    array_push($errors, "ville");
  }

  if(isset($_POST["telephone"])){
    $telephone = filter_var($_POST["telephone"], FILTER_SANITIZE_NUMBER_INT);
    $telephone = str_replace(array("+", "-", " "), array("", "", ""), $telephone);

    if(!ctype_digit($telephone)){
      array_push($errors, "telephone");
    }
  } else {
    array_push($errors, "telephone");
  }
}
?>

<?php
// fonctions pour le site web

// remplace les espages en _ -> revoie un paramètre d'url valide
function strToUrl($input){
  return str_replace(" ", "_", $input);
}

// remplace les _ en espace -> convertie lesparamètre d'url pour retrouver l'aliment ou la recette dans la base de donnée
function urlToStr($input){
  return str_replace("_", " ", $input);
}

?>

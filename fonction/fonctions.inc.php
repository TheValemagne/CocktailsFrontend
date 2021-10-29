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

// retourne une liste avec tous les ingrédients de la catégorie correspondante
function getIngredientsList($ingredient, $Hierarchie){
  $ingredient_list = array();

  if(!isset($Hierarchie[$ingredient])){
    return $ingredient_list;
  }

  if(isset($Hierarchie[$ingredient]['sous-categorie']) ){
    foreach ($Hierarchie[$ingredient]['sous-categorie'] as $sous_gategorie) {
      $ingredient_list = array_merge($ingredient_list, getIngredientsList($sous_gategorie, $Hierarchie));
    }
  } else {
    array_push($ingredient_list, $ingredient);
  }

  return $ingredient_list;
}

?>

<?php // fonctions pour le site web

// remplace les espages en _ -> revoie un paramètre d'url valide
function strToUrl($input){
  return str_replace(" ", "_", $input);
}

// remplace les _ en espace -> convertie lesparamètre d'url pour retrouver l'aliment ou la recette dans la base de donnée
function urlToStr($input){
  return str_replace("_", " ", $input);
}

// transforme le fil d'Ariane de type chaine de caractère en tableau
function getFilAliments($fil_aliments){
  return preg_split('#-#', $fil_aliments);
}

// définie le fil d'Ariane en fonction du tableau donné en entrée
function setFilAliments($tableau_aliments){
  return implode("-", $tableau_aliments);
}

// retourne le nom de l'image correspondant au titre du cocktail ou l'image par défaux si aucune image est assocssiée au cocktail
function getImageSrc($titre_cocktail){
  $search =  array('é', 'è', 'ä', 'â', "ç", "ï", "î", "û", "ü", "ñ", "-", "'");
  $replace = array('e', 'e', 'a', 'a', "c", "i", "i", "u", "u",  "n", "",  "");

  $nom_cocktail = str_replace($search, $replace, strtolower($titre_cocktail)); // enlève les accents et espace du nom
  $image = "./Photos/".ucwords(strToUrl($nom_cocktail)).".jpg";

  return file_exists($image) ? $image : "./Photos/cocktail.png"; // image existe sinon image par défaux
}

// retourne une liste avec tous les ingrédients de la catégorie correspondante
function getIngredientsList($ingredient, $Hierarchie){
  if(!isset($Hierarchie[$ingredient])){ // ingrédient inexistant, retourne un tableau vide
    return array();
  }

  $liste_ingredients = array($ingredient); // liste des aliments appartenant à ingredient(inclus)

  if(isset($Hierarchie[$ingredient]['sous-categorie']) ){ // cherche les éléments enfants
    foreach ($Hierarchie[$ingredient]['sous-categorie'] as $sous_gategorie) {
      // ajoute les éléments enfants des sous-gategories
      $liste_ingredients = array_unique(array_merge($liste_ingredients, getIngredientsList($sous_gategorie, $Hierarchie)));
    }
  }

  sort($liste_ingredients); // trie la liste
  return $liste_ingredients;
}

?>

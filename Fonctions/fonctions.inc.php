<?php // fonctions pour le site web

// remplace les espages en _ -> revoie un paramètre d'url valide
function strToUrl($input)
{
    return str_replace(" ", "_", $input);
}

// remplace les _ en espace -> convertie lesparamètre d'url pour retrouver l'aliment ou la recette dans la base de donnée
function urlToStr($input)
{
    return str_replace("_", " ", $input);
}

// transforme le fil d'Ariane de type chaine de caractère en tableau
function getFilAliments($fil_aliments)
{
    return preg_split('#-#', $fil_aliments);
}

// définie le fil d'Ariane en fonction du tableau donné en entrée
function setFilAliments($tableau_aliments)
{
    return implode("-", $tableau_aliments);
}

// vérifie que le fil d'Ariane soit valide
function checkFilAliments($tableau_aliments, $hierarchie)
{
    if (sizeof($tableau_aliments) === 0) {
        return true;
    }

    $super_categorie = urlToStr($tableau_aliments[0]);

    if (!isset($hierarchie[$super_categorie])) {
        return false;
    }

    for ($i = 1; $i < (sizeof($tableau_aliments)); $i++) {
        $sous_categorie = urlToStr($tableau_aliments[$i]);

        if (!in_array($sous_categorie, $hierarchie[$super_categorie]["sous-categorie"])) {
            return false;
        }

        $super_categorie = $sous_categorie;
    }

    return true;
}

// retourne le nom de l'image correspondant au titre du cocktail ou l'image par défaux si aucune image est assocssiée au cocktail
function getImageSrc($titre_cocktail)
{
    $search = array('é', 'è', 'ä', 'â', "ç", "ï", "î", "û", "ü", "ñ", "-", "'");
    $replace = array('e', 'e', 'a', 'a', "c", "i", "i", "u", "u", "n", "", "");

    $nom_cocktail = str_replace($search, $replace, strtolower($titre_cocktail)); // enlève les accents et espace du nom
    $image = "./Photos/" . ucwords(strToUrl($nom_cocktail)) . ".jpg";

    return file_exists($image) ? $image : "./Photos/cocktail.png"; // image existe sinon image par défaux
}

// retourne une liste avec tous les ingrédients de la catégorie correspondante
function getIngredientsList($ingredient, $Hierarchie)
{
    if (!isset($Hierarchie[$ingredient])) { // ingrédient inexistant, retourne un tableau vide
        return array();
    }

    $liste_ingredients = array($ingredient); // liste des aliments appartenant à ingredient(inclus)

    if (isset($Hierarchie[$ingredient]['sous-categorie'])) { // cherche les éléments enfants
        foreach ($Hierarchie[$ingredient]['sous-categorie'] as $sous_gategorie) {
            // ajoute les éléments enfants des sous-gategories
            $liste_ingredients = array_unique(array_merge($liste_ingredients, getIngredientsList($sous_gategorie, $Hierarchie)));
        }
    }

    sort($liste_ingredients); // trie la liste
    return $liste_ingredients;
}

/**
 * Splits the search string into the wanted and unwanted ingredients
 * @return array ['contains'=> [ingredients], 'notContains'=>[ingredients]]
 * @throws Exception if the search string is invalid
 */
function splitSearchString(string $search): array
{
    if (empty($search)) {
        throw new Exception("Recherche vide");
    }

    if (substr_count($search, '"') % 2 != 0) {
        throw new Exception("Nombre impaire de quotes");
    }


    $regExQuotes = "#([+-]?\"[^\"]+\")#";
    preg_match_all($regExQuotes, $search, $matches);

    $quotedMatches = [];
    if (isset($matches[1])) {
        $quotedMatches = filterMatches($matches[1]);
    }


    $filtered = preg_replace($regExQuotes, "", $search);
    $spaceMatches = filterMatches(explode(" ", $filtered));


    $contains = array_merge($quotedMatches['contains'], $spaceMatches['contains']);
    $notContains = array_merge($quotedMatches['notContains'], $spaceMatches['notContains']);

    return [
        'contains' => $contains,
        'notContains' => $notContains
    ];
}

/**
 * helper method for splitting the search string into wanted and unwanted ingredients
 * @return array|array[] ['contains'=> [ingredients], 'notContains'=>[ingredients]]
 */
function filterMatches(array $matches): array
{
    $result = [
        'contains' => [],
        'notContains' => []
    ];

    foreach ($matches as $match) {
        $match = str_replace('"', '', $match);

        if (strlen($match) == 0) {
            continue;
        }

        if (strpos($match, "-") === 0) {
            $result['notContains'][] = substr($match, 1);
        } elseif (strpos($match, "+") === 0) {
            $result['contains'][] = substr($match, 1);
        } else {
            $result['contains'][] = $match;
        }
    }

    return $result;
}

/**
 * @return bool returns true if the item is in the ingredient hierarchy
 */
function findInData($item, $hierarchy)
{
    return in_array($item, array_keys($hierarchy));
}

/**
 * @return array an array of recipes that satisfy at least one of the search criteria. Sorted by satisfaction score (in percent) in descending order
 */
function findRecipies($wanted, $unwanted, $hierarchy, $recipes)
{
    $recipesSatisfyCriteria = [];
    foreach ($recipes as $recipe) {
        $satisfaction = calculateRecipeSatisfaction($recipe, $hierarchy, $wanted, $unwanted);

        if ($satisfaction > 0) {
            $recipesSatisfyCriteria[] = [$satisfaction, $recipe];
        }
    }

    krsort($recipesSatisfyCriteria);
    return $recipesSatisfyCriteria;
}

/**
 * @return float|int the satisfaction score in percent (0-100)
 */
function calculateRecipeSatisfaction($recipe, $hierarchy, $wanted, $unwanted)
{
    $satisfiedCriteria = 0;
    $ingredients = $recipe['index'];
    foreach ($wanted as $wantedIngredient) {
        $completeWanted = getIngredientsList($wantedIngredient, $hierarchy);

        foreach ($ingredients as $ingredient) {
            if (in_array($ingredient, $completeWanted)) {
                $satisfiedCriteria++;
                break;
            }
        }
    }

    foreach ($unwanted as $unwantedIngredient) {
        $completeUnwanted = getIngredientsList($unwantedIngredient, $hierarchy);

        foreach ($ingredients as $ingredient) {
            if (!in_array($ingredient, $completeUnwanted)) {
                $satisfiedCriteria++;
                break;
            }
        }
    }

    return (int)($satisfiedCriteria / (count($wanted) + count($unwanted)) * 100);
}

function createCard($recette, $Recettes)
{
    $indice_recette = array_search($recette["titre"], array_column($Recettes, 'titre'));
    $image = getImageSrc($Recettes[$indice_recette]['titre']);

    $format = '<div class="card" style="width: 18rem;">
    <img class="card-img-top" src="' . $image . '" alt="Recette numéro ' . $indice_recette . '">
    <div class="card-body">
      <h5 class="card-title"><a href="index.php?page=recette&recette=' . $indice_recette . '">' . $recette["titre"] . '</a></h5>
      <ul>';

    foreach ($recette["index"] as $ingredient) {
        $format .= '<li>' . $ingredient . '</li>';
    }

    $format .= '</ul>
    </div>
  </div>';

    return $format;
}

?>

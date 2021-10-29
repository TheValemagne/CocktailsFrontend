<?php
  $search =  array('é', 'è', 'ä', 'â', "ç", "ï", "î", "û", "ü", "ñ", "-", "'");
  $replace = array('e', 'e', 'a', 'a', "c", "i", "i", "u", "u",  "n", "",  "");
 ?>
    <main>
<?php if(!isset($_GET["recette"]) || !isset($Recettes[$_GET["recette"]])) { ?><p>
      Recette inexistante! Veuillez retourner à la liste des <a href="index.php?page=navigation">recettes</a>.
    </p>
<?php } else { ?>
      <h1><?php echo $Recettes[$_GET["recette"]]['titre'] ?></h1>

<?php // TODO: ajouter le coeur pour favorie ou non
  $nom_cocktail = str_replace($search, $replace, strtolower($Recettes[$_GET["recette"]]['titre'])); // formater le nom de la recette pour trouver l'image
  $image = "./Photos/".ucwords(strToUrl($nom_cocktail)).".jpg";
  $image = file_exists($image) ? $image : "./Photos/cocktail.png"; // image existe ou non
?>
      <img alt="<?php echo 'image recette n°'.$_GET["recette"] ?>" src="<?php echo $image ?>">


      <h2>préparation :</h2>

      <p><?php echo $Recettes[$_GET["recette"]]['preparation'] ?></p>

      <h2>Ingrédients :</h2>

      <ul>
        <?php
        $index = 0;

        foreach (preg_split('#\|#', $Recettes[$_GET["recette"]]['ingredients']) as $ingredient) { // liste des ingrédients avec quantitée
          if($index > 0){ // indentation du code
            echo "\t\t";
          }
          echo "<li>$ingredient</li>\n";
          $index++;
        }
        ?>
      </ul>
<?php } ?>
    </main>

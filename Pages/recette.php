    <main>
<?php if(!isset($_GET["recette"]) || !isset($Recettes[$_GET["recette"]])) { // erreur la recette n'existe pas ?><p>
      Recette inexistante! Veuillez retourner à la liste des <a href="index.php?page=navigation">recettes</a>.
    </p>
<?php } else { // la recette existante dans la base de donnée ?>
      <h1><?php echo $Recettes[$_GET["recette"]]['titre'] ?></h1>

      <div class="svg-recette"><?php echo getCoeurRecette($_GET["recette"], 2) // le coeur pour recette préférée ou non ?>

      </div>

      <img alt="<?php echo 'image recette n°'.$_GET["recette"] ?>" src="<?php echo getImageSrc($Recettes[$_GET["recette"]]['titre']) ?>">

      <h2>préparation :</h2>

      <p><?php echo $Recettes[$_GET["recette"]]['preparation'] ?></p>

      <h2>Ingrédients :</h2>

      <ul>
        <?php // liste des ingrédients avec détail (quantitié, unité)
        $index = 0;

        foreach (preg_split('#\|#', $Recettes[$_GET["recette"]]['ingredients']) as $ingredient) {
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

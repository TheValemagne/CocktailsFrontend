  <?php
    if(isset($_GET["aliment"])) {
      $aliment = $_GET["aliment"];
    } else {
      $aliment = "Aliment";
    }
  ?>
  <nav>
    Aliment courant
    <br />
    <a href="index.php?page=navigation">Aliment</a>
    <br />

    <?php if(isset($Hierarchie[$aliment]) && isset($Hierarchie[$aliment]["sous-categorie"])){ ?>

    Sous-catégories :
    <ul>
      <?php
        $sous_gategories = $Hierarchie[$aliment]["sous-categorie"];

        foreach ($sous_gategories as $index => $sous_gategorie){
          echo "<li><a href=\"index.php?page=navigation&aliment=$sous_gategorie\">$sous_gategorie</a></li>\n";
        }
      ?>
    </ul>

    <?php } ?>
  </nav>

  <main>
    <p>
      Liste des cocktails

      <ul>
        <?php //TODO filtrer les recettes avec une fonction
        foreach ($Recettes as $recette) {
          echo "<li>".$recette["titre"]."</li>";
        } ?>
      </ul>
    </p>
  </main>

<main>
    <h1>Résultat de recherche</h1>

    <?php
    if (isset($_POST['requette'])) {
        try {
            $split = splitSearchString($_POST['requette']);
            print_r($split);
        } catch (Exception $exception) {
            echo $exception->getMessage();
        }

    }

    ?>
</main>

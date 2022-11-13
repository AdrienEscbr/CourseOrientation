<!DOCTYPE html>

<html lang="fr">

<head>
    <title> Test Recup </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>

    <?php

    //	   session_start();
    //	   session_destroy();
    $select='555';
    if (isset($_POST['ajouter'])) { // si bouton ok 
        if (!empty($_POST['box'])) {
            foreach ($_POST['box'] as $select) {
                echo $select;
                echo '<br>';
            }
        }
    }
    ?>


</body>

</html>
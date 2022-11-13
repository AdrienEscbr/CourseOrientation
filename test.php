<!DOCTYPE html>

<html lang="fr">

<head>
    <title> Test </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>

    <?php
    //	   session_start();
    //	   session_destroy();
    ?>

<form action="testRecup.php" method="post" name="ajouter">

    <input type="checkbox" value="1" name="box[]">Adrien</input>
    <br>
    <input type="checkbox" value="2" name="box[]">Sarah</input>
    <br>
    <input type="checkbox" value="3" name="box[]">Océane</input>
    <br>
    
    <input type="submit" name="ajouter" value="Ajouter"> 
    </form>

</body>

</html>
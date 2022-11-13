<!DOCTYPE html>

<!-- 
Author     : Océane.M
-->

<html>

<head>

    <meta charset="UTF-8">
    <link rel="stylesheet" href="../tableau.css" />
    <link rel="stylesheet" href="../reset.css" />
</head>

<body>
    <!-- Bouton Retour -->
    <from class="bouttonBack">
        <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
        <a href="http://localhost/CourseOrientation/prof/prof.php">
            <div id="btn"><span class="noselect">Retour</span>
                <div id="circle"></div>
            </div>
        </a>
    </from>
    <br><br>
    <br><br>
    <?php
    // Connexion BDD
    require_once '../connexionbdd.php';

    $vide = [];
    $classes = [];
    $req = "SELECT DISTINCT classe FROM eleve ORDER BY 'classe';";
    // echo $req ;
    if ($resultat = $bdd->query($req)) {
        while ($data = $resultat->fetch_assoc()) {
            if ($data['classe'] != $vide) {
                array_push($classes, $data['classe']);
            }
        }
    }

    ?>

    <!-- Liste de selection -->
    <form method='post' action="inscription.php">
        <h1> SELECTION DE LA CLASSE </h1>
        <br><br>
        <select name='classe[]' multiple size=10>
            <?php
            foreach ($classes as $classe) {
                echo " <option value = '$classe'>$classe</option> ";
            }
            ?>

        </select>
        <br><br>
        <input type='submit' name='submit' value=Choisir>
    </form>

</body>

</html>
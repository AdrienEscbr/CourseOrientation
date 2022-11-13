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
        <a href="http://localhost/CourseOrientation/admin/admin.php">
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
    <form method='post' action="adminEleve.php">
        <h4> SELECTION DE LA CLASSE </h4>
        <br><br>
        <select name='classe[]' multiple size=4>
            <?php
            foreach ($classes as $classe) {
                echo " <option value = '$classe'>$classe</option> ";
            }
            ?>

            <!-- <option value = "3A">3A</option> 
                <option value = "3B">3B</option> 
                <option value = "3C">3C</option> 
                <option value = "4A">4A</option> 
                <option value = "4B">4B</option> 
                <option value = "4C">4C</option>
                <option value = "5A">5A</option> 
                <option value = "5B">5B</option> 
                <option value = "5C">5C</option> 
                <option value = "6A">6A</option> 
                <option value = "6B">6B</option> 
                <option value = "6C">6C</option>  -->
                
        </select>
        <br><br>
        <input type='submit' name='submit' value=Choisir>
    </form>

</body>

</html>
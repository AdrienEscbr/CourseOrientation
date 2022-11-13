<!--
Created on : 16 oct. 2020, 12:05:07
    Author     : Océane.M
-->
<!DOCTYPE html>
<html lang='fr'>


<head>
    <title> Badge </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../tableau.css" />
</head>



<body>

    <!-- Bouton Retour -->
    <from class="bouttonBack">
        <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
        <a href="http://localhost/CourseOrientation/prof/ChoixClasse.php">
            <div id="btn"><span class="noselect">Retour</span>
                <div id="circle"></div>
            </div>
        </a>
    </from>

    <!-- DAte -->
    <div id="date"><strong> * Date de la course * </strong><br></br></div>

    <input type="datetime-local" id="date" name="date" value="0000-00-00T00:00" min="2021-16-03 00:00" max="2100-31-12 00:00" required>

    <br>
    <h1> Inscription des participants </h1>

    <!-- TABLEAU -->
    <table class="tableau-style">

        <thead>
            <tr>
                <th>Sélection</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Classe</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Connexion BDD
            require_once '../connexionbdd.php';

            $nbClasses = -1;
            $classes = [];

            // Check if any option is selected 
            if (isset($_POST["classe"])) {
                // Retrieving each selected option 
                foreach ($_POST['classe'] as $classe) {
                    //print " $classe <br/>";
                    array_push($classes, $classe);
                    $nbClasses++;       //print_r($classes); // $classe = "3A";
                    $requete = "SELECT * FROM eleve WHERE classe = ";

                    for ($ind = 0; $ind < $nbClasses; $ind++) {
                        $requete .= " \"$classes[$ind]\" or classe = ";
                    }
                    $requete .= " \"$classes[$nbClasses]\" ; ";
                }
            } else {
                echo " Choisi une classe !";
                $requete = "SELECT * FROM eleve WHERE id = '0' ";
            }
            ?>

            <form action="InscriptionParticipant.php" method="post" name="ajouter">

            <input type="text" name="nom" size="10" maxlength="50" value="---" required />
            <br>
            <input type="text" name="prenom" size="10" maxlength="50" value="---" required />

            <?php
            //echo $requete;
            $resultat = $bdd->query($requete);
            // Affichage de tous les résultats                 
            while ($data = mysqli_fetch_array($resultat)) {

                    echo "
            <tr>
                    <td><input type=\"text\" name=\"id\" value=\"" . $data['id'] ."\" hidden>
                    <input type=\"checkbox\" id=\"selec\" value=\"" . $data['id'] ."\" name=\"box\"  checked></td><td>
                    " . $data['nom'] . "</td><td>
                    " . $data['prenom'] . "</td><td>
                    " . $data['classe'] . "</td>           
            </tr>";
                } ?>

            <tr>
                    <td></td>
                    <td></td>
                    <td></td>

                    <td>
                            <input type="submit" name="ajouter" value="Ajouter"> 
                    </td>
            </tr>
            </form>

        </tbody>

    </table>

</body>

</html>
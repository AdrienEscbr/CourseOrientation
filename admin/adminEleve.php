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
        <a href="http://localhost/CourseOrientation/admin/ChoixClasse.php">
            <div id="btn"><span class="noselect">Retour</span>
                <div id="circle"></div>
            </div>
        </a>
    </from>

    <h1> Enregistrement des élèves </h1>
    <!-- Fichier csv -->

    <div id="co"><strong> * Inserer le fichier CSV : * </strong></div>
    <br>
    <div class="menu">
        <input type="file" id="csv" name="csv" accept=" .xlsx, .xls, .csv" class="button button1">
    </div>
    <br>
    <div id="co"><strong> * Insérer un élève individuellement * </strong></div>
    <br>
    <!-- TABLEAU -->
    <table class="tableau-style">

        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Mail</th>
                <th>Login</th>
                <th>Mot de passe</th>
                <th>Classe</th>
                <th>Actions</th>
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
                    $nbClasses++;
                    //print_r($classes); // $classe = "3A";
                    $requete = "SELECT * FROM eleve WHERE classe = ";
                    for ($ind = 0; $ind < $nbClasses; $ind++) {
                        $requete .= " \"$classes[$ind]\" or classe = ";
                    }
                    $requete .= " \"$classes[$nbClasses]\" ; ";
                }
            } else {
                echo " Choisi une classe !";
                $requete = "SELECT * FROM eleve WHERE id = '0'";
            }


            //echo $requete;
            $resultat = $bdd->query($requete);

            // Affichage de tous les résultats
            while ($data = mysqli_fetch_array($resultat)) {

                echo "<tr><form action=\"modifEleve.php\" method=\"post\" name=\"adminEleve\"><input type=\"text\" name=\"id\" value=\"" . $data['id'] . "\" hidden><td>
            <input type=\"text\" name=\"nom\" size=\"10\" maxlength=\"50\" value=\"" . $data['nom'] . "\" /></td><td>
            <input type=\"text\" name=\"prenom\" size=\"10\" maxlength=\"50\" value=\"" . $data['prenom'] . "\" /></td><td>
            <input type=\"text\" name=\"mail\" size=\"10\" maxlength=\"50\" value=\"" . $data['mail'] . "\" /></td><td>
            <input type=\"text\" name=\"login\" size=\"10\" maxlength=\"50\" value=\"" . $data['login'] . "\" /></td><td>
            <input type=\"text\" name=\"mdp\" size=\"10\" maxlength=\"50\" value=\"" . $data['mdp'] . "\" /></td><td>
            <input type=\"text\" name=\"classe\" size=\"10\" maxlength=\"50\" value=\"" . $data['classe'] . "\" /></td><td>
            <input type=\"submit\" name=\"modifier\" value=\"modifier\">
            </form>

            <form action=\"suprimerEleve.php\" method=\"post\" name=\"supprimer\">
            <input type=\"text\" name=\"id\" value=\"" . $data['id'] . "\" hidden>
            <input type=\"submit\" name=\"supprimer\" value=\"supprimer\">
            </form></td>
            </tr> ";
            }
            ?>

            <tr>
                <form action="validationEleve.php" method="post" name="adminEleve">

                    <td><input type="text" name="id" hidden><input type="text" name="nom" size="10" maxlength="50" value="---" required /></td>
                    <td><input type="text" name="prenom" size="10" maxlength="50" value="---" required /></td>
                    <td><input type="text" name="mail" size="10" maxlength="50" value="---" /></td>
                    <td><input type="text" name="login" size="10" maxlength="50" value="---" required /></td>
                    <td><input type="text" name="mdp" size="10" maxlength="50" value="---" required /></td>
                    <td><input type="text" name="classe" size="10" maxlength="50" value="---" required /></td>
                    <td><input type="submit" name="ajouter" value="ajouter"></td>

                </form>

            </tr>

        </tbody>

    </table>

</body>

</html>
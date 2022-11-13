<!DOCTYPE html>
<!-- 
    Created on : 16 oct. 2020, 12:05:07
    Author     : Océane.M
-->


<html lang='fr'>

<head>

    <head>
        <title> Organisateur </title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../tableau.css" />
    </head>

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

    <h1> Organisateur </h1>

    <!-- TABLEAU -->
    <table class="tableau-style">

        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Mail</th>
                <th>Login</th>
                <th>Mot de passe</th>
                <th>Qualité</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Connexion BDD
            require_once '../connexionbdd.php';

            $requete = "SELECT * FROM organisateur "; // On affiche tout ce qui est dans la table organisateur
            //echo $requete;
            $resultat = $bdd->query($requete);

            // Affichage de tous les résultats
            while ($data = mysqli_fetch_array($resultat)) {

                echo "<tr><form action=\"modif.php\" method=\"post\" name=\"adminProf\"><input type=\"text\" name=\"id\" value=\"" . $data['id'] . "\" hidden><td>
            <input type=\"text\" name=\"nom\" size=\"10\" maxlength=\"50\" value=\"" . $data['nom'] . "\" /></td><td>
            <input type=\"text\" name=\"prenom\" size=\"10\" maxlength=\"50\" value=\"" . $data['prenom'] . "\" /></td><td>
            <input type=\"text\" name=\"mail\" size=\"10\" maxlength=\"50\" value=\"" . $data['mail'] . "\" /></td><td>
            <input type=\"text\" name=\"login\" size=\"10\" maxlength=\"50\" value=\"" . $data['login'] . "\" /></td><td>
            <input type=\"text\" name=\"mdp\" size=\"10\" maxlength=\"50\" value=\"" . $data['mdp'] . "\" /></td><td>

            ";
                if ($data['qualite'] == "PROF")
                    echo "<select name=\"qualite\"><option value=\"PROF\">PROF</option><option value=\"ADMIN\">ADMIN</option></td><td>";
                else echo "<select name=\"qualite\"><option value=\"ADMIN\">ADMIN</option><option value=\"PROF\">PROF</option></td><td>";
                echo "<input type=\"submit\" name=\"modifier\" value=\"modifier\">

            </form>

            <form action=\"suprimer.php\" method=\"post\" name=\"supprimer\">
            <input type=\"text\" name=\"id\" value=\"" . $data['id'] . "\" hidden>
            <input type=\"submit\" name=\"supprimer\" value=\"supprimer\">
            </form></td>
            </tr>

            ";
            }
            ?>

            <tr>
                <form action="validationProf.php" method="post" name="adminProf">

                    <td><input type="text" name="id" hidden><input type="text" name="nom" size="10" maxlength="50" value="---" required /></td>
                    <td><input type="text" name="prenom" size="10" maxlength="50" value="---" required /></td>
                    <td><input type="text" name="mail" size="10" maxlength="50" value="---" /></td>
                    <td><input type="text" name="login" size="10" maxlength="50" value="---" required /></td>
                    <td><input type="text" name="mdp" size="10" maxlength="50" value="---" required /></td>
                    <td><select name="qualite" required>
                            <option value="PROF">PROF</option>
                            <option value="ADMIN">ADMIN</option>
                    </td>
                    <td><input type="submit" name="ajouter" value="ajouter"></td>

                </form>

            </tr>

        </tbody>

    </table>

</body>

</html>
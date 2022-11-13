<!DOCTYPE html>

<!-- 
Author     : Océane.M
-->

<html>

<head>

        <meta charset="UTF-8">
        <link rel="stylesheet" href="../confirmation.css" />
        <link rel="stylesheet" href="../reset.css" />
</head>

<body>

        <?php

        //*** Connexion BDD ***//

        require_once '../connexionbdd.php';
        // $id_recup = $_SESSION['id'];
        //        echo $id_recup; 

        //*** Savoir si l'utilisateur existe ***//

        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $mail = htmlspecialchars($_POST['mail']);
        $login = htmlspecialchars($_POST['login']);
        $mdp = htmlspecialchars($_POST['mdp']);
        $qualite = htmlspecialchars($_POST['qualite']);
        $modifier = htmlspecialchars($_POST['modifier']);
        $ajouter = htmlspecialchars($_POST['ajouter']);
        $id = htmlspecialchars($_POST['id']);

        //      echo $nom;
        //      echo $ajouter;
        //      echo $id; 

        //Ajouter

        if ($ajouter == "ajouter") {
                $req = "INSERT INTO organisateur (nom, prenom, mail, login, mdp, qualite) VALUES('$nom','$prenom','$mail','$login','$mdp','$qualite')";
                $res = $bdd->query($req);

                // echo $req;

                echo "<br><br><center> Votre élément a bien été ajouté ! </center><br><br>";
                echo "<center><br><br><a href=\"javascript:history.go(-1)\"><input type='button' value='Terminer'/></a></center>";
        } else {
                echo "<br><br><center> Votre ajout a échoué ! </center><br><br>";
                echo "<center><br><br><a href=\"javascript:history.go(-1)\"><input type='button' value='Terminer'/></a></center>";
        }

        ?>

</body>

</html>
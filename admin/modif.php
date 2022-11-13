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

        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $mail = htmlspecialchars($_POST['mail']);
        $login = htmlspecialchars($_POST['login']);
        $mdp = htmlspecialchars($_POST['mdp']);
        $qualite = htmlspecialchars($_POST['qualite']);
        $id = htmlspecialchars($_POST['id']);
        $modifier = htmlspecialchars($_POST['modifier']);



        // echo $id; 
        //echo $modifier; // il renvoie bien modifier

        //Modifier
        if ($modifier == "modifier") {
                $modif = "UPDATE organisateur SET nom= '" . $nom . "' , prenom= '" . $prenom . "', mail= '" . $mail . "', login ='" . $login . "', mdp= '" . $mdp . "', qualite= '" . $qualite . "' WHERE id = $id";
                $result = $bdd->query($modif);

                // echo "nom = $nom id=$id qualite =$qualite ";
                // echo $result;
                echo "<br><br><center> Votre modification a bien été prise en compte ! </center><br><br>";
                echo "<center><br><br><a href=\"javascript:history.go(-1)\"><input type='button' value='Terminer'/></a></center>";
        } else {
                echo "<br><br><center> Votre modification a échoué ! </center><br><br>";
                echo "<center><br><br><a href=\"javascript:history.go(-1)\"><input type='button' value='Terminer'/></a></center>";
        }




        ?>

</body>

</html>
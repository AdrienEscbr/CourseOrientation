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

        $supprimer = htmlspecialchars($_POST['supprimer']);
        $id = htmlspecialchars($_POST['id']);
        //echo $id;          

        //Supprimer
        if ($supprimer == "supprimer") {
                $suprim = "DELETE FROM organisateur WHERE id= $id ";
                $resu = $bdd->query($suprim);

                //echo $resu;

                echo "<br><br><center> Elément correctement supprimer ! </center><br><br>";
                echo "<center><br><br><a href=\"javascript:history.go(-1)\"><input type='button' value='Terminer'/></a></center>";
        } else {
                echo "<br><br><center> La suppression de l'élément a échoué ! </center><br><br>";
                echo "<center><br><br><a href=\"javascript:history.go(-1)\"><input type='button' value='Terminer'/></a></center>";
        }

        ?>
</body>

</html>
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


        //*** Recuperation d'info ***//


        $nomOrganisateur = htmlspecialchars($_POST['nom']);
        $prenomOrganisateur = htmlspecialchars($_POST['prenom']);        
        $date = htmlspecialchars($_POST['date']);
        $ajouter = htmlspecialchars($_POST['ajouter']);        //echo $nom;//echo $ajouter;//echo $id;

        // Checkbox
        if (isset($_POST['ajouter'])) { // si bouton ok 
                if (!empty($_POST['box'])) {
                        $tailleSelect = sizeof($_POST['box']);
                        echo $tailleSelect;
                        foreach ($_POST['box'] as $select) {
                                echo $select;
                                echo '<br>';
                        }
                }
        }
        //*** Id Organisateur ***/
        $reqOrg = "SELECT id FROM organisateur WHERE nom = '$nomOrganisateur' AND prenom = '$prenomOrganisateur';";
        $resOrg = $bdd->query($reqOrg);


        //*** Badge ***/

        $tableBadge = [];
        $numBadge = "SELECT * FROM badge WHERE dispo = 1 AND etat = 'OK';";
                // echo $numBadge;
        $exe = $bdd->query($numBadge);
        while ($data = mysqli_fetch_array($exe)) {
                //    echo " ".$data['id']." ".$data['numBadge']."  <br>";
                array_push($tableBadge, $data['numBadge']);
        }
        $tailleBadge = sizeof($tableBadge);
        echo " <br> Il y a " . $tailleBadge . " badges ";

        //*** Ajouter ***/
        if ($ajouter == "ajouter") {

                //*** Comparaison Nb Badge ***/
                if ($tailleBadge >= $tailleSelect) {

                        //*** Boucle inserer info dans la BDD ***/
                        while ($tailleSelect > -1) {
                                $req = "INSERT INTO participant (id_eleve, num_badge, date, id_organisateur) VALUES('$select','$tableBadge','$date','$id_recup')";
                                $res = $bdd->query($req);
                                $tailleSelect = $tailleSelect - 1;
                        }
                }
                else {
                        echo "<br><br><center> Il n'y a pas assez de badge ! </center><br><br>";
                        echo "<center><br><br><a href=\"javascript:history.go(-1)\"><input type='button' value='Terminer'/></a></center>";
                }

                echo "<br><br><center> Votre élément a bien été ajouté ! </center><br><br>";
                echo "<center><br><br><a href=\"javascript:history.go(-1)\"><input type='button' value='Terminer'/></a></center>";
        } 
        else {
                echo "<br><br><center> Votre ajout a échoué ! </center><br><br>";
                echo "<center><br><br><a href=\"javascript:history.go(-1)\"><input type='button' value='Terminer'/></a></center>";
        }

        ?>

</body>

</html>
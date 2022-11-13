<!DOCTYPE html>

<html lang="fr">

<head>
</head>

<body>

        <?php

        session_start();
        // Connexion BDD
        require_once 'connexionbdd.php';


        // Savoir si l'utilisateur eleve existe

        $login = htmlspecialchars($_POST['username']);
        echo $login;
        $mdp = htmlspecialchars($_POST['pass']);
        echo $mdp;

        $requete = "SELECT id FROM eleve WHERE login='" . $login . "' AND mdp='" . $mdp . "';";                // echo $requete; //AND qualite='ELEVE'
        $resultat = $bdd->query($requete);  //        echo "num resultat : ".$resultat->num_rows;

        $requeteAdmin = "SELECT id FROM organisateur WHERE login='" . $login . "' AND mdp='" . $mdp . "' AND qualite='ADMIN';";
        $resultatAdmin = $bdd->query($requeteAdmin);

        $requeteProf = "SELECT id FROM organisateur WHERE login='" . $login . "' AND mdp='" . $mdp . "' AND qualite='PROF';";
        $resultatProf = $bdd->query($requeteProf);

        // if($resultat == FALSE) die('ERREUR requete'); // On affiche le message d'erreur et on sort

        // Savoir si l'utilisateur ELEVE existe
        if ($resultat->num_rows > 0) {          // echo "OK on vous connait";
                $ligne =$resultat->fetch_assoc();
                $_SESSION['id']=$ligne['id'];
                echo '<meta http-equiv="refresh" content="0;URL=eleve/eleve.php">';
                exit();
        }

        // Savoir si l'utilisateur ADMIN existe
        elseif ($resultatAdmin->num_rows > 0) {
                $ligne2 =$resultat->fetch_assoc();
                $_SESSION['id']=$ligne2['id'];
                echo '<meta http-equiv="refresh" content="0;URL=admin/admin.php">';
                exit();
        }

        // Savoir si l'utilisateur PROF existe
        if ($resultatProf->num_rows > 0) {
                $ligne3 =$resultat->fetch_assoc();
                $_SESSION['id']=$ligne3['id'];
                echo '<meta http-equiv="refresh" content="4;URL=prof/prof.php">';
                exit();
        }

        // Sinon 
        else {
                echo " Vous n'etes pas enregistré ";
                echo '<meta http-equiv="refresh" content="2;URL=index.php">';
                
        }
        ?>
</body>

</html>
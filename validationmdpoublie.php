<!DOCTYPE html>

<html lang="fr">
<head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="mdpoublie.css"/> 
        <link rel="stylesheet" href="reset.css"/>
</head>

<title> Mot de passe oublié </title>

<body>
<!-- Bouton Retour -->
<from class="bouttonBack">
<link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
<a href="http://localhost/CourseOrientation/mdpoublie.html"><div id="btn"><span class="noselect">Retour</span><div id="circle"></div></div></a>
</from> 

<?php

// echo 'bonjour';

 // Connexion BDD
 require_once 'connexionbdd.php';

 // Savoir si l'utilisateur existe

         $nom = htmlspecialchars($_POST['nom']);
         $prenom = htmlspecialchars($_POST['prenom']);
         
 	//        echo $nom;
 	//        echo $prenom;

        $requete = "SELECT mail FROM eleve WHERE nom='".$nom."' AND prenom='".$prenom."';";
        $resultat= $bdd->query($requete);  

        $requete2 = "SELECT mail FROM organisateur WHERE nom='".$nom."' AND prenom='".$prenom."';";
        $resultat2= $bdd->query($requete2);  

        // echo $requete;
     
        if($resultat->num_rows > 0){ 
                $ligne =$resultat->fetch_assoc();
                        echo '<p style="text-align:center; color:green; font-size:35;"> Un mail a été envoyé à cette adresse </p>';
                        echo '<br><br><p style="text-align:center; color:green; font-size:35;">'.$ligne['mail'].'</p>';
                        exit();
                }
         
        // Savoir si l'utilisateur ADMIN existe
         
        elseif($resultat2->num_rows > 0){
                        $ligne2 =$resultat2->fetch_assoc();
                        echo '<p style="text-align:center; color:green; font-size:35;"> Un mail a été envoyé à cette adresse </p>';
                        echo '<br><br><p style="text-align:center; color:green; font-size:35;">'.$ligne2['mail'].'</p>';
                        exit();
                }
      
        else{
                echo '<p style="text-align:center; color:green; font-size:35;"> Vous n\'etes peut etre pas inscrit ? </p>';
                echo "<center><br><br><a href='http://localhost/CourseOrientation/index.php'><input type='button' value='continuer'/></a></center>";
        }
?>

</body>
</html>
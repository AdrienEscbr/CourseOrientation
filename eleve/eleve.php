<!DOCTYPE html>

<html lang="fr">

<body>

    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../mdpoublie.css" />
        <link rel="stylesheet" href="../reset.css" />
    </head>

    <title> Éleves </title>

    <!-- Bouton Retour -->
    <from class="bouttonBack">
        <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
        <a href="http://localhost/CourseOrientation/index.php">
            <div id="btn"><span class="noselect">Retour</span>
                <div id="circle"></div>
            </div>
        </a>
    </from>

    <!-- titre -->
    <br></br>
    <form class="titre">
        Espace Éleves
    </form>

    <!-- Sous Titre -->
    <br></br>
    <div id="co"><strong> * Affichage * </strong></div>
    <br></br>

    <?php

    //*** Connexion BDD ***//
    require_once '../connexionbdd.php';
    require_once '../session.php';

    $id = $_SESSION['id'];

    $requete = "SELECT nom, prenom FROM `eleve` WHERE id=$id ";   // echo $requete;
    $result = $bdd->query($requete);
    while ($data = mysqli_fetch_array($result)) {
        echo $id;
        echo " Nom : ";
        echo $data['nom'];
        echo '<br><br>';
        echo " Prénom : ";
        echo $data['prenom'];
    }

    ?>

    <br><br>
    <div class="menu">
        <a href="http://localhost/CourseOrientation/eleve/AfficheParcourtEleveTest.php"><button class="button button1"> Parcours </button></a>
    </div>

</body>

</html>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="../tableau.css" />

    <!-- Nous chargeons les fichiers CDN de Leaflet. Le CSS AVANT le JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin="" />
    <style type="text/css">
        #map {
            /* la carte DOIT avoir une hauteur sinon elle n'apparaît pas */
            width: 1100px;
            height: 600px;
            margin-left: 50px;
            float: left;
            position: fixed;
            margin-top: 1%;
            margin-left: 5%;
            border: 5px solid rgb(25, 114, 25);
            padding: 20px 10px 20px 10px;
        }

        #co {
            font-size: 35px;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            border: 3px solid rgb(25, 114, 25);
            padding: 20px 10px 20px 10px;
            margin-left: 40%;
            margin-right: 40%;
        }

        #phrase {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            text-align: left;
            margin-left: 5%;
            border: 1px solid rgb(25, 114, 25);
            padding: 10px 10px 10px 10px;
            margin-right: 170px;
        }
    </style>
    <title>Carte</title>
</head>

<header>
    <!-- Bouton Retour -->
    <form class="bouttonBack">
        <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
        <a href="http://localhost/CourseOrientation/eleve/eleve.php">
            <div id="btn"><span class="noselect">Retour</span>
                <div id="circle"></div>
            </div>
        </a>
    </form>

    <!-- Infos Eleve -->

    <div id="co"><strong> * Parcours * </strong></div>


    <?php

    //*** Connexion BDD ***//
    require_once '../connexionbdd.php';
    require_once '../session.php';

    $id = $_SESSION['id'];

    $test;

    $requete = "SELECT nom, prenom, classe FROM `eleve` WHERE id=$id ";   // echo $requete;
    $result = $bdd->query($requete);
    while ($data = mysqli_fetch_array($result)) {

        echo '<p id=phrase>Nom : <span style="font-weight: bold">' . $data['nom'] . '</span><br>';
        echo 'Prénom : <span style="font-weight: bold">' . $data['prenom'] ."</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".'Classe : <span style="font-weight: bold">'.$data['classe'].'</span></p>';
    }


    // Recuperation Numéro de badge //

    $requeteNumBadge = "SELECT num_badge FROM `participant` WHERE id_eleve=$id ";   // echo $requeteNumBadge;
    $resultNumBadge = $bdd->query($requeteNumBadge);
    if ($bdd->affected_rows != 0) {
        $dataNumBadge = mysqli_fetch_array($resultNumBadge);
        echo '<p id=phrase>Numéro du badge : <span style="font-weight: bold">' . $dataNumBadge['num_badge'] . '</span></p>';
        $num_badge = $dataNumBadge['num_badge'];
    } else {
        echo "Aucun numéro de badge correspondant à cet ID.";
        echo "<br>";
    }



    //SELECT COUNT(num_badge) FROM passageBorne WHERE num_badge = 'ade96392' m'affiche 13

    // Position Lattitude //

    $TabLat = [];
    $vide = [];
    $requeteTabPosLat = "SELECT position_Lat FROM `passageBorne` WHERE num_badge= '$num_badge'";   // echo $requeteTabPosLat;
    $resultTabPosLat = $bdd->query($requeteTabPosLat);

    // echo "nb ligne ";
    // echo $bdd->affected_rows;

    if ($bdd->affected_rows > 0) {
        $a = 0;
        while ($dataTabPosLat = $resultTabPosLat->fetch_assoc()) {
            if ($dataTabPosLat['position_Lat'] != $vide) {
                array_push($TabLat, $dataTabPosLat['position_Lat']);
                // echo '<br>';
                // echo $TabLat[$a];
                $a = $a + 1;
            }
        }
    }

    // Position Longitude //

    $TabLong = [];
    $requeteTabPosLong = "SELECT position_Long FROM `passageBorne` WHERE num_badge= '$num_badge' ";   // echo $requeteTabPosLong;
    $resultTabPosLong = $bdd->query($requeteTabPosLong);
    if ($bdd->affected_rows != 0) {
        $i = 0;
        while ($dataTabPosLong = $resultTabPosLong->fetch_assoc()) {
            if ($dataTabPosLong['position_Long'] != $vide) {
                array_push($TabLong, $dataTabPosLong['position_Long']);
                // echo '<br>';
                // echo $TabLong[$i];
                $i = $i + 1;
            }
        }
    }


    // Date et heure //

    $TabDatetime = [];
    $requeteTabDatetime = "SELECT dateHeure FROM `passageborne` WHERE num_badge= '$num_badge' ";   // echo $requeteTabPosLong;
    $resultTabDatetime = $bdd->query($requeteTabDatetime);
    if ($bdd->affected_rows != 0) {
        $i = 0;
        while ($dataTabDatetime = $resultTabDatetime->fetch_assoc()) {
            if ($dataTabDatetime['dateHeure'] != $vide) {
                array_push($TabDatetime, $dataTabDatetime['dateHeure']);
                array_push($TabDatetime, ';');
                // echo '<br>';
                // echo $TabDatetime[$i];
                $i = $i + 1;
            }
        }
    }


    ?>


</header>

<body>



    <!-- Carte -->
    <div id="map">
        <!-- Ici s'affichera la carte -->
    </div>

    <table class="tableau-style" style="margin-left: 70%">

        <thead>
            <tr>
                <th>Heure de passage</th>
                <th>Position borne</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Connexion BDD
            require_once '../connexionbdd.php';
            $requete = "SELECT * FROM passageborne WHERE num_badge = '$num_badge'";
            //echo $requete;
            $resultat = $bdd->query($requete);
            // Affichage de tous les résultats
            while ($data = mysqli_fetch_array($resultat)) {

                echo "<tr><td>
            $data[dateHeure] </td><td>
            $data[position_Long]  / $data[position_Lat]</td>
            </tr> ";
            }
            ?>
        </tbody>

    </table>




    <!-- Fichiers Javascript -->
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>
    <script type="text/javascript">
        // On initialise la latitude et la longitude de la forêt des Vaseix (centre de la carte)

        var lat = 45.829756256092054;
        var lon = 1.172935686860986;
        var macarte = null;

        //je recupere les valeurs des tableaux php dans un tableau javascript

        <?php echo "var tabLat = '" . implode(" ", $TabLat) . "'.split(' ');"; ?>
        //alert(tabLat);
        <?php echo "var tabLong = '" . implode(" ", $TabLong) . "'.split(' ');"; ?>
        //alert(tabLong);
        <?php echo "var dateHeure = '" . implode(" ", $TabDatetime) . "'.split(';');"; ?>


        var tailleTab = tabLat.length;


        // Fonction d'initialisation de la carte
        function initMap() {
            // Créer l'objet "macarte" et l'insèrer dans l'élément HTML qui a l'ID "map"
            macarte = L.map('map').setView([lat, lon], 15);
            // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
            L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
                // Il est toujours bien de laisser le lien vers la source des données
                attribution: 'données © OpenStreetMap/ODbL - rendu OSM France',
                minZoom: 1,
                maxZoom: 20
            }).addTo(macarte); 


            for (var o = 0; o < tailleTab; o++) {
                var bornes = {
                    "Point": {
                        "lat": tabLat[o],
                        "lon": tabLong[o]
                        //"dateTime": dateHeure.[o]
                    }
                };


                // Nous parcourons la liste des bornes
                for (borne in bornes) {

                    var circle = L.circle([bornes[borne].lat, bornes[borne].lon], {
                        color: 'red',
                        fillColor: '#f03',
                        fillOpacity: 0.1,
                        radius: 3
                    }).addTo(macarte);
                    circle.bindPopup(dateHeure[o]);
                }
            }

            var point = 0;
            while (point + 1 <= tailleTab) {

                var latlngs = [
                    [tabLat[point], tabLong[point]],
                    [tabLat[point + 1], tabLong[point + 1]]
                ];

                var polyline = L.polyline(latlngs, {
                    color: 'yellow'
                }).addTo(macarte);

                point = point + 1;
            }
            // zoom the map to the polyline
            map.fitBounds(polyline.getBounds());

        }
        window.onload = function() {
            // Fonction d'initialisation qui s'exécute lorsque le DOM est chargé
            initMap();
        };
    </script>
</body>

</html>
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
            width: 600px;
            height: 400px;
            margin-left: auto;
            margin-right: auto;

        }
    </style>
    <title>Carte</title>
</head>

<body>

    <!-- Bouton Retour -->
    <from class="bouttonBack">
        <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
        <a href="http://localhost/CourseOrientation/eleve/eleve.php">
            <div id="btn"><span class="noselect">Retour</span>
                <div id="circle"></div>
            </div>
        </a>
    </from>

    <!-- Infos Eleve -->
    <br>
    <div id="co"><strong> * Parcours * </strong></div>
    <br>

    <?php

    //*** Connexion BDD ***//
    require_once '../connexionbdd.php';


    $id = $_SESSION['id'];

    $requete = "SELECT nom, prenom FROM `eleve` WHERE id=$id ";   // echo $requete;
    $result = $bdd->query($requete);
    while ($data = mysqli_fetch_array($result)) {

        echo " Nom : ";
        echo $data['nom'];
        echo "<br>";
        echo " Prénom : ";
        echo $data['prenom'];
        echo "<br><br>";

    }

    ?>



    <!-- Carte -->
    <div id="map">
        <!-- Ici s'affichera la carte -->
    </div>

    <!-- Fichiers Javascript -->
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>
    <script type="text/javascript">
        // On initialise la latitude et la longitude de la forêt des Vaseix (centre de la carte)

        var lat = 45.829756256092054;
        var lon = 1.172935686860986;
        var macarte = null;
        // Nous initialisons une liste de marqueurs

        var villes = {
            "Point A": {
                "lat": 45.831189,
                "lon": 1.169783
            },
            "point 2": {
                "lat": 45.832535,
                "lon": 1.170287
            },
            "Point 3": {
                "lat": 45.831883,
                "lon": 1.174143
            },
            "Point E": {
                "lat": 45.829387,
                "lon": 1.175556
            }
        };


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
            // Nous parcourons la liste des villes
            for (ville in villes) {

                var circle = L.circle([villes[ville].lat, villes[ville].lon], {
                    color: 'red',
                    fillColor: '#f03',
                    fillOpacity: 0.1,
                    radius: 10
                }).addTo(macarte);
                circle.bindPopup(ville);
            }
            var latlngs = [
                [45.831189, 1.169783],
                [45.832535, 1.170287],
                [45.831883, 1.174143],
                [45.829387, 1.175556]
            ];

            var polyline = L.polyline(latlngs, {
                color: 'lightblue'
            }).addTo(macarte);

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
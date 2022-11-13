<?php 

/*
// webhost
    $userdb = 'id16035473_root'; 
    $mdpdb = 'Melaudy3064/'; 
    $bdd = new mysqli('localhost',$userdb,$mdpdb,'id16035473_courseorientation');  
    
        if($bdd->connect_errno)
        {
            echo "echec de la connexion";
            exit();
        }
*/

// Classe
    $userdb = 'root'; 
    $mdpdb = ''; 
    $bdd = new mysqli('localhost',$userdb,$mdpdb,'adrien_bdd');  
    
        if($bdd->connect_errno)
        {
            echo "echec de la connexion";
            exit();
        }


?> 

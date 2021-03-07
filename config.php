<?php
    $PARAM_hote='localhost'; // le chemin vers le serveur
    $PARAM_port='3306'; // Pour V finale port = 3307
    $PARAM_nom_bd='ressources_relationnelles'; // le nom de la base de données
    $PARAM_utilisateur='root'; // nom d'utilisateur pour se connecter
    $PARAM_mot_passe=''; // mot de passe de l'utilisateur pour se connecter // Pour V finale MDP = root
    $conn = new PDO('mysql:host='.$PARAM_hote.';port='.$PARAM_port.';dbname='.$PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe);
?>
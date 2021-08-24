<?php
session_start();

// 1. Test de la connection
try
{		
    $bdd = new PDO('sqlite:res/DBMazeGame.sqlite');
} 
	
catch (PDOException $e)
{
    echo "Erreur de connection !";
    die($e -> getMessage());
}

// Remise à 0 des coordonnées
$pId = $_SESSION["pId"];
$stm = $bdd -> prepare("UPDATE players SET x=1, y=1, z=0 WHERE pid = ? ");
$stm->execute([$pId]);

session_destroy(); // Destruction de la session 
?>
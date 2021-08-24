<?php
session_start(); // Pour création d'une session
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

// 2. Récupération des informations
$pseudo = isset($_POST["pseudoLog"]) ? $_POST["pseudoLog"] : exit();
$password = isset($_POST["passwordLog"]) ? $_POST["passwordLog"] : exit();

// 3. Test récuparation du compte
$sql = "SELECT * FROM players WHERE login = ? AND passwd = ?";
$stm = $bdd->prepare($sql);
$stm->execute([$pseudo,$password]);

// 3.1 Si utilisateur existant
if($row = $stm ->fetch()){
    $_SESSION["pId"] = $row["pid"];
    $_SESSION["direction"] = "south"; // Position de départ niveau serveur
    $_SESSION["pPseudo"] = $row["login"];

    // Valeurs à renvoyées
    $num = "0";
    $id = $_SESSION["pId"];
    $pseudo = $_SESSION["pPseudo"];
    $valeurs = $num.",".$id.",".$pseudo;
    echo $valeurs;
}

// 3.2 Si utilisateur inexistant
else{
    echo "1";
    exit();
}
?>
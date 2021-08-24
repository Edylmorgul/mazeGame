<?php
    session_start();
    // 0. Encodage pour recup balise dans echo
    header("content-Type: text/xml");
    echo '<?xml version="1.0" encoding ="UTF-8" ?>';

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

    // 2. Récupération des variables de sessions(login.php)
    $pId = $_SESSION["pId"];
    $direction = $_SESSION["direction"];

    // 3. Recuperation des données du joueur
    $stm = $db -> prepare("SELECT x,y,z FROM players WHERE pid = $pId ");
    $stm->execute(array());

    // 4. Envoi des données
    echo "<racine>";
    while ($row = $stm->fetch()) 
    {
        echo "<coordinates>";
        echo "<posX>" .$row["x"]. "</posX>";
        echo "<posY>" .$row["y"]. "</posY>";
        echo "<posZ>" .$row["z"]. "</posZ>";
        echo "</coordinates>";
    }
    echo "</racine>";
?>
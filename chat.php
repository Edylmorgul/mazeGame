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

// 2. Récupération des variables de sessions(login.php)
$pId = $_SESSION["pId"];

// 3. Récupération des informations
$time = time(); // Le temps pour l'envoi
$message = isset($_POST["message"]) ? $_POST["message"] : exit();
$typeMessage = isset($_POST["typeMessage"]) ? $_POST["typeMessage"] : exit();

// 4. Vérifier messages avec espaces
$message = trim($message); 
if ($message == "") {
    echo"0";
}
 
// 5. Ajout du message
else
{
    $stm = $bdd -> prepare("INSERT INTO msg(msgtext, msgfrom, ts, msgtype) VALUES(?, ?, ?, ?)");
    $stm->execute([$message, $pId, $time, $typeMessage]);
}
?>
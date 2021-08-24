<?php
// 1. Test de la connection
try
{		
    $bdd = new PDO('sqlite:res/DBMazeGame.sqlite'); // PDO va créer le fichier sqlite automatiquement si il n'existe pas.
} 
	
catch (PDOException $e)
{
    echo "Erreur de connection !";
    die($e -> getMessage()); // Stop l'execution du script et afficher message d'erreur ==> Une autre methode que exit()
}

// 2. Récupération des informations
$pseudo = isset($_POST["pseudoReg"]) ? $_POST["pseudoReg"] : exit();
$password = isset($_POST["passwordReg"]) ? $_POST["passwordReg"] : exit();
$email = isset($_POST["emailReg"]) ? $_POST["emailReg"] : exit();

// 2.1 Valeurs par défauts des coordonnées
$x = 1;
$y = 1;
$z = 0; // Etage

// 3. Vérification si pseudo déjà présent en DB
$sql = "SELECT * FROM players WHERE login = ?";
$stm = $bdd->prepare($sql);
$stm->execute([$pseudo]);
$player = $stm->fetch();

if($player){
    echo "1";
    exit();
}

// 4. Vérification si email déjà présent en DB
$sql = "SELECT * FROM players WHERE email = ?";
$stm = $bdd->prepare($sql);
$stm->execute([$email]);
$player = $stm->fetch();

if($player){
    echo "2";
    exit();
}

// 5. Ajout du joueur
else{
    $sql = "INSERT INTO players(login, passwd, email, x, y, z) VALUES(?,?,?,?,?,?)";
    $stm = $bdd->prepare($sql);
    $stm->execute([$pseudo, $password, $email, $x, $y, $z]);
    echo "0";
}
?>
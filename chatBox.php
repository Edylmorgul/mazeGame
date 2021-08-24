<?php
    session_start();
// 0. Encodage permettant de recuperer les balises dans les echos
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
    
$stm = $bdd -> prepare("SELECT msg.msgtext, msg.msgfrom, msg.ts, msg.msgtype, players.login FROM msg INNER JOIN players ON msg.msgfrom = players.pid ORDER BY msg.ts desc limit 10 ");
$stm->execute(array());

// 2. Préparation récupération messages pour envoi JS
echo "<racine>";
while ($std = $stm->fetch()) 
{
    echo "<playerMsg>";
    echo "<playerLogin>" .$std["login"]. "</playerLogin>";
    echo "<content>";
    echo "<![CDATA[" .$std["msgtext"]. "]]>";
    echo "</content>";
    echo "<time>" .$std["ts"]. "</time>";
    echo "</playerMsg>";
}
  echo "</racine>";
?>
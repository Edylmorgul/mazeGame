<?php
session_start();

// 1. récupération niveaux via maps.php
include "laby.inc"; 

// 2. Test de la connection
try
{		
    $bdd = new PDO('sqlite:res/DBMazeGame.sqlite');
} 
	
catch (PDOException $e)
{
    echo "Erreur de connection !";
    die($e -> getMessage());
}

// 3. Récupération des variables de sessions(login.php)
$pId = $_SESSION["pId"];
$direction = $_SESSION["direction"];

// 4. Récupération des données du joueur 
$stm = $bdd ->prepare("SELECT x,y,z FROM players WHERE pid = $pId");
$stm ->execute();
$row = $stm->fetch();
$col = $row["y"];
$lig = $row["x"];
$etage = $row["z"];

// 5. Affichage des images selon le point de vue du joueur
// 5.1 NORD
// a, b, c, ... ==> CASE DU JEU
// Récupération des cases du jeu selon orientation
/*
        NORD
´A  B   C    D   E   F  G
    H   I    J   K   L
        M    N   O
        P    ↑   Q´

*/
if($_SESSION["direction"] == "north"){
    // Vérifier les cases qui ne sont pas dans le tableau
    // if ==> Vérifier qu'on ne sort pas du tableau
    if($lig-3 >= 0 && $col-3 >= 0)$a = strval($laby[$etage][$lig-3] [$col-3]);
    else $a = null;
    if($lig-3 >= 0 && $col-2 >= 0)$b = strval($laby[$etage][$lig-3] [$col-2]) ;
    else $b = null;
    if($lig-3 >= 0 && $col-1 >= 0)$c = strval($laby[$etage][$lig-3] [$col-1]) ;
    else $c = null;
    if($lig-3 >= 0)$d = strval($laby[$etage][$lig-3] [$col]) ;
    else $d = null;
    if($lig-3 >= 0 && $col+1 <= 15)$e = strval($laby[$etage][$lig-3] [$col+1]) ;
    else $e = null;
    if($lig-3 >= 0 && $col+2 <= 15)$f = strval($laby[$etage][$lig-3] [$col+2]) ;
    else $f = null;
    if($lig-3 >= 0 && $col+3 <= 15)$g = strval($laby[$etage][$lig-3] [$col+3]) ;
    else $g = null;

    if($lig-2 >= 0 && $col-2 >= 0)$h = strval($laby[$etage][$lig-2] [$col-2]) ;
    else $h = null;
    if($lig-2 >= 0 && $col-1 >= 0)$i = strval($laby[$etage][$lig-2] [$col-1]) ;
    else $i = null;
    if($lig-2 >= 0)$j = strval($laby[$etage][$lig-2] [$col]) ;
    else $j = null;
    if($lig-2 >= 0 && $col+1 <= 15)$k = strval($laby[$etage][$lig-2] [$col+1]) ;
    else $k = null;
    if($lig-2 >= 0 && $col+2 <= 15)$l = strval($laby[$etage][$lig-2] [$col+2]) ;
    else $l = null;

    if($lig-1 >= 0 && $col-1 >= 0)$m = strval($laby[$etage][$lig-1] [$col-1]) ;
    else $m = null;
    if($lig-1 >= 0)$n = strval($laby[$etage][$lig-1] [$col]) ;
    else $n = null;
    if($lig-1 >= 0 && $col+1 <= 15)$o = strval($laby[$etage][$lig-1] [$col+1]) ;
    else $o = null;

    if($col-1 >= 0)$p = strval($laby[$etage][$lig] [$col-1]) ;
    else $p = null;
    if($col+1 <= 15)$q = strval($laby[$etage][$lig] [$col+1]) ;
    else $q = null;

    $stm = $bdd->prepare("SELECT theme FROM maps WHERE z = $etage");
    $stm->execute();
    $row = $stm->fetch();
    $theme = $row["theme"];

    // 6. Envoi des données vers js
    $tabData = $a.";".$b.";".$c.";".$d.";".$e.";".$f.";".$g.";".$h.";".$i.";".$j.";".$k.";".$l.";".$m.";".$n.";".$o.";".$p.";".$q.";".$theme.";".$_SESSION["direction"].";";
    echo $tabData;
}

// 5.2 SUD
/*
            SUD
'       Q    ↓    P
        O   N   M
    L   K   J   I    H
G    F   E   D   C   B    A'
*/
if($_SESSION["direction"] == "south"){

    if($lig+3 <= 15 && $col+3 <= 15)$a = strval($laby[$etage][$lig+3] [$col+3]);
    else $a = null;
    if($lig+3 <= 15 && $col+2 <= 15)$b = strval($laby[$etage][$lig+3] [$col+2]) ;
    else $b = null;
    if($lig+3 <= 15 && $col+1 <= 15)$c = strval($laby[$etage][$lig+3] [$col+1]) ;
    else $c = null;
    if($lig+3 <= 15)$d = strval($laby[$etage][$lig+3] [$col]) ;
    else $d = null;
    if($lig+3 <= 15 && $col-1 >= 0)$e = strval($laby[$etage][$lig+3] [$col-1]) ;
    else $e = null;
    if($lig+3 <= 15 && $col-2 >= 0)$f = strval($laby[$etage][$lig+3] [$col-2]) ;
    else $f = null;
    if($lig+3 <= 15 && $col-3 >= 0)$g = strval($laby[$etage][$lig+3] [$col-3]) ;
    else $g = null;

    if($lig+2 <= 15 && $col+2 <= 15)$h = strval($laby[$etage][$lig+2] [$col+2]) ;
    else $h = null;
    if($lig+2 <= 15 && $col+1 <= 15)$i = strval($laby[$etage][$lig+2] [$col+1]) ;
    else $i = null;
    if($lig+2 <= 15)$j = strval($laby[$etage][$lig+2] [$col]) ;
    else $j = null;
    if($lig+2 <= 15 && $col-1 >= 0)$k = strval($laby[$etage][$lig+2] [$col-1]) ;
    else $k = null;
    if($lig+2 <= 15 && $col-2 >= 0)$l = strval($laby[$etage][$lig+2] [$col-2]) ;
    else $l = null;

    if($lig+1 <= 15 && $col+1 <= 15)$m = strval($laby[$etage][$lig+1] [$col+1]) ;
    else $m = null;
    if($lig+1 <= 15)$n = strval($laby[$etage][$lig+1] [$col]) ;
    else $n = null;
    if($lig+1 <= 15 && $col-1 >= 0)$o = strval($laby[$etage][$lig+1] [$col-1]) ;
    else $o = null;

    if($col+1 <= 15)$p = strval($laby[$etage][$lig] [$col+1]) ;
    else $p = null;
    if($col-1 >= 0)$q = strval($laby[$etage][$lig] [$col-1]) ;
    else $q = null;

    $stm = $bdd->prepare("SELECT theme FROM maps WHERE z = $etage");
    $stm->execute();
    $row = $stm->fetch();
    $theme = $row["theme"];

    // 6. Envoi des données vers js
    $tabData = $a.";".$b.";".$c.";".$d.";".$e.";".$f.";".$g.";".$h.";".$i.";".$j.";".$k.";".$l.";".$m.";".$n.";".$o.";".$p.";".$q.";".$theme.";".$_SESSION["direction"].";";
    echo $tabData;
}

if($_SESSION["direction"] == "west"){
    if($lig+3 <= 15 && $col-3 >= 0)$a = strval($laby[$etage][$lig+3] [$col-3]);
    else $a = null;
    if($lig+2 <= 15 && $col-3 >= 0)$b = strval($laby[$etage][$lig+2] [$col-3]);
    else $b = null;
    if($lig+1 <= 15 && $col-3 >= 0)$c = strval($laby[$etage][$lig+1] [$col-3]);
    else $c = null;
    if($col-3 >= 0)$d = strval($laby[$etage][$lig] [$col-3]);
    else $d = null;
    if($lig-1 >= 0 && $col-3 >= 0)$e = strval($laby[$etage][$lig-1] [$col-3]);
    else $e = null;
    if($lig-2 >= 0 && $col-3 >= 0)$f = strval($laby[$etage][$lig-2] [$col-3]);
    else $f = null;
    if($lig-3 >= 0 && $col-3 >= 0)$g = strval($laby[$etage][$lig-3] [$col-3]);
    else $g = null;

    if($lig+2 <= 15 && $col-2 >= 0)$h = strval($laby[$etage][$lig+2] [$col-2]);
    else $h = null;
    if($lig+1 <= 15 && $col-2 >= 0)$i = strval($laby[$etage][$lig+1] [$col-2]);
    else $i = null;
    if($col-2 >= 0)$j = strval($laby[$etage][$lig] [$col-2]);
    else $j = null;
    if($lig-1 >= 0 && $col-2 >= 0)$k = strval($laby[$etage][$lig-1] [$col-2]);
    else $k = null;
    if($lig-2 >= 0 && $col-2 >= 0)$l = strval($laby[$etage][$lig-2] [$col-2]);
    else $l = null;

    if($lig+1 <= 15 && $col-1 >= 0)$m = strval($laby[$etage][$lig+1] [$col-1]);
    else $m = null;
    if($col-1 >= 0)$n = strval($laby[$etage][$lig] [$col-1]);
    else $n = null;
    if($lig-1 >= 0 && $col-1 >= 0)$o = strval($laby[$etage][$lig-1] [$col-1]);
    else $o = null;

    if($lig+1 <= 15)$p = strval($laby[$etage][$lig+1] [$col]);
    else $p = null;
    if($lig-1 >= 0)$q = strval($laby[$etage][$lig-1] [$col]);
    else $q = null;

    $stm = $bdd->prepare("SELECT theme FROM maps WHERE z = $etage");
    $stm->execute();
    $row = $stm->fetch();
    $theme = $row["theme"];

    // 6. Envoi des données vers js
    $tabData = $a.";".$b.";".$c.";".$d.";".$e.";".$f.";".$g.";".$h.";".$i.";".$j.";".$k.";".$l.";".$m.";".$n.";".$o.";".$p.";".$q.";".$theme.";".$_SESSION["direction"].";";
    echo $tabData;
}

// 5.3 EST
/*
               A
          H    B
P    M    I    C
→    N    J    D
Q    O    K    E
          L    F
               G
*/
// 5.4 OUEST
if($_SESSION["direction"] == "east"){
    if($lig-3 >= 0 && $col+3 <= 15)$a = strval($laby[$etage][$lig-3] [$col+3]);
    else $a = null;
    if($lig-2 >= 0 && $col+3 <= 15)$b = strval($laby[$etage][$lig-2] [$col+3]);
    else $b = null;
    if($lig-1 >= 0 && $col+3 <= 15)$c = strval($laby[$etage][$lig-1] [$col+3]);
    else $c = null;
    if($col+3 <= 15)$d = strval($laby[$etage][$lig] [$col+3]);
    else $d = null;
    if($lig+1 <= 15 && $col+3 <= 15)$e = strval($laby[$etage][$lig+1] [$col+3]);
    else $e = null;
    if($lig+2 <= 15 && $col+3 <= 15)$f = strval($laby[$etage][$lig+2] [$col+3]);
    else $f = null;
    if($lig+3 <= 15 && $col+3 <= 15)$g = strval($laby[$etage][$lig+3] [$col+3]);
    else $g = null;

    if($lig-2 >= 0 && $col+2 <= 15)$h = strval($laby[$etage][$lig-2] [$col+2]);
    else $h = null;
    if($lig-1 >= 0 && $col+2 <= 15)$i = strval($laby[$etage][$lig-1] [$col+2]);
    else $i = null;
    if($col+2 <= 15)$j = strval($laby[$etage][$lig] [$col+2]);
    else $j = null;
    if($lig+1 <= 15 && $col+2 <= 15)$k = strval($laby[$etage][$lig+1] [$col+2]);
    else $k = null;
    if($lig+2 <= 15 && $col+2 <= 15)$l = strval($laby[$etage][$lig+2] [$col+2]);
    else $l = null;

    if($lig-1 >= 0 && $col+1 <= 15)$m = strval($laby[$etage][$lig-1] [$col+1]);
    else $m = null;
    if($col+1 <= 15)$n = strval($laby[$etage][$lig] [$col+1]);
    else $n = null;
    if($lig+1 <= 15 && $col+1 <= 15)$o = strval($laby[$etage][$lig+1] [$col+1]);
    else $o = null;

    if($lig-1 >= 0)$p = strval($laby[$etage][$lig-1] [$col]);
    else $p = null;
    if($lig+1 <= 15)$q = strval($laby[$etage][$lig+1] [$col]);
    else $q = null;

    $stm = $bdd->prepare("SELECT theme FROM maps WHERE z = $etage");
    $stm->execute();
    $row = $stm->fetch();
    $theme = $row["theme"];

    // 6. Envoi des données vers js
    $tabData = $a.";".$b.";".$c.";".$d.";".$e.";".$f.";".$g.";".$h.";".$i.";".$j.";".$k.";".$l.";".$m.";".$n.";".$o.";".$p.";".$q.";".$theme.";".$_SESSION["direction"].";";
    echo $tabData;
}
?>


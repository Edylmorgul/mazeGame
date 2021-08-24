<?php
session_start();
// 0. récupération niveaux via maps.php
include "laby.inc"; 

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

// 3. Récupération des variables de sessions(login.php)
$pId = $_SESSION["pId"];
$direction = $_SESSION["direction"];

// 4. Récupération des informations
$move = isset($_POST["move"]) ? $_POST["move"] : exit();

// 5. Récupération des données du joueur 
$stm = $bdd ->prepare("SELECT x,y,z FROM players WHERE pid = $pId");
$stm ->execute();
$row = $stm->fetch();
$col = $row["y"];
$lig = $row["x"];
$etage = $row["z"];

$case;

// Passage 0, 3, 4 ,5, 6 : 6 Etage

// 6. Gestion des déplacements
switch($direction){
    case 'north' :
        switch($move){
            case 1 : // Gauche
                $case = strval($laby[$etage][$lig] [$col-1]);
                $_SESSION["direction"] = 'west';
                if($etage == 0 && $case == 4){
                    $stm = $bdd -> prepare("UPDATE players SET y=y - 1, z = z + 1 WHERE pid = ? ");
                    $stm->execute([$pId]);
                }

                else if($etage == 1 && $case == 5){
                    $stm = $bdd -> prepare("UPDATE players SET y=y - 1, z = z - 1 WHERE pid = ? ");
                    $stm->execute([$pId]);
                }

                else if($etage == 1 && $case == 6){
                    $stm = $bdd -> prepare("UPDATE players SET y=y - 1, z = z + 1 WHERE pid = ? ");
                    $stm->execute([$pId]);
                }

                else if($etage == 2 && $case == 5){
                    echo 'GAME ECHEC';
                }
                break;
            case 2 : // Droite
                $case = strval($laby[$etage][$lig] [$col-1]);
                $_SESSION["direction"] = 'east';
                if($etage == 0 && $case == 4){
                    $stm = $bdd -> prepare("UPDATE players SET y=y - 1, z = z + 1 WHERE pid = ? ");
                    $stm->execute([$pId]);
                }

                else if($etage == 1 && $case == 5){
                    $stm = $bdd -> prepare("UPDATE players SET y=y - 1, z = z - 1 WHERE pid = ? ");
                    $stm->execute([$pId]);
                }

                else if($etage == 1 && $case == 6){
                    $stm = $bdd -> prepare("UPDATE players SET y=y - 1, z = z + 1 WHERE pid = ? ");
                    $stm->execute([$pId]);
                }

                else if($etage == 2 && $case == 5){
                    echo 'GAME ECHEC';
                }
                break;
            case 3 : // Avancer
                $case = strval($laby[$etage][$lig] [$col-1]);
                if(!in_array($case, range(1,2))){ // collision ==> Vérifie pas 1 et 2 
                    // Update coordonnée
                    if($etage == 0 && $case == 4){
                        $stm = $bdd -> prepare("UPDATE players SET y=y - 1, z = z + 1 WHERE pid = ? ");
                        $stm->execute([$pId]);
                    }

                    else if($etage == 1 && $case == 5){
                        $stm = $bdd -> prepare("UPDATE players SET y=y - 1, z = z - 1 WHERE pid = ? ");
                        $stm->execute([$pId]);
                    }

                    else if($etage == 1 && $case == 6){
                        $stm = $bdd -> prepare("UPDATE players SET y=y - 1, z = z + 1 WHERE pid = ? ");
                        $stm->execute([$pId]);
                    }

                    else if($etage == 2 && $case == 5){
                        echo 'GAME ECHEC';
                    }
                    
                    else{
                        $stm = $bdd -> prepare("UPDATE players SET y=y - 1 WHERE pid = ? ");
                        $stm->execute([$pId]);
                    }
                } 
          
                break;
            case 4 : // Reculer
                $case = strval($laby[$etage][$lig] [$col-1]);
                if(!in_array(strval($laby[$etage][$lig] [$col+1]), range(1,2))){
                    $stm = $bdd -> prepare("UPDATE players SET y=y + 1 WHERE pid = ? ");
                    $stm->execute([$pId]);
                }  

                else if($etage == 1 && $case == 5){
                    $stm = $bdd -> prepare("UPDATE players SET y=y - 1, z = z - 1 WHERE pid = ? ");
                    $stm->execute([$pId]);
                }

                else if($etage == 1 && $case == 6){
                    $stm = $bdd -> prepare("UPDATE players SET y=y - 1, z = z + 1 WHERE pid = ? ");
                    $stm->execute([$pId]);
                }

                else if($etage == 2 && $case == 5){
                    echo 'GAME ECHEC';
                }
           
                break;
            case 5 : // Basculer à gauche
                if(!in_array(strval($laby[$etage][$lig-1] [$col]), range(1,2))){
                    $stm = $bdd -> prepare("UPDATE players SET x=x - 1 WHERE pid = ? ");
                    $stm->execute([$pId]);
                } 

                break;
            case 6 : // Basculer à droite
                if(!in_array(strval($laby[$etage][$lig+1] [$col]), range(1,2))){
                    $stm = $bdd -> prepare("UPDATE players SET x=x + 1 WHERE pid = ? ");
                    $stm->execute([$pId]);
                }  
        }
        break;

    case 'south' :
        switch($move){
            case 1 :
                $case = strval($laby[$etage][$lig] [$col-1]);
                $_SESSION["direction"] = 'east';
                if($etage == 0 && $case == 4){
                    $stm = $bdd -> prepare("UPDATE players SET y=y - 1, z = z + 1 WHERE pid = ? ");
                    $stm->execute([$pId]);
                }

                else if($etage == 1 && $case == 5){
                    $stm = $bdd -> prepare("UPDATE players SET y=y - 1, z = z - 1 WHERE pid = ? ");
                    $stm->execute([$pId]);
                }

                else if($etage == 1 && $case == 6){
                    $stm = $bdd -> prepare("UPDATE players SET y=y - 1, z = z + 1 WHERE pid = ? ");
                    $stm->execute([$pId]);
                }

                else if($etage == 2 && $case == 5){
                    echo 'GAME ECHEC';
                }
                break;
            case 2 :
                $case = strval($laby[$etage][$lig] [$col-1]);
                $_SESSION["direction"] = 'west';
                if($etage == 0 && $case == 4){
                    $stm = $bdd -> prepare("UPDATE players SET y=y - 1, z = z + 1 WHERE pid = ? ");
                    $stm->execute([$pId]);
                }

                else if($etage == 1 && $case == 5){
                    $stm = $bdd -> prepare("UPDATE players SET y=y - 1, z = z - 1 WHERE pid = ? ");
                    $stm->execute([$pId]);
                }

                else if($etage == 1 && $case == 6){
                    $stm = $bdd -> prepare("UPDATE players SET y=y - 1, z = z + 1 WHERE pid = ? ");
                    $stm->execute([$pId]);
                }

                else if($etage == 2 && $case == 5){
                    echo 'GAME ECHEC';
                }
                break;
            case 3 : // Avancer
                $case = strval($laby[$etage][$lig] [$col-1]);
                if(!in_array(strval($laby[$etage][$lig] [$col+1]), range(1,2))){ // liglision
                    // Update coordonnée
                    $stm = $bdd -> prepare("UPDATE players SET y=y + 1 WHERE pid = ? ");
                    $stm->execute([$pId]);
                }       
                
                else if($etage == 1 && $case == 5){
                    $stm = $bdd -> prepare("UPDATE players SET y=y - 1, z = z - 1 WHERE pid = ? ");
                    $stm->execute([$pId]);
                }

                else if($etage == 1 && $case == 6){
                    $stm = $bdd -> prepare("UPDATE players SET y=y - 1, z = z + 1 WHERE pid = ? ");
                    $stm->execute([$pId]);
                }

                else if($etage == 2 && $case == 5){
                    echo 'GAME ECHEC';
                }
                break;
            case 4 : // Reculer
                $case = strval($laby[$etage][$lig] [$col-1]);
                if(!in_array(strval($laby[$etage][$lig] [$col-1]), range(1,2))){
                    $stm = $bdd -> prepare("UPDATE players SET y=y - 1 WHERE pid = ? ");
                    $stm->execute([$pId]);
                }  
                
                else if($etage == 1 && $case == 5){
                    $stm = $bdd -> prepare("UPDATE players SET y=y - 1, z = z - 1 WHERE pid = ? ");
                    $stm->execute([$pId]);
                }

                else if($etage == 1 && $case == 6){
                    $stm = $bdd -> prepare("UPDATE players SET y=y - 1, z = z + 1 WHERE pid = ? ");
                    $stm->execute([$pId]);
                }

                else if($etage == 2 && $case == 5){
                    echo 'GAME ECHEC';
                }
                break;
            case 5 : // Basculer à gauche
                if(!in_array(strval($laby[$etage][$lig+1] [$col]), range(1,2))){
                    $stm = $bdd -> prepare("UPDATE players SET x=x + 1 WHERE pid = ? ");
                    $stm->execute([$pId]);
                }    
                break;
            case 6 : // Basculer à droite
                if(!in_array(strval($laby[$etage][$lig-1] [$col]), range(1,2))){
                    $stm = $bdd -> prepare("UPDATE players SET x=x - 1 WHERE pid = ? ");
                    $stm->execute([$pId]);
                }
        }
        break;

    case 'east' :
        switch($move){
            case 1 :
                $case = strval($laby[$etage][$lig] [$col-1]);
                $_SESSION["direction"] = 'north';
                if($etage == 0 && $case == 4){
                    $stm = $bdd -> prepare("UPDATE players SET y=y - 1, z = z + 1 WHERE pid = ? ");
                    $stm->execute([$pId]);
                }

                else if($etage == 1 && $case == 5){
                    $stm = $bdd -> prepare("UPDATE players SET y=y - 1, z = z - 1 WHERE pid = ? ");
                    $stm->execute([$pId]);
                }

                else if($etage == 1 && $case == 6){
                    $stm = $bdd -> prepare("UPDATE players SET y=y - 1, z = z + 1 WHERE pid = ? ");
                    $stm->execute([$pId]);
                }

                else if($etage == 2 && $case == 5){
                    echo 'GAME ECHEC';
                }
                break;
            case 2 :
                $case = strval($laby[$etage][$lig] [$col-1]);
                $_SESSION["direction"] = 'south';
                if($etage == 0 && $case == 4){
                    $stm = $bdd -> prepare("UPDATE players SET y=y - 1, z = z + 1 WHERE pid = ? ");
                    $stm->execute([$pId]);
                }

                else if($etage == 1 && $case == 5){
                    $stm = $bdd -> prepare("UPDATE players SET y=y - 1, z = z - 1 WHERE pid = ? ");
                    $stm->execute([$pId]);
                }

                else if($etage == 1 && $case == 6){
                    $stm = $bdd -> prepare("UPDATE players SET y=y - 1, z = z + 1 WHERE pid = ? ");
                    $stm->execute([$pId]);
                }

                else if($etage == 2 && $case == 5){
                    echo 'GAME ECHEC';
                }
                break;
            case 3 : // Avancer
                $case = strval($laby[$etage][$lig] [$col+1]);
                if(!in_array(strval($laby[$etage][$lig] [$col+1]), range(1,2))){
                    if($etage == 0 && $case == 4){
                        $stm = $bdd -> prepare("UPDATE players SET y=y + 1, z = z + 1 WHERE pid = ? ");
                        $stm->execute([$pId]);
                    }

                    else if($etage == 1 && $case == 5){
                        $stm = $bdd -> prepare("UPDATE players SET y=y + 1, z = z - 1 WHERE pid = ? ");
                        $stm->execute([$pId]);
                    }

                    else{
                        $stm = $bdd -> prepare("UPDATE players SET y=y + 1 WHERE pid = ? ");
                        $stm->execute([$pId]);
                    }                   
                }               
                break;
            case 4 : // Reculer
                $case = strval($laby[$etage][$lig] [$col-1]);
                if(!in_array(strval($laby[$etage][$lig] [$col-1]), range(1,2))){
                    $stm = $bdd -> prepare("UPDATE players SET y=y - 1 WHERE pid = ? ");
                    $stm->execute([$pId]);
                }   
                
                else if($etage == 1 && $case == 5){
                    $stm = $bdd -> prepare("UPDATE players SET y=y - 1, z = z - 1 WHERE pid = ? ");
                    $stm->execute([$pId]);
                }

                else if($etage == 1 && $case == 6){
                    $stm = $bdd -> prepare("UPDATE players SET y=y - 1, z = z + 1 WHERE pid = ? ");
                    $stm->execute([$pId]);
                }

                else if($etage == 2 && $case == 5){
                    echo 'GAME ECHEC';
                }
                break;
            case 5 : // Basculer à gauche
                if(!in_array(strval($laby[$etage][$lig+1] [$col]), range(1,2))){
                    $stm = $bdd -> prepare("UPDATE players SET x=x + 1 WHERE pid = ? ");
                    $stm->execute([$pId]);
                }    
                break;
            case 6 : // Basculer à droite
                if(!in_array(strval($laby[$etage][$lig-1] [$col]), range(1,2))){
                    $stm = $bdd -> prepare("UPDATE players SET x=x - 1 WHERE pid = ? ");
                    $stm->execute([$pId]);
                }
        }
        break;

    case 'west' :
        switch($move){
            case 1 :
                $case = strval($laby[$etage][$lig] [$col-1]);
                $_SESSION["direction"] = 'south';
                if($etage == 0 && $case == 4){
                    $stm = $bdd -> prepare("UPDATE players SET y=y - 1, z = z + 1 WHERE pid = ? ");
                    $stm->execute([$pId]);
                }

                else if($etage == 1 && $case == 5){
                    $stm = $bdd -> prepare("UPDATE players SET y=y - 1, z = z - 1 WHERE pid = ? ");
                    $stm->execute([$pId]);
                }

                else if($etage == 1 && $case == 6){
                    $stm = $bdd -> prepare("UPDATE players SET y=y - 1, z = z + 1 WHERE pid = ? ");
                    $stm->execute([$pId]);
                }

                else if($etage == 2 && $case == 5){
                    echo 'GAME ECHEC';
                }
                break;
            case 2 :
                $case = strval($laby[$etage][$lig] [$col-1]);
                $_SESSION["direction"] = 'north';
                if($etage == 0 && $case == 4){
                    $stm = $bdd -> prepare("UPDATE players SET y=y - 1, z = z + 1 WHERE pid = ? ");
                    $stm->execute([$pId]);
                }

                else if($etage == 1 && $case == 5){
                    $stm = $bdd -> prepare("UPDATE players SET y=y - 1, z = z - 1 WHERE pid = ? ");
                    $stm->execute([$pId]);
                }

                else if($etage == 1 && $case == 6){
                    $stm = $bdd -> prepare("UPDATE players SET y=y - 1, z = z + 1 WHERE pid = ? ");
                    $stm->execute([$pId]);
                }

                else if($etage == 2 && $case == 5){
                    echo 'GAME ECHEC';
                }
                break;
                case 3 : // Avancer
                    $case = strval($laby[$etage][$lig] [$col-1]);
                    if(!in_array(strval($laby[$etage][$lig] [$col-1]), range(1,2))){ // liglision
                        // Update coordonnée
                        $stm = $bdd -> prepare("UPDATE players SET y=y - 1 WHERE pid = ? ");
                        $stm->execute([$pId]);
                    }  
                    
                    else if($etage == 1 && $case == 5){
                        $stm = $bdd -> prepare("UPDATE players SET y=y - 1, z = z - 1 WHERE pid = ? ");
                        $stm->execute([$pId]);
                    }

                    else if($etage == 1 && $case == 6){
                        $stm = $bdd -> prepare("UPDATE players SET y=y - 1, z = z + 1 WHERE pid = ? ");
                        $stm->execute([$pId]);
                    }

                    else if($etage == 2 && $case == 5){
                        echo 'GAME ECHEC';
                    }
                    break;
                case 4 : // Reculer
                    $case = strval($laby[$etage][$lig] [$col-1]);
                    if(!in_array(strval($laby[$etage][$lig] [$col+1]), range(1,2))){
                        $stm = $bdd -> prepare("UPDATE players SET y=y + 1 WHERE pid = ? ");
                        $stm->execute([$pId]);
                    } 
                    
                    else if($etage == 1 && $case == 5){
                        $stm = $bdd -> prepare("UPDATE players SET y=y - 1, z = z - 1 WHERE pid = ? ");
                        $stm->execute([$pId]);
                    }

                    else if($etage == 1 && $case == 6){
                        $stm = $bdd -> prepare("UPDATE players SET y=y - 1, z = z + 1 WHERE pid = ? ");
                        $stm->execute([$pId]);
                    }

                    else if($etage == 2 && $case == 5){
                        echo 'GAME ECHEC';
                    }
                    break;
                case 5 : // Basculer à gauche
                    if(!in_array(strval($laby[$etage][$lig+1] [$col]), range(1,2))){
                        $stm = $bdd -> prepare("UPDATE players SET x=x + 1 WHERE pid = ? ");
                        $stm->execute([$pId]);
                    }    
                    break;
                case 6 : // Basculer à droite
                    if(!in_array(strval($laby[$etage][$lig-1] [$col]), range(1,2))){
                        $stm = $bdd -> prepare("UPDATE players SET x=x - 1 WHERE pid = ? ");
                        $stm->execute([$pId]);
                    }
        }
        break;
        default : 
            echo 'Pas de direction !';
}
?>
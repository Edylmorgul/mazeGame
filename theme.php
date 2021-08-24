<?php
// 1. Récupération des informations
$theme = isset($_POST["theme"]) ? $_POST["theme"] : exit();

// La fonction PHP native glob() parcourt un dossier et stocke dans un tableau les noms des fichiers correspondant au pattern passé en paramètre.
// $images = glob('imgMaze/'.$theme.'*.png', GLOB_BRACE);
// $images = glob('imgMaze/BLUE*.png', GLOB_BRACE);

// 2. Recherche des images correspondant au thème
if($theme == "BLUE"){
    $images = glob('imgMaze/BLUE*.png', GLOB_BRACE);

    foreach($images as $image){
        echo $image.";";
    }
}

if($theme == "GREEN"){
    $images = glob('imgMaze/GREEN*.png', GLOB_BRACE);

    foreach($images as $image){
        echo $image.";";
    }
}

if($theme == "BRICK"){
    $images = glob('imgMaze/BRICK*.png', GLOB_BRACE);

    foreach($images as $image){
        echo $image.";";
    }
}

if($theme == "DROW"){
    $images = glob('imgMaze/DROW*.png', GLOB_BRACE);

    foreach($images as $image){
        echo $image.";";
    }
}

if($theme == "XANATHA"){
    $images = glob('imgMaze/XANATHA*.png', GLOB_BRACE);

    foreach($images as $image){
        echo $image.";";
    }
}
?>
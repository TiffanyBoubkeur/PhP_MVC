<?php

require_once 'lib/database.php';
require_once 'models/cocktails.php';

// CHECK INFOS FORM
if(empty($_POST) == false )
{
    // OUI : edition de cocktail, récupère données
    editerCocktail(
        $_POST['id'],
        $_POST['nom'],
        $_POST['description'],
        $_POST['anneeConception'],
        $_POST['prixMoyen'],
        $_POST['idFamille'] // Selected option
    );
    // Directed back-office
    header('Location : back_office.php');
}
else
{
    // NON : affichage template pour editer
    if(array_key_exists('id', $_GET) == false){
        // NON : Directed back-office
        header('Location : back_office.php');
    }

    // GET datas cocktail 
    $cocktail = lireCocktailSQL($_GET['id']);

    // Get datas famille
    $famillesCocktails = listerFamilleCocktails();

    include 'templates/edition_cocktail.phtml';
}

?>
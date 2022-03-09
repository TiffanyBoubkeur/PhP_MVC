<?php

require_once 'lib/database.php'; 
require_once 'models/cocktails.php';

// ID exist ? 

if(array_key_exists('id', $_GET) == true)
{

    // Oui : DELETE
    supprimerCocktail($_GET['id']);

}

// Back to BO
header('Location: back_office.php');


?>
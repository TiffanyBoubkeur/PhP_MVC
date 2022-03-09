<?php
// MON CONTROLEUR

// CONNEXION BDD MANDATORY (/!\ ONCE)

require_once 'lib/database.php';
require_once 'models/cocktails.php';

// GET datas of Cocktail Table
$cocktails = listerCocktails();

include('templates/index.phtml');


?>
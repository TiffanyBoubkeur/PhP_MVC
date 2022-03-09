<?php

require_once ('lib/database.php');
require_once ('models/cocktails.php'); 


// ALL datas Cocktail Table
$cocktails = listerCocktails();

include 'templates/back_office.phtml';
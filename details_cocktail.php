<?php

require_once('lib/database.php');
require_once('models/cocktails.php');

// DATAS of Cocktail Table for THE cocktail 
$cocktail = lireCocktailSQL($_GET['id']);

// Datas of Ingredient
$ingredientsCocktail = listerIngredientCocktails($_GET['id']);

include 'templates/details_cocktail.phtml';

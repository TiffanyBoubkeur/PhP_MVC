<?php
// LIEN VERS MA BDD


function connexionBDD(){
    // BDD path
    $dsn = 'mysql:host=localhost;dbname=cocktail;charset=utf8';

    //USER for connexion
    $user = 'root';

    // MDP BDD
    $password = 'root';

    //BDD Connexion
    $pdo = new PDO($dsn,$user,$password);

    // Manage error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $pdo;
};

/**
 * USEFUL LINKS :
 * 
 * ERROR : https://www.php.net/manual/en/pdo.setattribute.php
 */

?>
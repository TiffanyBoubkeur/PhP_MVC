<?php
// MON MODEL 



// ADD cocktails in BDD with INSERT
function ajouterCocktail($nom,$description,$urlPhoto,$anneeConception,$prixMoyen,$idFamille)
{

    // BDD CONNEXION 
    $pdo = connexionBDD();

    // SQL query

    $query = $pdo->prepare('
        INSERT INTO Cocktail
        (
            nom,
            description,
            urlPhoto,
            dateConception,
            prixMoyen,
            idFamille
        )
        VALUES
        (
            ?,?,?,?,?,?
        )
    ');

    // Date au bon format pour la BDD
    $dateConception = "$anneeConception-01-01";

    // EXECUTE query
    $query->execute(
    [
        $nom,
        $description,
        $urlPhoto,
        $dateConception,
        $prixMoyen,
        $idFamille
    ]);

};



// EDIT with UPDATE
function editerCocktail($id,$nom,$description,$anneeConception,$prixMoyen,$idFamille){
    // BDD CONNEXION 
    $pdo = connexionBDD();
    
    // SQL query
    $query = $pdo->prepare('
        UPDATE Cocktail SET
            nom = ?, 
            description = ?, 
            dateConception = ?, 
            prixMoyen = ?, 
            idFamille = ?
        WHERE id = ?
    ');

    // Date au bon format pour la BDD
    $dateConception = "$anneeConception-01-01";

    // Execute query
    $query->execute(
    [
        $nom, 
        $description, 
        $dateConception, 
        $prixMoyen, 
        $idFamille, 
        $id
    ]);
};



// READ with SELECT query
function lireCocktailSQL($id)
{
    
    // BDD CONNEXION 
    $pdo = connexionBDD();

    // SQL query
    $query = $pdo->prepare('
        SELECT
            Cocktail.id, 
            idFamille, 
            nom, 
            nomFamille, 
            description, 
            urlPhoto, 
            YEAR(dateConception) AS anneeConception, 
            prixMoyen
        FROM Cocktail
        INNER JOIN Famille ON Famille.id = Cocktail.idFamille
        WHERE Cocktail.id = ?
    ');
    //? pour  prévenir des injections SQL

    // Execution SQL query
    $query->execute([$id]);

    // Get INFOS array
    return $query->fetch(PDO::FETCH_ASSOC);
};



// Get datas of Cocktail Table
function listerCocktails(){
    // BDD CONNEXION 
    $pdo = connexionBDD();

    // SQL Query
    $query = $pdo->prepare('
        SELECT
            Cocktail.id, 
            nom, 
            nomFamille, 
            description, 
            urlPhoto, 
            YEAR(dateConception) AS anneeConception, 
            prixMoyen
        FROM Cocktail
        INNER JOIN Famille ON Famille.id = Cocktail.idFamille
    ');

    // Execute SQL
    $query->execute();

    // Get INFOS array
    return $query->fetchAll(PDO::FETCH_ASSOC);
};


// Get datas of Famille Table
function listerFamilleCocktails()
{
    // BDD CONNEXION 
    $pdo = connexionBDD();

    //SQL query
    $query = $pdo->prepare('
        SELECT
            id,
            nomFamille
        FROM Famille
    ');
    
    //execute query
    $query->execute();

    //get datas
    return $query->fetchAll(PDO::FETCH_ASSOC);
};



// Get datas of Ingredient Table
function listerIngredientCocktails($idCocktail)
{
    // BDD CONNEXION 
    $pdo = connexionBDD();

    // SQL query
    $query = $pdo->prepare('
        SELECT
            nom
        FROM Ingredient
        INNER JOIN Cocktail_Ingredient ON Ingredient.id = Cocktail_Ingredient.IdIngredient
        WHERE Cocktail_Ingredient.idCocktail = ?
    ');
    
    // Execute SQL
    $query->execute([$idCocktail]);

    // Get datas
    return $query->fetchAll(PDO::FETCH_ASSOC);
};



// DELETE Cocktail
function supprimerCocktail($id)
{
    // BDD CONNEXION 
    $pdo = connexionBDD();

    // SQL query
    $query = $pdo->prepare('
        DELETE FROM Cocktail
        WHERE id = ?
    ');

    // Execute SQL
    $query->execute([$id]);
};

?>

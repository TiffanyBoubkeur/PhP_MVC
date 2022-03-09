<?php
require_once 'lib/database.php';
require_once 'models/cocktails.php';

// GET data FORM
if(empty($_POST)==false)
{
    // OUI : get datas FORM

    /******* PARTIE 1 PHOTO *********/

    // Upload Photo
    $urlPhoto = null;
    if(array_key_exists('urlPhoto', $_FILES) == true)
    {
        // upload ok?
        if($_FILES['urlPhoto']['error'] == UPLOAD_ERR_OK)
        {
            // OUI : vérif du fichier
            // JPG ??
            if($_FILES['urlPhoto'] ['type'] == 'image/jpeg')
            {
                // File name
                $photoFileName = basename($_FILES['urlPhoto']['name']);

                // ID UNIQUE (le name vient du user dc possible existe déjà)
                $photoFileName = uniqid() . "-$photoFileName";

                // MOVE FILE
                $destination = __DIR__ . "/www/images/cocktails/$photoFileName";

                // TO SERVER with temporary name
                if(move_uploaded_file($_FILES['urlPhoto']['tmp_name'], $destination) == true)
                {
                    //upload in BDD
                    $urlPhoto = $photoFileName;
                }

            }

        }
    }

        /******* PARTIE 2 INFOS *********/ 

        // Get datas FORM
    ajouterCocktail(
        $_POST['nom'],
        $_POST['description'],
        $urlPhoto,
        $_POST['anneeConception'],
        $_POST['prixMoyen'],
        $_POST['idFamille']
    
    );

    // redirect to index
    header('Location: index.php');


}
else
{

    // NON : template add cocktail
    // get datas Famille
    $famillesCocktails = listerFamilleCocktails();


    include 'templates/ajout_cocktail.phtml';
}




/***
 * USEFUL LINKS
 * upload error :  https://www.php.net/manual/fr/features.file-upload.errors.php
 * 
 * basename() : https://www.php.net/manual/fr/function.basename.php
 * 
 * uniqid(): https://www.php.net/manual/fr/function.uniqid
 * 
 * move file : https://www.php.net/manual/fr/function.move-uploaded-file.php
 * 
 * $_FILES : https://www.php.net/manual/fr/features.file-upload.post-method.php
 */


?>
<?php
require "../classes/Annonces.php";

/*
function getAnnoncesCount(){
    $annonceModel = new Annonces();
    $annonceCount = $annonceModel->countAnnonce();

}
*/

function displayAllGames(){
    $annoncesModel = new Annonces();
    $annonces = $annoncesModel->getAllGames();
    if($annoncesModel){
        require "../public/annonces.php";
    }
}

function getGameDetails()
{
    $annoncesModel = new Annonces();
    $details_annonces = $annoncesModel->getGamesById($_GET['id']);
    require "../public/details_annonces.php";
}

function addOneAnnonce($title, $description, $price, $imgurl, $stock, $date_depot){
    $annoncesModel = new Annonces();
    $add_annonces = $annoncesModel->addAnnonces($title, $description, $price, $imgurl, $stock, $date_depot);
}

function confirmAnnonce()
{
    $annoncesModel = new Annonces();
    $details_annonces = $annoncesModel->getGamesById($_GET['id']);
    require "../public/edit_annonce.php";
}

function updateOneAnnonce($title, $description, $price,$imgurl, $stock, $date_depot ,$id){
    $annonceModel = new Annonces();
    $updateAnnonce = $annonceModel->updateAnnonce($title, $description, $price,$imgurl, $stock, $date_depot ,$id);
    if($id === null){
        echo "Ancun id trouvé pour ce jeux";
    }
}

function deleteOneAnnonce(){
    $annonceModel = new Annonces();
    $deleteGameId = $annonceModel->deleteAnnonce($_GET['id']);
    require "../public/deleteAnnonce.php";
}

function confirmDeleteAnnonce(){
    $annonceModel = new Annonces();
    $deleteGameById = $annonceModel->confirmDeleteAnnonce();
    header("Location:http://localhost/Mailtrap/public/index.php?action=annonces");
}

function getAnnoncePDF(){
    $annonceModel = new Annonces();
    $myPDF = $annonceModel->generatePDF($_GET['id']);
}



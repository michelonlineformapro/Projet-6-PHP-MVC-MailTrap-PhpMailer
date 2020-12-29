<meta charset="UTF-8">
<?php
require "../Controllers/MixedGamesController.php";

//Appel du template
ob_start();



//Recup des url avec GET
if(isset($_GET['action'])) {
    //Si annonces = page d'accueil
    if ($_GET['action'] === "annonces_page") {
        $title = "ANNONCES ACCUEIL";
        displayAllGames();
        //Fonction depuis le controller
        //Jeu par id
    } elseif ($_GET['action'] === "details_annonce") {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $title = "ANNONCES DETAILS ANNONCE";
            getGameDetails();
        }
        //Formulaire de creation d'annonce et envoi email
    }elseif ($_GET['action'] === "ajouter_annonce"){
        $title = "ANNONCES VALIDER ANNONCE";
        require "ajouter_annonce.php";
        if(isset($_POST['title'], $_POST['description'], $_POST['price'], $_POST['imgurl'], $_POST['stock'], $_POST['date_depot'])){
            addOneAnnonce($_POST['title'], $_POST['description'], $_POST['price'], $_POST['imgurl'], $_POST['stock'], $_POST['date_depot']);
            require "sendCreationMail.php";
            header("location:http://localhost/Mailtrap/public/index.php?action=info_email");
        }

    }elseif ($_GET['action'] === "edit_annonce") {
        $title = "ANNONCES EDITER";
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            confirmAnnonce();
        }
    }elseif ($_GET['action'] === "info_email"){
        $title = "ANNONCES ENVOI EMAIL";
        require "info_email.php";

    }elseif ($_GET['action'] === "admin_annonce"){
        $title = "ANNONCE GERER";
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            confirmAnnonce();
        }
        require "sendAdminMail.php";
        if(isset($_POST['title'], $_POST['description'], $_POST['price'], $_POST['imgurl'], $_POST['stock'], $_POST['date_depot'], $_GET['id'])){
            updateOneAnnonce($_POST['title'], $_POST['description'], $_POST['price'], $_POST['imgurl'], $_POST['stock'], $_POST['date_depot'], $_GET['id']);

        }else{
            echo "<p class='alert-danger p-3'>Erreur de mise a jour de l'annonces</p>";
        }


    }elseif ($_GET['action'] === "delete_annonce"){
        $title = "ANNONCE SUPPRIMER";
        if(isset($_GET['id']) && $_GET['id'] > 0){
            deleteOneAnnonce();
            confirmDeleteAnnonce();
        }
    }elseif ($_GET['action'] === "confirmdelete"){
        confirmDeleteAnnonce();
    }elseif ($_GET['action'] === "generate_pdf"){
        getAnnoncePDF();
    }


}else{
    require "error404.php";
}


$content = ob_get_clean();
require "template.php";


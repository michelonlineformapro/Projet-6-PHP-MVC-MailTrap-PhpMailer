<?php
//Install
//composer require phpmailer/phpmailer
//Appel depuis le vendor namespace
//Autoloader de classe si non trouvée
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require '../vendor/autoload.php';


//Insatnce de la classe phpmailer
$mail = new PHPMailer();
try {
    //Config pour mailtrap
    $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Autorise le debug
    $mail->isSMTP(); //Utilisation du service mail transfer protocole
    $mail->Host = 'smtp.mailtrap.io'; //Appel du host mailtrap
    $mail->SMTPAuth = true; //Autorise et impose un user name + password
    $mail->Username = '1e9a0eeda636b9'; //Generer lors de la création du compte mail Trap
    $mail->Password = '64faa6d7e0bd01'; // Idem pour le mot de passe
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //La Transport Layer Security (TLS) ou « Sécurité de la couche de transport »
    $mail->Port = 2525; //Port pour mailtrap sinon ->587 ou 465 pour `PHPMailer::ENCRYPTION_SMTPS`
    $mail->setLanguage('fr', '../vendor/phpmailer/phpmailer/language/');

    //Envoyeur et destinataire
    $mail->setFrom('annonces@videogames.com', 'Annonces Administration');
    $mail->addAddress('annonces@videogames.com', 'Administrateur Annonces Games.com');
    $mail->addReplyTo('annonces@videogames.com', 'Annonces Administration');
    //Connexion et requete PDO get by ID
    $user = "root";
    $pass = "";
    $db = new PDO("mysql:host=localhost;dbname=phpmvc;charset=utf8;", $user, $pass);
    $query = "SELECT * FROM mixedgames";
    $req = $db->query($query);


    //Contenu du mail
    $mail->isHTML(true);
    $mail->Subject = "Validation de votre annoncesGames.com";
    //Boucle de lecture pour retrouver le token ID
    while ($datas = $req->fetch()) {
        //Stock de l'id dans une variable
        $emailId = $datas['id'];
        //Url du liens de validation
        $url = "http://localhost/Mailtrap/public/index.php?action=delete_annonce&id=$emailId";
        //Contenus du mail
        $mail->Body = '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html">
        <title>Votre annonce chez annonces-games.com</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body style="background-color: #1D2326; color: #F0F1F2;">
    <div style="background-color: #F0F1F2; color: #1D2326; padding: 20px;">
        <img src="https://qiwo-indie-games.alwaysdata.net/assets/images/2.jpg" style="display: block; border-radius: 100%" width="50px" height="50px">
        <h3 style="color: #1D2326">ANNONCES-GAMES.COM</h3>
        <!--INFOS DE DEBUG -->
        <p>ICI URL DU JEUX CREER : ' . $url . '</p>
        <p>ICI ID DU JEUX CREER : ' . $emailId . '  </p>
    </div>
    <div style="padding: 20px;">
        <h1>Annonce-games.com</h1>
        <p>Vous avez déposé une une annonce sur annonce-games.com, merci de valider cette annonce avec le liens suivant</p><br />
        <a href="' . $url . '" style="background-color: darkred; color: #F0F1F2; padding: 20px; text-decoration: none;">Supprimer votre annonce</a><br />
        <br />
        <p>Merci d\'utiliser notre site web</p>
        <p>Cordialement : Anoonce-games.com Administrateur</p>    
    </div>
    </body>
    </html>
    ';
    }
    $mail->send();
    echo "<p class='alert-success p-3'>Le mail à été envoyé</p>";
    echo "<a href='index.php?action=annonces' class='btn btn-outline-info'>Retour aux annonces</a>";
    header("location:http://localhost/Mailtrap/public/index.php?action=info_email");
}catch (Exception $e){
    echo "<p class='alert-danger p-3'>Erreur lors de la tentative d'envoi de l'email {$mail->ErrorInfo}</p>";
}


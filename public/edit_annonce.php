
<div class="left-content container">
    <div class="row">
        <div class="col">
            <h2 class="text-info"><?= $details_annonces['title'] ?></h2>
            <div class="col-2">
                <img class="img-thumbnail img-annonces" src="<?= $details_annonces['imgurl'] ?>" alt="<?= $details_annonces['title'] ?>" title="<?= $details_annonces['title'] ?>">
            </div>
            <div class="col-10">
                <h3 class="text-info"><?= $details_annonces['title'] ?></h3>
                <h5 class="text-danger"><?= $details_annonces['description'] ?></h5>
                <p>
                    <b class="text-info">PRIX : </b><?= $details_annonces['price'] ?> €
                </p>
                <p>
                    En stock :
                    <?php
                    if($details_annonces['stock'] === 0){
                        echo "NON";
                    }else{
                        echo "OUI";
                    }
                    ?>
                </p>
                <p>
                    <?php
                    $date = new DateTime($details_annonces['date_depot']);
                    ?>
                    Posté le : <em><?= $date->format("d-m-Y") ?></em>
                </p>
                <br>
                <a class="btn btn-outline-success" href="">ACHETER</a>
                <a class="btn btn-outline-info" href="index.php?action=annonces">Retour au annonces</a>
            </div>
        </div>
        <div class="col">
            <form action="index.php?action=admin_annonce&id=<?= $details_annonces['id'] ?>" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="title" class="form-label">Nom du jeux</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="<?= $details_annonces['title'] ?>">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description du jeux</label>
                    <textarea class="form-control" rows="4" id="description" name="description" placeholder="<?= $details_annonces['description'] ?>"></textarea>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Prix du jeux</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="<?= $details_annonces['price'] ?>">
                </div>

                <div class="mb-3">
                    <label for="imgurl" class="form-label">Imagedu jeux</label>
                    <input type="file" class="form-control" id="imgurl" name="imgurl">
                </div>

                <div class="mb-3">
                    <label for="stock" class="form-label">En stock</label>
                    <select class="form-select" aria-label="stock" name="stock">
                        <option selected>Le produit est il en stock</option>
                        <option value="0">NON</option>
                        <option value="1">OUI</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="start">Date de visibilité</label>
                    <input type="date" id="start" name="date_depot" placeholder="<?= $details_annonces['date_depot'] ?>">
                </div>
                <button id="submit" type="submit" class="btn btn-outline-success">Confirmer et publié votre annonce</button>
                <br>
                <em class="text-danger">Suite à la création de votre annonce, un email va vous être envoyé pour la validé et pour pourvoir la supprimer</em>
            </form>
        </div>

    </div>
</div>


<?php
//Upload image
if(isset($_FILES['imgurl'])) {
    $imgurl = $_POST['imgurl'];

    $target_dir = "../assets/img/";
    $target_file = $target_dir . basename($_FILES["imgurl"]["name"]);
    $_POST['imgurl'] = $target_file;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["imgurl"]["tmp_name"]);
        if ($check !== false) {
            echo "Image valide - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "Image invalide";
            $uploadOk = 0;
        }
    }

// Si image existe deja
    if (file_exists($target_file)) {
        echo "L'image existe déja, merci de changer de nom.";
        $uploadOk = 0;
    }

// Check la taille
    if ($_FILES["imgurl"]["size"] > 500000) {
        echo "Votre image est trop lourde.";
        $uploadOk = 0;
    }

// Format de l'image
    if ($imageFileType !== "jpg" && $imageFileType !== "png" && $imageFileType !== "jpeg"
        && $imageFileType !== "gif") {
        echo "Désolé seulement les formats JPG, JPEG, PNG & GIF sont autorisé.";
        $uploadOk = 0;
    }

// Si image a passé les 3 tests de validation
    if ($uploadOk === 0) {
        echo "Désolé l'image est invalide";
        // Si tous est ok
    } else {
        //On transforme $_FILES (qui est un tableau) en chaine de caratères => $_POST['imgurl']
        if (move_uploaded_file($_FILES["imgurl"]["tmp_name"], $target_file)) {

            echo "Le fichier " . htmlspecialchars(basename($_FILES["imgurl"]["name"])) . " à été télécharger.";
        } else {
            echo "Désolé une erreur est survenue lors du chargement de l'image.";
        }
    }
}
?>


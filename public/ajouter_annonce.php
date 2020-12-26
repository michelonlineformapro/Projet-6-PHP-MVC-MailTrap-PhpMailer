<div class="container left-content mt-5">
    <h1 class="text-center text-info">Ajouter une annonce</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Nom du jeux</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description du jeux</label>
            <textarea class="form-control" rows="4" id="description" name="description" placeholder="Description du jeux"></textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Prix du jeux</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="450,25 €">
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
            <input type="date" id="start" name="date_depot">
        </div>

        <button id="submit" type="submit" class="btn btn-outline-success">Valider</button>
        <br>
        <em class="text-danger">Suite à la création de votre annonce, un email va vous être envoyé pour la validé</em>
    </form>
</div>

<?php
//SYSTEME UPLOAD IMAGE


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

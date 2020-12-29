<?php
?>

<div class="left-content container">
    <?php
    ?>
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
        <a class="btn btn-outline-info" href="index.php?action=annonces_page">Retour au annonces</a>
        <a class="btn btn-outline-danger" target="_blank" href="index.php?action=generate_pdf&id=<?= $details_annonces['id'] ?>">FORMAT PDF</a>
    </div>
</div>





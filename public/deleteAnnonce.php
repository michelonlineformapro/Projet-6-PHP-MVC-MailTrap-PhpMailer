
<div class="container left-content">
    <h1 class="text-danger text-center">Supprimer l'annonce</h1>
    <div class="col-6 text-center">
        <h2 class="text-info"><?= $deleteGameId['title'] ?></h2>
        <img width="25%" class="img-fluid" src="<?= $deleteGameId['imgurl'] ?>" alt="<?= $deleteGameId['title'] ?>" title="<?= $deleteGameId['title'] ?>">
    </div>
    <div class="col-6 games-data">
        <p><b>Description du jeux :</b> <?= $deleteGameId['description'] ?></p>
        <p><b>Prix :</b><?= $deleteGameId['price'] ?> € </p>
        <?php
        $date = new DateTime($deleteGameId['date_depot']);
        ?>
        <p>Posté le : <em><?= $date->format('d-m-Y') ?></em></p>
        <a href="index.php?action=confirmdelete" class="btn btn-warning">Confrimer la supression ?</a>
        <a href="index.php?action=games" class="btn btn-warning">Retour</a>
    </div>
    <?php

    ?>
</div>


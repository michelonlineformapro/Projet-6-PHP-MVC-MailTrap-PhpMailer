
<div class="container left-content">
    <div class="text-center">
        <a class="btn btn-outline-danger" href="index.php?action=ajouter_annonce">Ajouter une annonce</a>
    </div>

    <h1 class="text-danger">Liste des jeux</h1>
    <div class="row">
                <div class="col-9">
                    <div class="row">
                        <?php
                        while ($datas = $annonces->fetch()){
                            ?>
                        <div class="col-2">
                            <img class="img-thumbnail img-annonces" src="<?= $datas['imgurl'] ?>" alt="<?= $datas['title'] ?>" title="<?= $datas['title'] ?>">
                        </div>
                        <div class="col-10">
                            <h3 class="text-info"><?= $datas['title'] ?></h3>
                            <h5 class="text-danger"><?= $datas['description'] ?></h5>
                            <p>
                                <b class="text-info">PRIX : </b><?= $datas['price'] ?> €
                            </p>
                            <p>
                                En stock :
                                <?php
                                    if($datas['stock'] === 0){
                                        echo "NON";
                                    }else{
                                        echo "OUI";
                                    }
                                ?>
                            </p>
                            <p>
                                <?php
                                $date = new DateTime($datas['date_depot']);
                                ?>
                                Posté le : <em><?= $date->format("d-m-Y") ?></em>
                            </p>

                            <a class="btn btn-outline-success" href="index.php?action=details_annonce&id=<?= $datas['id'] ?>">Plus d'infos</a>
                        </div>

                            <hr class="m-3 line-separation">

                        <?php
                        }
                        ?>
                    </div>
                </div>


        <div class="col-3">
            <div class="card">
                <img src="../assets/img/zelda.jpg" class="img-thumbnail img-fluid card-img-top" alt="<?= $datas['title'] ?>" title="<?= $datas['title'] ?>">
                <div class="card-body">
                    <h5 class="card-title">
                        ZELDA
                    </h5>
                    <p class="card-text">
                        <b>Description :</b>
                    <p>
                        Le jeux d'aventure de Nintendo
                    </p>
                    </p>
                    <p class="card-text">
                        <b>PRIX : </b>451.25 €
                    </p>
                    <a href="#" class="btn btn-outline-info">ACHETER</a>
                </div>
            </div>
            <br />
            <div class="card">
                <img src="../assets/img/dark.jpg" class="img-thumbnail img-fluid card-img-top" alt="<?= $datas['title'] ?>" title="<?= $datas['title'] ?>">
                <div class="card-body">
                    <h5 class="card-title">
                        DARK SOULS 3
                    </h5>
                    <p class="card-text">
                        <b>Description :</b>
                    <p>
                        Le jeux de survie du studio from software
                    </p>
                    </p>
                    <p class="card-text">
                        <b>PRIX : </b>7845.25 €
                    </p>
                    <a href="#" class="btn btn-outline-info">ACHETER</a>
                </div>
            </div>

        </div>
    </div>
</div>

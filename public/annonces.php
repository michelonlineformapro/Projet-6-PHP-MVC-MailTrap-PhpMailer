
<div class="container left-content">
    <div class="text-center">
        <a class="btn btn-outline-danger" href="index.php?action=ajouter_annonce">Ajouter une annonce</a>
    </div>
</div>


<div class="left-content">
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
                            <br>
                            <a class="btn btn-outline-success" href="index.php?action=details_annonce&id=<?= $datas['id'] ?>">Plus d'infos</a>
                        </div>

                            <hr class="m-3 line-separation">

                        <?php
                        }
                        ?>
                    </div>
                </div>
        <div class="col-3">
            <div class="card" style="width: 18rem;">
                <img src="https://images-na.ssl-images-amazon.com/images/I/61NvkintSkL._AC_.jpg" class="img-thumbnail img-fluid card-img-top" alt="<?= $datas['title'] ?>" title="<?= $datas['title'] ?>">
                <div class="card-body">
                    <h5 class="card-title">
                        Aladin MEGADRIVE
                    </h5>
                    <p class="card-text">
                        <b>Description :</b>
                    <p>
                        Aladdin est un jeu vidéo de plates-formes développé et édité par Virgin Interactive en 1993 sur Mega Drive. Des versions Amiga 1200, DOS, Game Boy et NES ont également vu le jour. Le jeu a été réalisé d'après le personnage du même nom de Walt Disney Pictures.
                    </p>
                    </p>
                    <p class="card-text">
                        458.35 €
                    </p>
                    <a href="#" class="btn btn-outline-info">ACHETER</a>
                </div>
            </div>
        </div>



    </div>
</div>

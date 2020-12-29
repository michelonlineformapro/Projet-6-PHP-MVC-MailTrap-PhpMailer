
<div class="container left-content">
    <div class="text-center">
        <a class="btn btn-outline-danger" href="index.php?action=ajouter_annonce">Ajouter une annonce</a>
    </div>

    <h1 class="text-danger">Liste des jeux</h1>
    <div class="row">
                <div class="col-9">
                    <div class="row">
                        <?php
                       foreach ($annonces as $datas){
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

                        <!--Pagination-->

                        <nav>
                            <ul class="pagination">
                                <?php
                                $user = "root";
                                $pass = "";
                                $db = new PDO("mysql:host=localhost;dbname=phpmvc;charset=utf8", $user, $pass);
                                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $query = "SELECT COUNT(*) AS nb_annonces FROM mixedgames";
                                $req = $db->prepare($query);
                                $req->execute();
                                $result = $req->fetch();
                                $parPage = 5;
                                $currentPage = 1;
                                $nbAnnonces = (int) $result['nb_annonces'];
                                $pages = ceil($nbAnnonces / $parPage);
                                ?>
                                <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
                                <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                                    <a href="index.php?action=annonces_page&page=<?= $currentPage -= 1 ?>" class="page-link">Précédente</a>
                                </li>
                                <?php for($page = 1; $page <= $pages; $page++): ?>
                                    <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
                                    <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                                        <a href="index.php?action=annonces_page&page=<?= $page ?>" class="page-link"><?= $page ?></a>
                                    </li>
                                <?php endfor ?>
                                <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
                                <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
                                    <a href="index.php?action=annonces_page&page=<?= $currentPage += 1 ?>" class="page-link">Suivante</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>


        <div class="col-3">
            <div class="card">
                <img src="../assets/img/zelda.jpg" class="img-thumbnail img-fluid card-img-top" alt="Zelda BOTW" title="Zelda BOTW">
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
                <img src="../assets/img/dark.jpg" class="img-thumbnail img-fluid card-img-top" alt="Dark Souls 3" title="Dark Souls 3">
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

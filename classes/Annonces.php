<?php


class Annonces
{
    public function getPDO(){
        $user = "root";
        $pass = "";
        try {
            $db = new PDO("mysql:host=localhost;dbname=phpmvc;charset=utf8;", $user, $pass);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "<h3 class='mt-5 container text-center alert-success p-2'>CONNEXION A PDO</h3>";

        }catch (PDOException $e){
            echo "Erreur de connexion a PDO MySQL " .$e->getMessage();
        }
        return $db;
    }

    public function getAllGames(){
        $db = $this->getPDO();
        $query = "SELECT * FROM mixedgames";
        $req = $db->query($query);
        return $req;
    }

    function  getGamesById($gameId){
        $db = $this->getPDO();
        $query = "SELECT * FROM mixedgames WHERE id = ?";
        $req = $db->prepare($query);
        $req->execute(array($gameId));
        $details_annonces = $req->fetch();
        return $details_annonces;
    }

    function addAnnonces($title, $description, $price, $imgurl, $stock, $date_depot){
        $db = $this->getPDO();
        $query = "INSERT INTO mixedgames (title, description, price, imgurl, stock, date_depot) VALUES (?,?,?,?,?,?)";
        $req = $db->prepare($query);
        $req->bindParam(1, $title);
        $req->bindParam(2, $description);
        $req->bindParam(3, $price);
        $req->bindParam(4, $imgurl);
        $req->bindParam(5, $stock);
        $req->bindParam(6, $date_depot);
        $res = $req->execute(array($title, $description, $price, $imgurl, $stock, $date_depot));
        return $res;
    }

    function updateAnnonce($title, $description, $price, $imgurl, $stock, $date_depot, $id){
        $db = $this->getPDO();
        $query = "UPDATE mixedgames SET title = ?, description = ?, price = ?, imgurl = ?, stock = ?, date_depot = ? WHERE id = ?";
        $req = $db->prepare($query);
        $req->execute(array($title, $description, $price, $imgurl, $stock, $date_depot, $id));
        $id = $req->fetch();
        return $id;
    }

    public function deleteAnnonce($deleteAnnonceId){
        $db = $this->getPDO();
        $query = "SELECT * FROM mixedgames WHERE id = ?";
        $req = $db->prepare($query);
        $req->execute(array($deleteAnnonceId));
        $deleteGameId = $req->fetch();
        return $deleteGameId;
    }

    //Confirmer la supression du jeux
    function confirmDeleteAnnonce(){
        $db = $this->getPDO();
        $query = "DELETE FROM mixedgames WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1, $_GET['id']);
        $stmt->execute(array($_GET['id']));
        return $stmt;
    }
}

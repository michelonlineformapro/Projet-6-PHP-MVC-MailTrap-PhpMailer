<?php


class Annonces
{
    public function getPDO(){
        $user = "root";
        $pass = "";
        try {
            $db = new PDO("mysql:host=localhost;dbname=phpmvc;charset=utf8", $user, $pass);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "<h3 class='mt-5 container text-center alert-success p-2'>CONNEXION A PDO</h3>";

        }catch (PDOException $e){
            echo "Erreur de connexion a PDO MySQL " .$e->getMessage();
        }
        return $db;
    }
    //Compter le nombre d'annonce
    public function countAnnonce(){

    }

    //Afficher tous les annones

    public function getAllGames(){

        $db = $this->getPDO();
        $query = "SELECT * FROM mixedgames LIMIT :premier, :parpage";
        $req = $db->prepare($query);
        $parPage = 5;
        if(isset($_GET['page']) && $_GET['page'] > 0){
            $currentPage = $_GET['page'];
        }else{
            $currentPage = 1;
        }
        $premier = ($currentPage * $parPage) - $parPage;

        $req->bindValue(':premier', $premier, PDO::PARAM_INT);
        $req->bindValue(':parpage', $parPage, PDO::PARAM_INT);
        $req->execute();
        $req->fetch(PDO::FETCH_ASSOC);
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

    function generatePDF($gameId){
        ob_get_clean();
        //Instance de la classe
        require "../assets/FPDF/fpdf.php";
        $db = $this->getPDO();
        $query = "SELECT * FROM mixedgames WHERE id = ?";
        $req = $db->prepare($query);
        $req->execute(array($gameId));
        $details_annonces = $req->fetch();

        $title = $details_annonces['title'];
        $description = $details_annonces['description'];
        $price = $details_annonces['price'];
        $image = $details_annonces['imgurl'];
        $stock = $details_annonces['stock'];

        if($stock === 0){
            $stock =  "NON";
        }else{
            $stock =  "OUI";
        }

        $date = new DateTime($details_annonces['date_depot']);
        ?>
        <meta charset="UTF-8">
        <?php
        ob_get_clean();
        $pdf = new FPDF();
        //Sortie
        $pdf->AddPage();
        //Header
        $pdf->Image('../assets/img/logo.png');

        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(40,10,'Votre annonces');
        $pdf->Ln(10);
        $pdf->Cell(190,10,'Nom du jeux : '.$title);
        $pdf->Ln(10);
        $pdf->Image(''.$image, 10, 130, 70,100);
        $pdf->Ln(10);
        $pdf->SetFont('Arial','',12);
        $pdf->MultiCell(190,10,'Description du jeux : '.utf8_decode($description), 1, 'L');
        $pdf->Ln(10);
        $pdf->Cell(190,10,'Prix du jeux : '.$price. ' EUROS');
        $pdf->Ln(10);
        $pdf->Cell(190,10,'Jeux en stock : '.$stock);
        $pdf->Ln(10);
        $pdf->Cell(190,10,'Date : '.$date->format("d-m-Y"));
        $pdf->Output('','annonces.pdf',true);
    }
}

<?php
class Publication extends Modele{

    public function publications(){
        $requete = $this->getBdd()->prepare("SELECT * FROM publications LEFT JOIN utilisateurs USING(idUtilisateur) LEFT JOIN postes USING(idposte) ORDER BY datePublication DESC");
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function newPublication($contenu, $date, $idUtilisateur){
        $requete = $this->getBdd()->prepare("INSERT INTO publications(contenuPublication, datePublication, idUtilisateur, typePublication) VALUES(?, ?, ?, ?)");
        if($_POST["typePost"] == 'annonce'){
            $typePublication = 'annonce';
        }else{
            $typePublication = 'post';
        }
        $requete->execute([$contenu, $date, $idUtilisateur, $typePublication]);
    }

    public function reponses($idPublication){
        $requete = $this->getBdd()->prepare("SELECT * FROM reponses LEFT JOIN utilisateurs USING(idUtilisateur) WHERE idPublication = ?");
        $requete->execute([$idPublication]);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function repondrePublication($idPublication, $reponse, $idUtilisateur){
        $requete = $this->getBdd()->prepare("INSERT INTO reponses(idPublication, reponse, idUtilisateur) VALUES(?, ?, ?)");
        $requete->execute([$idPublication, $reponse, $idUtilisateur]);
    }

    public function like($idPublication){
        $requete = $this->getBdd()->prepare("SELECT jaime FROM publications WHERE idPublication = ?");
        $requete->execute([$idPublication]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    public function jaime($idPublication){
        $like = $this->like($idPublication)["jaime"];
        $requete = $this->getBdd()->prepare("UPDATE publications SET jaime = ? WHERE idPublication = ?");
        $requete->execute([$like+1 ,$idPublication]);

        $requete = $this->getBdd()->prepare("INSERT INTO jaime(idUtilisateur, idPublication) VALUES(?, ?)");
        $requete->execute([$_SESSION["idUtilisateur"], $_POST["buttonJaime"]]);
    }

    public function removeJaime($idPublication){
        $like = $this->like($idPublication)["jaime"];
        $requete = $this->getBdd()->prepare("UPDATE publications SET jaime = ? WHERE idPublication = ?");
        $requete->execute([$like-1 ,$idPublication]);

        $requete = $this->getBdd()->prepare("DELETE FROM jaime WHERE idUtilisateur = ? AND idPublication = ?");
        $requete->execute([$_SESSION["idUtilisateur"], $_POST["buttonJaime"]]);
    }

    public function recuperationJaimes($idUtilisateur, $idPublication){
        $requete = $this->getBdd()->prepare("SELECT * FROM jaime WHERE idUtilisateur = ? AND idPublication = ?");
        $requete->execute([$idUtilisateur, $idPublication]);
        return $requete->rowCount();
    }
}


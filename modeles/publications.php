<?php
class Publication extends Modele{
    // Permet l'affichage des publications qui sont en BDD
    public function publications(){
        $requete = $this->getBdd()->prepare("SELECT * FROM publications LEFT JOIN utilisateurs USING(idUtilisateur) LEFT JOIN postes USING(idposte) ORDER BY datePublication DESC");
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Permet de créer une nouvelle publication et de gérer son BG en fonction du type de publication
    public function newPublication($contenu, $date, $idUtilisateur){
        $requete = $this->getBdd()->prepare("INSERT INTO publications(contenuPublication, datePublication, idUtilisateur, typePublication) VALUES(?, ?, ?, ?)");
        if($_POST["typePost"] == 'annonce'){
            $typePublication = 'annonce';
        }else{
            $typePublication = 'post';
        }
        $requete->execute([$contenu, $date, $idUtilisateur, $typePublication]);
    }

    // Permet l'affichage des commentaires d'une publication
    public function reponses($idPublication){
        $requete = $this->getBdd()->prepare("SELECT * FROM reponses LEFT JOIN utilisateurs USING(idUtilisateur) WHERE idPublication = ?");
        $requete->execute([$idPublication]);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    //Permet d'insérer en BDD la réponse à une publication
    public function repondrePublication($idPublication, $reponse, $idUtilisateur){
        $requete = $this->getBdd()->prepare("INSERT INTO reponses(idPublication, reponse, idUtilisateur) VALUES(?, ?, ?)");
        $requete->execute([$idPublication, $reponse, $idUtilisateur]);
    }

    // Permet l'affichage du nombre de j'aime d'une publication
    public function like($idPublication){
        $requete = $this->getBdd()->prepare("SELECT jaime FROM publications WHERE idPublication = ?");
        $requete->execute([$idPublication]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    // Permet d'incrémenter un j'aime en BDD si l'utilisateur n'a pas déjà liké
    public function jaime($idPublication){
        $like = $this->like($idPublication)["jaime"];
        $requete = $this->getBdd()->prepare("UPDATE publications SET jaime = ? WHERE idPublication = ?");
        $requete->execute([$like+1 ,$idPublication]);

        $requete = $this->getBdd()->prepare("INSERT INTO jaime(idUtilisateur, idPublication) VALUES(?, ?)");
        $requete->execute([$_SESSION["idUtilisateur"], $_POST["buttonJaime"]]);
    }

    // Permet de soustraire 1 en BDD si l'utilisateur à déjà liké la publication
    public function removeJaime($idPublication){
        $like = $this->like($idPublication)["jaime"];
        $requete = $this->getBdd()->prepare("UPDATE publications SET jaime = ? WHERE idPublication = ?");
        $requete->execute([$like-1 ,$idPublication]);

        $requete = $this->getBdd()->prepare("DELETE FROM jaime WHERE idUtilisateur = ? AND idPublication = ?");
        $requete->execute([$_SESSION["idUtilisateur"], $_POST["buttonJaime"]]);
    }

    // Récupération du nombre de j'aime
    public function recuperationJaimes($idUtilisateur, $idPublication){
        $requete = $this->getBdd()->prepare("SELECT * FROM jaime WHERE idUtilisateur = ? AND idPublication = ?");
        $requete->execute([$idUtilisateur, $idPublication]);
        return $requete->rowCount();
    }
}


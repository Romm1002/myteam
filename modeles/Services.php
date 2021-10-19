<?php
class Services extends Modele{

    public function getNomService(){
        $requete = $this->getBdd()->prepare('SELECT * FROM les_services');
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertService($idService, $idUtilisateur){
        $requete = $this->getBdd()->prepare('INSERT INTO services(idService, idUtilisateur) VALUES(?, ?)');
        $requete->execute([$idService, $idUtilisateur]);
    }

    public function rowCountService($idUtilisateur){
        $requete = $this->getBdd()->prepare('SELECT * FROM services WHERE idUtilisateur = ?');
        $requete->execute([$idUtilisateur]);
        return $requete->rowCount();
    }
}
?>
<?php
// Table qui appartient à la fonction des planifications
class Services extends Modele{
    // Récupération des noms des services
    public function getNomService(){
        $requete = $this->getBdd()->prepare('SELECT * FROM les_services');
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    // Permet d'affecter un service à un utilisateur (à faire en C#)
    public function insertService($idService, $idUtilisateur){
        $requete = $this->getBdd()->prepare('INSERT INTO services(idService, idUtilisateur) VALUES(?, ?)');
        $requete->execute([$idService, $idUtilisateur]);
    }

    // je sais plus
    public function rowCountService($idUtilisateur){
        $requete = $this->getBdd()->prepare('SELECT * FROM services WHERE idUtilisateur = ?');
        $requete->execute([$idUtilisateur]);
        return $requete->rowCount();
    }
}
?>
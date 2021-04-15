<?php
class Projets extends Modele{
    public function newProjet($nomProjet, $membresProjet, $descriptionProjet, $dateDebut, $dateFin){
        $requete = $this->getBdd()->prepare("INSERT INTO projets(nomProjet, membresProjet, descriptionProjet, dateDebut, dateFin, image) VALUES(?, ?, ?, ?, ?, ?)");
        $requete->execute([$nomProjet, $membresProjet, $descriptionProjet, $dateDebut, $dateFin, "../pages/images/projets/projet" . rand(1, 7) . ".jpg"]);
    }
    
    public function selectionProjets(){
        $requete = $this->getBdd()->prepare("SELECT * FROM projets");
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function detailsProjets($idProjet){
        $requete = $this->getBdd()->prepare("SELECT * FROM projets WHERE idProjet = ?");
        $requete->execute([$idProjet]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }
}
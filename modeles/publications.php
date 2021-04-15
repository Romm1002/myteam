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

}


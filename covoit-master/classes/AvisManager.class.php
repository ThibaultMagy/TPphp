<?php
class AvisManager{
  private $db;

  public function __construct($db){
    $this->db = $db;
  }

  public function getAvisPersonne($pernum){
    $listeAvis = array();
    $sql='SELECT avi_comm FROM avis WHERE per_num = :pernum ORDER BY avi_date DESC';
    $req = $this->db->prepare($sql);
    $req->bindValue(':pernum', $pernum);
    $req->execute();

    $avis = $req->fetch(PDO::FETCH_OBJ);
    $newAvis = new Avis($avis);
    return $newAvis;

  }

  public function getMoyenneAvisPersonne($pernum){
    $listeAvis = array();
    $sql='SELECT AVG(avi_note) as avi_note FROM avis WHERE per_num = :pernum ORDER BY avi_date DESC';
    $req = $this->db->prepare($sql);
    $req->bindValue(':pernum', $pernum);
    $req->execute();

    $avis = $req->fetch(PDO::FETCH_OBJ);
    $newAvis = new Avis($avis);
    return $newAvis;
  }
}

?>

<?php
class AvisManager{
  private $db;

  public function __construct($db){
    $this->db = $db;
  }

  public function getAvisComm($per_num){
    $listeAvis = array();
    $sql='SELECT avi_comm FROM avis WHERE per_num = :per_num ORDER BY avi_date DESC';
    $req = $this->db->prepare($sql);
    $req->bindValue(':per_num', $per_num->getPerNum());
    $req->execute();

    $avis = $req->fetch(PDO::FETCH_OBJ);
    $newAvis = new Avis($avis);
    return $newAvis;

  }

  public function getMoyenne($per_num){
    $listeAvis = array();
    $sql='SELECT AVG(avi_note) as avi_note FROM avis WHERE per_num = :per_num ORDER BY avi_date DESC';
    $req = $this->db->prepare($sql);
    $req->bindValue(':per_num', $per_num);
    $req->execute();

    $avis = $req->fetch(PDO::FETCH_OBJ);
    $nouvAvis = new Avis($avis);
    return $nouvAvis;
  }
}

?>

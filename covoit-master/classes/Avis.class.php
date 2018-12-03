<?php
class Avis{
  private $per_num;
  private $per_per_num;
  private $par_num;
  private $avi_comm;
  private $avi_note;
  private $avi_date;

  public function __construct($valeurs = array()){
    if(!empty($valeurs)){
      $this->affecte($valeurs);
    }
  }

  public function affecte($donnees){
    foreach($donnees as $attribut => $valeur){
      switch($attribut){
        case 'per_num':
          $this->setPerNum($valeur);
          break;
        case 'per_num':
          $this->setPerPerNum($valeur);
          break;
        case 'par_num':
          $this->setParNum($valeur);
          break;
        case 'avi_comm':
          $this->setAvisComm($valeur);
          break;
        case 'avi_note':
          $this->setAvisNote($valeur);
          break;
        case 'avi_date':
          $this->setAvisDate($valeur);
          break;
      }
    }
  }

  public function setPerNum($num){
    $this->per_num = $num;
  }

  public function getPerNum(){
    return $this->per_num;
  }

  public function setPerPerNum($num){
    $this->per_per_num = $num;
  }

  public function getPerPerNum(){
    return $this->per_per_num;
  }

  public function setParNum($num){
    $this->par_num = $num;
  }

  public function getParNum(){
    return $this->par_num;
  }

  public function setAvisComm($commentaire){
    $this->avi_comm = $commentaire;
  }

  public function getAvisCom(){
    return $this->avi_comm;
  }

  public function setAvisNote($note){
    $this->avi_note = $note;
  }

  public function getAvisNote(){
    return $this->avi_note;
  }

  public function setAvisDate($date){
    $this->avi_date = $date;
  }

  public function getAvisDate(){
    return $this->avi_date;
  }
}



?>

<?php
class Avis{
  private $pernum;
  private $perpernum;
  private $parnum;
  private $avicom;
  private $avinote;
  private $avidate;

  public function __construct($valeurs = array()){
    if(!empty($valeurs)){
      $this->affecte($valeurs);
    }
  }

  public function affecte($donnees){
    foreach($donnees as $attribut => $valeur){
      switch($attribut){
        case 'per_num': $this->setPerNum($valeur);
        break;
        case 'per_per_num': $this->setPerPerNum($valeur);
        break;
        case 'par_num': $this->setParNum($valeur);
        break;
        case 'avi_comm': $this->setAvisCom($valeur);
        break;
        case 'avi_note': $this->setAvisNote($valeur);
        break;
        case 'avi_date': $this->setAvisDate($valeur);
        break;
      }
    }
  }

  public function setPerNum($num){
    $this->pernum = $num;
  }

  public function getPerNum(){
    return $this->pernum;
  }

  public function setPerPerNum($num){
    $this->perpernum = $num;
  }

  public function getPerPerNum(){
    return $this->perpernum;
  }

  public function setParNum($num){
    $this->parnum = $num;
  }

  public function getParNum(){
    return $this->parnum;
  }

  public function setAvisCom($commentaire){
    $this->avicom = $commentaire;
  }

  public function getAvisCom(){
    return $this->avicom;
  }

  public function setAvisNote($note){
    $this->avinote = $note;
  }

  public function getAvisNote(){
    return $this->avinote;
  }

  public function setAvisDate($date){
    $this->avidate = $date;
  }

  public function getAvisDate(){
    return $this->avidate;
  }
}



?>

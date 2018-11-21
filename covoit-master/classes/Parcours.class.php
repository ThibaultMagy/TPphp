<?php
class Parcours{

private $parc_num;
private $parc_km;
private $parc_vil1;
private $parc_vil2;
private $parc_nb;

public function __construct($valeur = array()){
  if (!empty($valeur)) {
    $this->affecte($valeur);
  }
}

public function affecte($donnees){
  foreach ($donnees as $attribut => $valeur) {
    switch ($attribut) {
      case 'parc_vil1':
        $this->setParcVill1($valeur);
        break;
      case 'parc_vil2':
      $this->setParcVill2($valeur);
      break;
      case 'parc_km':
      $this->setParcKm($valeur);
      break;
    }
  }
}



public function setParcNum($id){
  $this->parc_num = $id;
}
public function getParcNum(){
return $this->parc_num;
}


public function getNbParc(){
  return $this->parc_nb;
}
public function setParcNb($id){
  $this->parc_nb = $id;
}



public function setParcKm($id){
  $this->parc_km = $id;
}
public function getParcKm(){
  return $this->parc_km;
}


public function getParcVill1(){
  return $this->parc_vil1;
}
public function setParcVill1($id){
  $this->parc_vil1 = $id;
}


public function getParcVill2(){
  return $this->parc_vil2;
}
public function setParcVill2($id){
  $this->parc_vil2 = $id;
}




}

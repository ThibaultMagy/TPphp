<?php
class Propose{
	private $par_num;
	private $per_num;
	private $pro_date;
	private $pro_time;
	private $pro_place;
	private $pro_sens;


	public function __construct($valeur = array()){
	  if (!empty($valeur)) {
	    $this->affecte($valeur);
	  }
	}

	public function affecte($donnees){
	  foreach ($donnees as $attribut => $valeur) {
	    switch ($attribut) {
	      case 'par_num':
	        $this->setParcVill1($valeur);
	        break;
	      case 'per_num':
	      $this->setParcVill2($valeur);
	      break;
	      case 'pro_date':
	      $this->setParcKm($valeur);
	      break;
	      case 'pro_time':
	      $this->setParcNum($valeur);
	      break;
				case 'pro_place':
			 $this->setParcNum($valeur);
			 break;
			 case 'pro_sens':
			 $this->setParcNum($valeur);
			 break;
	    }
	  }
	}

	public function setParNum($id){
	  $this->par_num = $id;
	}
	public function getParNum(){
	return $this->par_num;
	}

	public function setPerNum($id){
	  $this->per_num = $id;
	}
	public function getPerNum(){
	return $this->per_num;
	}

	public function setProDate($id){
	  $this->pro_date = $id;
	}
	public function getProDate(){
	return $this->pro_date;
	}

	public function setProTime($id){
	  $this->pro_time = $id;
	}
	public function getProTime(){
	return $this->pro_time;
	}

	public function setProPlace($id){
	  $this->pro_place = $id;
	}
	public function getProPlace(){
	return $this->pro_place;
	}

	public function setProSens($id){
	  $this->pro_sens = $id;
	}
	public function getProSens(){
	return $this->pro_sens;
	}
}

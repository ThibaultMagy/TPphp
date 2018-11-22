<?php
class Division{
	private $div_num;
	private $div_nom;

	public function __construct($valeur = array()){
		if (!empty($valeur)) {
			$this->affecte($valeur);
		}
	}

	public function affecte($donnees){
		foreach ($donnees as $attribut => $valeur) {
			switch ($attribut) {
				case 'div_nom':
					$this->setDivNum($valeur);
					break;
			}
		}
	}

	public function getDivNum(){
		return $this->div_num;
	}

	public function getDivNom(){
		return $this->div_nom;
	}
	
	public function SetDivNum($id){
		$this->div_num = $id;
	}
	public function SetDivNom($id){
		$this->div_nom = $id;
	}
}

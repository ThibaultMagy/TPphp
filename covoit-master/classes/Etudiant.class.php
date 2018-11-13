<?php
class Etudiant{
	private $per_num;
	private $dep_num;
	private $div_num;

	public function __construct($valeur = array()){
		if (!empty($valeur)) {
			$this->affecte($valeur);
		}
	}

	public function affecte($donnees){
		foreach ($donnees as $attribut => $valeur) {
			switch ($attribut) {
				case 'per_nom':
					$this->setDepNum($valeur);
					break;
				case 'per_prenom':
					$this->setDivNum($valeur);
					break;
			}
		}
	}

	public function getDepNum(){
		return $this->dep_num;
	}
	public function getDivNum(){
		return $this->div_num;
	}

	public function SetDepNum($id){
		$this->dep_num = $id;
	}
	public function SetDivNum($id){
		$this->div_num = $id;
	}
}
?>

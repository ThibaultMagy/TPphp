<?php
class Salarie{
	private $per_num;
	private $sal_telprof;
	private $fon_num;

	public function __construct($valeur = array()){
		if (!empty($valeur)) {
			$this->affecte($valeur);
		}
	}

	public function affecte($donnees){
		foreach ($donnees as $attribut => $valeur) {
			switch ($attribut) {
				case 'sal_telprof':
					$this->setDepNum($valeur);
					break;
				case 'fon_num':
					$this->setDivNum($valeur);
					break;
			}
		}
	}

	public function getPerNum(){
		return $this->per_num;
	}
	public function getSalTelProf(){
		return $this->sal_telprof;
	}
	public function getFonNum(){
		return $this->fon_num;
	}

	public function setPerNum($id){
		$this->per_num = $id;
	}
	public function setSalTelProf($id){
		$this->sal_telprof = $id;
	}
	public function setFonNum($id){
		$this->fon_num = $id;
	}

}

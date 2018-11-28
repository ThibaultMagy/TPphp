<?php
class ParcoursManager{
	private $db;

	public function __construct($db){
		 $this->db = $db;
	}


	public function add($parcours){
		$requete = $this->db->prepare(
				'INSERT INTO parcours (par_km,vil_num1,vil_num2) VALUES (:parc_km, :parc_vil1, :parc_vil2);');

		$requete->bindValue(':parc_km', $parcours->getParcKm(), PDO::PARAM_STR);
		$requete->bindValue('parc_vil1', $parcours->getParcVill1(), PDO::PARAM_STR);
		$requete->bindValue('parc_vil2', $parcours->getParcVill2(), PDO::PARAM_STR);


		$retour=$requete->execute();
		return $retour;
	}



	public function getAllParcours(){
		$listeParcours = array();

		$sql = 'SELECT par_num, par_km, vil_num1, vil_num2 FROM parcours';
		$req = $this->db->query($sql);

		while($parcours = $req->fetch(PDO::FETCH_OBJ)){
			$listeParcours[] = new Parcours($parcours);
		}
		return $listeParcours;
		$req-> closeCursor();
	}



	public function getNbParcours(){
		$sql = 'SELECT count(*) as total from parcours';
		$req = $this->db->query($sql);
		$nbParcours=$req->fetch(PDO::FETCH_OBJ);

		return $nbParcours->total;
		$req->closeCursor();
	}



	public function getVilleDispo($idVilleDepart){
		$listeVilleDispo = array();

		$requete = $this->db->prepare(
			'SELECT vil_num1 as parc_vil FROM parcours where vil_num2 = idVilleDepart UNION SELECT
			vil_num2 as vil_num where vil_num1=:idVilleDepart '
		);
		$requete->bindValue('idVilleDepart', $idVilleDepart, PDO::PARAM_STR);
		$requete->execute();
		while ($ville = $requete->fetch(PDO::FETCH_OBJ)){
			$listeVilleDispo[] = new Ville($ville);
		}
		return $listeVilleDispo;
		$requete->closeCursor();
	}
}

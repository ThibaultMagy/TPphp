<?php
class ParcoursManager{
	private $db;

	public function __construct($db){
		 $this->db = $db;
	}


	public function add($nomParcours){
		$req = $this->db->prepare("INSERT INTO parcours(par_km,vil_num1,vil_num2) VALUES(:par_km, :vil_num1, :vil_num2)");
		$req->bindValue(':par_km', $nomParcours->getParcKm());
		$req->bindValue(':vil_num1', $nomParcours->getParcVill1());
		$req->bindValue(':vil_num2', $nomParcours->getParcVill2());

		$retour=$req->execute();
		return $retour;
	}



	public function getAllParcours(){
		$listeParcours = array();

		$sql = 'SELECT par_num, par_km, vil_num1, vil_num2 FROM parcours';
		$req = $this->db->prepare($sql);
		$req->execute();

		while($parcours = $req->fetch(PDO::FETCH_OBJ)){
			$listeParcours[] = new Parcours($parcours);
		}
		$req-> closeCursor();
		return $listeParcours;

	}

	public function parcoursExistant($villenum1, $villenum2){
		$listeParcours = array();
		$req = $this->db->prepare("SELECT COUNT(par_num) FROM parcours WHERE vil_num1 = :villenum1 AND vil_num2 = :villenum2");
		$req->bindValue(':villenum1', $villenum1);
		$req->bindValue(':villenum2', $villenum2);
		$req->execute();
		$parcours = $req->fetchColumn();
		return $parcours;
	}



	public function getNbParcours(){
		$sql = 'SELECT count(*) as total from parcours';
		$req = $this->db->query($sql);
		$nbParcours=$req->fetch(PDO::FETCH_OBJ);

		return $nbParcours->total;
		$req->closeCursor();
	}

public function getVilleParcours(){
	$listeParc = array();
	$requete = $this->db->prepare("SELECT distinct vil_num1 from parcours UNION SELECT vil_num2 FROM parcours");
	$requete->execute();

	while($parcours = $requete->fetch(PDO::FETCH_OBJ)){
		$listeParc[] = new Parcours($parcours);
	}
	$requete->closeCursor();
	return $listeParc;
}

public function getVilleNom($num) {

	$sql = "SELECT vil_nom FROM ville WHERE vil_num = ".$num;
	$req = $this->db->query($sql);
	$nomVille = $req->fetch(PDO::FETCH_OBJ);
	return $nomVille->vil_nom;
	$req->closeCursor();

}


	public function getVilleDispo($num){
			$listeVilles = array();

			$sql = "SELECT DISTINCT * FROM (SELECT v2.vil_num, v2.vil_nom FROM ville v1, PARCOURS p, ville v2
				WHERE v1.vil_num = p.vil_num1 AND v2.vil_num = p.vil_num2 AND v1.vil_num = $num)T1
				ORDER BY vil_nom";

			$requete = $this->db->prepare($sql);
			$requete->execute();

			while ($ville = $requete->fetch(PDO::FETCH_OBJ)) {
					$listeVilles[] = new Ville($ville);
			}
			$requete->closeCursor();
			return $listeVilles;
	}
}

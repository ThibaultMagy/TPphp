<?php
class EtudiantManager{
	private $db;

	public function __construct($db){
		 $this->db = $db;
	}

	public function add($dep_num, $div_num){
		$li = lastInsertedId();
		$requete = $this->db->prepare(
								'INSERT INTO personne (dep_num, div_num) VALUES (:dep_num, :div_num);'
							);
								$requete->bindValue(':dep_num',$dep_num, PDO::PARAM_STR);
								$requete->bindValue(':div_num',$div_num, PDO::PARAM_STR);
								$retour = $requete->execute();
								return $retour;
		}

		//On veut le nom du département
		public function getDepNom($id){
			$sql = $this->db->prepare('SELECT * FROM departement d JOIN etudiant e ON d.dep_num=e.dep_num WHERE per_num='.$id);
			$sql->bindValue(' :num, $id,PDO::PARAM_STR');
			$sql->execute();
			$retour=$sql->fetch(PDO::FETCH_ASSOC);
			return $retour['dep_nom'];
		}

		//On veut le nom de la ville
		public function getVilleNom($id){
			$sql = $this->db->prepare('SELECT * FROM ville v JOIN departement d ON v.vil_num=d.vil_num JOIN etudiant e ON d.dep_num=e.dep_num WHERE per_num='.$id);
			$sql->bindValue(' :num, $id,PDO::PARAM_STR');
			$sql->execute();
			$retour=$sql->fetch(PDO::FETCH_ASSOC);
			return $retour['vil_nom'];
		}

		//choisir dep_num selon dep_nom
		//choisir div_num selon div_nom (annéee)
}

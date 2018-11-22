<?php
class DivisionManager{
	private $db;

	public function __construct($db){
		 $this->db = $db;
	}

	public function add(){
		$li = lastInsertedId();
		$requete = $this->db->prepare(
								'INSERT INTO etudiant (div_num, div_nom) VALUES (:div_num, :div_nom);'
							);
								$requete->bindValue(':div_num',$li, PDO::PARAM_STR);
								$requete->bindValue(':div_nom',$li->getDivNum(), PDO::PARAM_STR);
								$retour = $requete->execute();
								return $retour;
		}

		public function getAllDivision(){
			$listeDivisions = array();
			$sql = 'SELECT div_num,div_nom FROM division';
			$req = $this->db->query($sql);
			while ($division = $req->fetch(PDO::FETCH_OBJ)){
				$listeVilles[] = new Ville($division);
			}
			return $listeDivisions;
			$req->closeCursor();
		}

		public function getDivNom($id){
			$sql = $this->db->prepare('SELECT * FROM division WHERE per_num='.$id);
			$sql->bindValue(' :num, $id,PDO::PARAM_STR');
			$sql->execute();
			$retour=$sql->fetch(PDO::FETCH_ASSOC);
			return $retour['div_nom'];
		}

		public function getDepNom($id){
			$sql = $this->db->prepare('SELECT * FROM departement WHERE per_num='.$id);
			$sql->bindValue(' :num, $id,PDO::PARAM_STR');
			$sql->execute();
			$retour=$sql->fetch(PDO::FETCH_ASSOC);
			return $retour['dep_nom'];
		}
}

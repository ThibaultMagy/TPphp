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
								$requete->bindValue(':div_num',$li->getDivNum(), PDO::PARAM_INT);
								$requete->bindValue(':div_nom',$li->getDivNom(), PDO::PARAM_STR);
								$retour = $requete->execute();
								return $retour;
		}

		public function getAllDivisions(){
			$listeDivisions = array();
			$sql = $this->db->prepare("SELECT div_num,div_nom FROM division");
			$sql->execute();

			while ($division = $sql->fetch(PDO::FETCH_OBJ)){
				$listeDivisions[] = new Division($division);
			}
			return $listeDivisions;
			$req->closeCursor();
		}


		public function getDivNomId($id){
			$sql = $this->db->prepare("SELECT * FROM division WHERE div_num=:id");
			$sql->bindValue(':id', $id,PDO::PARAM_STR);
			$sql->execute();
			$retour=$sql->fetch(PDO::FETCH_ASSOC);
			return $retour['div_nom'];
		}

		/*public function getDepNomp($id){
			$sql = $this->db->prepare("SELECT * FROM departement WHERE dep_num = (SELECT dep_num FROM etudiant WHERE div_num=:id)");
			$sql->bindValue(':id', $id,PDO::PARAM_INT);
			$sql->execute();
			$retour=$sql->fetch(PDO::FETCH_ASSOC);
			return $retour['dep_nom'];
		}*/
}
?>

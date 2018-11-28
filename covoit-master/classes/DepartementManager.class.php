<?php
class DepartementManager{
	private $db;

	public function __construct($db){
		 $this->db = $db;
	}

	public function add(){
		$li = lastInsertedId();
		$requete = $this->db->prepare(
								'INSERT INTO departement (dep_num, dep_nom, vil_num) VALUES (:dep_num, :dep_nom, :vil_num);'
							);
								$requete->bindValue(':dep_num',$li->getDepNum(), PDO::PARAM_INT);
								$requete->bindValue(':dep_nom',$li->getDepNom(), PDO::PARAM_STR);
								$requete->bindValue(':vil_num',$li->getVilNum(), PDO::PARAM_INT);
								$retour = $requete->execute();
								return $retour;
		}

		public function getAllDepartement(){
			$listeDepartement = array();
			$sql = $this->db->prepare("SELECT dep_num, dep_nom, vil_num FROM departement");
			$sql->execute();

			while ($departement = $sql->fetch(PDO::FETCH_OBJ)){
				$listeDepartement[] = new Departement($departement);
			}
			return $listeDepartement;
			$req->closeCursor();
		}


		public function getDepNomId($id){
			$sql = $this->db->prepare("SELECT * FROM departement WHERE dep_num=:id");
			$sql->bindValue(':id', $id,PDO::PARAM_INT);
			$sql->execute();
			$retour=$sql->fetch(PDO::FETCH_ASSOC);
			return $retour['dep_nom'];
		}
}

<?php
class FonctionManager{
	private $db;

	public function __construct($db){
		 $this->db = $db;
	}

	public function add($fon_num, $fon_libelle){
		$li = lastInsertedId();
		$requete = $this->db->prepare(
								'INSERT INTO fonction (fon_num, fon_libelle) VALUES (:fon_num, :fon_libelle);'
							);
								$requete->bindValue(':fon_num',$fon_num, PDO::PARAM_STR);
								$requete->bindValue(':fon_libelle',$fon_libelle, PDO::PARAM_STR);
								$retour = $requete->execute();
								return $retour;
		}

		public function getAllFonctions(){
			$listeFonction= array();
			$sql = $this->db->prepare("SELECT fon_num, fon_libelle FROM fonction");
			$sql->execute();

			while ($fonction = $sql->fetch(PDO::FETCH_OBJ)){
				$listeFonction[] = new Fonction($fonction);
			}
			return $listeFonction;
			$req->closeCursor();
		}
}

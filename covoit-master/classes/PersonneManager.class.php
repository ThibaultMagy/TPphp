<?php
class PersonneManager{
	private $db;

	public function __construct($db){
		 $this->db = $db;
	}

	public function add($nomPersonne){
		$requete = $this->db->prepare(
								'INSERT INTO personne (per_nom) VALUES (:per_nom);'
							);
								$requete->bindValue(':per_nom',$nomPersonne->getPerNom(),
								PDO::PARAM_STR);
								$retour = $requete->execute();
								return $retour;
		}

			public function getAllPer(){
				$listePer = array();
				$sql = 'SELECT per_num, per_nom, per_prenom FROM personne';
				$req = $this->db->query($sql);

				while ($personne = $req->fetch(PDO::FETCH_OBJ)){
					$listePer[] = new Personne($personne);
				}
				return $listePer;
				$req->closeCursor();
			}


			public function getNbPer(){
				$sql='SELECT COUNT(*) as nbPer FROM personne';
				$req = $this->db->query($sql);
				$nbPer = $req->fetch(PDO::FETCH_OBJ);
				return $nbPer->TOTAL;
				$req->closeCursor();
			}

			public function getPerNomId($id){
				$sql = $this->db->prepare('SELECT * FROM personne WHERE per_num='.$id);
				$sql->bindValue(' :num, $id,PDO::PARAM_STR');
				$sql->execute();
				$retour=$sql->fetch(PDO::FETCH_ASSOC);
				return $retour['pern_nom'];
			}

			public function getPerNomPreId($id){
				$sql = $this->db->prepare('SELECT * FROM personne WHERE per_num='.$id);
				$sql->bindValue(' :num, $id,PDO::PARAM_STR');
				$sql->execute();
				$retour=$sql->fetch(PDO::FETCH_ASSOC);
				return $retour['per_prenom'];
			}
}

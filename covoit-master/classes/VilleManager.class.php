<?php
class VilleManager{
	private $db;

	public function __construct($db){
		 $this->db = $db;
	}

	public function add($nomVille){
		$requete = $this->db->prepare(
								'INSERT INTO ville (vil_nom) VALUES (:vil_nom);');

								$requete->bindValue(':vil_nom',$nomVille->getVilNom(),
								PDO::PARAM_STR);

								$retour = $requete->execute();
								return $retour;

		}

			public function getAllVilles(){
				$listeVilles = array();

				$sql = 'SELECT vil_num,vil_nom FROM ville';
				$req = $this->db->query($sql);

				while ($ville = $req->fetch(PDO::FETCH_OBJ)){
					$listeVilles[] = new Ville($ville);
				}
				return $listeVilles;
				$req->closeCursor();
			}



			public function getNbVille(){
				$sql='SELECT count(*) as TOTAL FROM ville';
				$req = $this->db->query($sql);
				$nbVille = $req->fetch(PDO::FETCH_OBJ);

				return $nbVille->TOTAL;
				$req->closeCursor();
			}

			public function getVille($villeNum){
				$sql= "SELECT vil_num, vil_nom FROM ville WHERE vil_num = :villeNum";
				$req = $this->db->prepare($sql);
				$req->bindValue(':villeNum',$villeNum);
				$req->execute();

				$ville = $req->fetch(PDO::FETCH_OBJ);
				$villeRecup = new Ville($ville);
				return $villeRecup;
			}

			public function getVilNomId($id){
				$sql = $this->db->prepare("SELECT * FROM ville WHERE vil_num=:id");

				$sql->bindValue(':id', $id,PDO::PARAM_INT);
				$sql->execute();
				$retour=$sql->fetch(PDO::FETCH_ASSOC);

				return $retour['vil_nom'];

			}
		}

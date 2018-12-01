<?php
class PersonneManager{
	private $db;

	public function __construct($db){
		 $this->db = $db;
	}

	public function add($nomPersonne){
		$requete = $this->db->prepare(
								'INSERT INTO personne (per_nom, per_prenom, per_tel, per_mail, per_login, per_pwd) VALUES (:per_nom, :per_prenom, :per_tel, :per_mail, :per_login, :per_pwd);'
							);
								$requete->bindValue(':per_nom',$nomPersonne->getPerNom(), PDO::PARAM_STR);
								$requete->bindValue(':per_prenom',$nomPersonne->getPerPrenom(), PDO::PARAM_STR);
								$requete->bindValue(':per_tel',$nomPersonne->getPerTel(), PDO::PARAM_STR);
								$requete->bindValue(':per_mail',$nomPersonne->getPerMail(), PDO::PARAM_STR);
								$requete->bindValue(':per_login',$nomPersonne->getPerLogin(), PDO::PARAM_STR);
								$requete->bindValue(':per_pwd',$nomPersonne->getPerPwd(), PDO::PARAM_STR);
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

			public function getLastId() {
				$pdo = new Mypdo();
				return $pdo->lastInsertId();
			}

			public function getPerNomId($id){
				$sql = $this->db->prepare("SELECT * FROM personne WHERE per_num=:id");
				$sql->bindValue(' :id', $id,PDO::PARAM_STR);
				$sql->execute();
				$retour=$sql->fetch(PDO::FETCH_ASSOC);
				return $retour['per_nom'];
			}

			public function isEtudiant($id) {
				$sql = 'SELECT per_num AS numPer FROM ETUDIANT WHERE per_num ='.$id;
				$req = $this->db->prepare($sql);
				$req->execute();
				$numPersonnes = $req->fetch(PDO::FETCH_OBJ);
				if(!empty($numPersonnes)){
					return true;
				}
				else
				{
					return false;
				}
			}

			public function getPerPrenomId($id){
				$sql = $this->db->prepare("SELECT * FROM personne WHERE per_num=:id");
				$sql->bindValue(' :id', $id,PDO::PARAM_STR);
				$sql->execute();
				$retour=$sql->fetch(PDO::FETCH_OBJ);
				return $retour['per_prenom'];
			}

			public function getPersonneForPwdId($id, $pswd){
				$sql = $this->db->prepare("SELECT per_login, per_pwd FROM personne WHERE per_login=':id' and per_pwd=':pswd'");
				$sql->bindValue(':id', $id);
				$sql->bindValue(':pswd', $pswd);
				$sql->execute();
				$retour=$sql->fetch(PDO::FETCH_OBJ);
				if($retour){
					return true;
				}else {
					return false;
				}
			}

			public function creationPersonne($id){
				$sql = $this->db->prepare("SELECT * from personne where per_login=:id");
				$sql->bindValue(' :id', $id);
				$sql->execute();
				$retour=$sql->fetch(PDO::FETCH_OBJ);

				$personne = new Personne($retour);
				return $personne;
			}
}

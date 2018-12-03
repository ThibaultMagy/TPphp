<?php
class SalarieManager{
	private $db;

	public function __construct($db){
		 $this->db = $db;
	}

	public function add($sal_telprof, $fon_num){
		$requete = $this->db->prepare(
								'INSERT INTO salarie (sal_telprof, fon_num) VALUES (:sal_telprof, :fon_num);'
							);
								$requete->bindValue(':sal_telprof',$sal_telprof->getSalTelProf(), PDO::PARAM_STR);
								$requete->bindValue(':fon_num',$fon_num->getFonNum(), PDO::PARAM_STR);
								$retour = $requete->execute();
								return $retour;
		}



		function getTelPro($id){
			$sql = $this->db->prepare('SELECT * FROM fonction f JOIN salarie s ON f.fon_num=s.fon_num WHERE per_num='.$id);
			$sql->bindValue(':per_num', $id,PDO::PARAM_STR);
			$sql->execute();
			$retour=$sql->fetch(PDO::FETCH_ASSOC);
			return $retour['fon_libelle'];
		}

		function getFonction($id){
			$sql = $this->db->prepare('SELECT * FROM salarie WHERE per_num='.$id);
			$sql->bindValue(':num', $id,PDO::PARAM_STR);
			$sql->execute();
			$retour=$sql->fetch(PDO::FETCH_ASSOC);
			return $retour['fon_num'];
		}
}

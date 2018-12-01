<?php
class ProposeManager{
	private $dbo;

		public function __construct($db){
			$this->db = $db;
		}
    public function add($propose){
        $requete = $this->db->prepare(
				'INSERT INTO PROPOSE (par_num, per_num, pro_date, pro_time, pro_place, pro_sens) VALUES (:par_num, :per_num, :pro_date, :pro_time, :pro_place, :pro_sens);');

				$requete->bindValue(':par_num',$propose->getParNum());
        $requete->bindValue(':per_num',$propose->getPerNum());
        $requete->bindValue(':pro_date',$propose->getProDate());
        $requete->bindValue(':pro_time',$propose->getProTime());
        $requete->bindValue(':pro_place',$propose->getProPlace());
        $requete->bindValue(':pro_sens',$propose->getProSens());

        $retour=$requete->execute();
				return $retour;
    }

    public function getAllTrajets($vilDep, $vilArr, $dateDepMin, $dateDepMax, $heureDep){
        $listeTrajets = array();

        $sql = 'SELECT vil_nom1, vil_nom2, pro_date, pro_time, pro_place, per_nom, per_prenom FROM PROPOSE pr, PERSONNE pe, VILLE v1, PARCOURS pa, VILLE v2
        WHERE pr.par_num = pa.par_num AND pe.per_num = pr.per_num AND pa.vil_num1 = v1.vil_num AND pa.vil_num2 = v2.vil_num
				AND p.vil_num1 = '.$vil_dep.' AND p.vil_num2 = '.$vil_arr.' AND pro_date >= '.$datDepMin.' AND pro_date <= '.$dateDepMax.' AND $pro_time >= '.$heureDep;

        $requete = $this->db->prepare($sql);
        $requete->execute();

        while ($propose = $requete->fetch(PDO::FETCH_OBJ)) {
            $listeTrajets[] = new Propose($propose);
        }
        $requete->closeCursor();
        return $listeTrajets;
    }

    public function getParcoursNum($villeDepart, $villeArrivee) {
      $sql = "SELECT par_num FROM PARCOURS WHERE vil_num1 = ".$villeDepart." AND vil_num2 = ".$villeArrivee;

			$sql;

      $requete = $this->db->prepare($sql);
      $requete->execute();

      if ($requete->rowCount() == 0) {
        $sql = "SELECT par_num FROM PARCOURS WHERE vil_num1 = ".$villeArrivee." AND vil_num2 = ".$villeDepart;

        $requete = $this->db->prepare($sql);
        $requete->execute();
      }

      $numParc = $requete->fetch(PDO::FETCH_OBJ);

      return $numParc->par_num;
    }

    public function getProSens($villeDepart, $villeArrivee) {
      $sql = "SELECT par_num FROM PARCOURS WHERE vil_num1 =". $villeDepart." AND vil_num2 = ".$villeArrivee;

      $requete = $this->db->prepare($sql);
      $requete->execute();

      if ($requete->rowCount() == 0) {
        return 0;
      }
      else
      {
        return 1;
      }
    }

		public function getAllVilleDepart () {
			$listeVillesDep = array();

			$sql = 'SELECT DISTINCT * FROM (SELECT vil_num, vil_nom FROM PROPOSE pr, VILLE, PARCOURS pa WHERE  vil_num = vil_num1
				AND pr.par_num = pa.par_num AND pro_sens = 0
				UNION SELECT vil_num, vil_nom FROM PROPOSE pr, PARCOURS pa, VILLE WHERE vil_num = vil_num2 AND pr.par_num = pa.par_num AND pro_sens = 1)T1
				ORDER BY vil_nom';

			$requete = $this->db->prepare($sql);
			$requete->execute();

			while ($ville = $requete->fetch(PDO::FETCH_OBJ)) {
					$listeVillesDep[] = new Ville($ville);
			}
			$requete->closeCursor();
			return $listeVillesDep;
		}
}
?>

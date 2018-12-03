<?php
class ProposeManager{
	private $dbo;

		public function __construct($db){
			$this->db = $db;
		}
    public function add($propose){
        $requete = $this->db->prepare(
				'INSERT INTO propose (par_num, per_num, pro_date, pro_time, pro_place, pro_sens) VALUES (:par_num, :per_num, :pro_date, :pro_time, :pro_place, :pro_sens);');

				$requete->bindValue(':par_num',$propose->getParNum());
        $requete->bindValue(':per_num',$propose->getPerNum());
        $requete->bindValue(':pro_date',$propose->getProDate());
        $requete->bindValue(':pro_time',$propose->getProTime());
        $requete->bindValue(':pro_place',$propose->getProPlace());
        $requete->bindValue(':pro_sens',$propose->getProSens());

        $retour=$requete->execute();
				return $retour;
    }

    public function getAllTrajets($vil_dep, $vil_arr, $date_min, $date_max, $heure_dep){
        $listeTrajets = array();

        $sql = 'SELECT vil_nom1, vil_nom2, pro_date, pro_time, pro_place, per_nom, per_prenom FROM propose pr, personne pe, ville v1, parcours pa, ville v2
        WHERE pr.par_num=pa.par_num AND pe.per_num=pr.per_num AND pa.vil_num1=v1.vil_num AND pa.vil_num2=v2.vil_num
				AND p.vil_num1 ='.$vil_dep.' AND p.vil_num2='.$vil_arr.' AND pro_date >='.$datDepMin.' AND pro_date <='.$date_max.' AND $pro_time >='.$heure_dep;

        $requete = $this->db->prepare($sql);
        $requete->execute();

        while ($propose = $requete->fetch(PDO::FETCH_OBJ)) {
            $listeTrajets[] = new Propose($propose);
        }
        $requete->closeCursor();
        return $listeTrajets;
    }

		public function printTrajet($par_num, $pro_sens, $pro_date, $precision, $pro_time){
	    $listePropose = array();
	    $sql = "SELECT pro_date, pro_time, pro_place, per_num FROM propose WHERE par_num = :par_num AND pro_sens = :pro_sens AND DATE(pro_date) = :date1
	            OR DATE(pro_date) = date_add(:date2, INTERVAL :precision1 DAY)
	            OR DATE(pro_date) = date_dub(:date3, INTERVAL :precision2 DAY)
	            AND TIME(pro_time) >= :pro_time ";
	    $req = $this->db->prepare($sql);
	    $req->bindValue(':par_num',$par_num);
	    $req->bindValue(':pro_sens',$pro_sens);
	    $req->bindValue(':date1',$pro_date);
	    $req->bindValue(':date2',$pro_date);
	    $req->bindValue(':date3',$pro_date);
	    $req->bindValue(':precision1',$precision);
	    $req->bindValue(':precision2',$precision);
	    $req->bindValue(':pro_time', $pro_time);
	    $req->execute();

	    while($propose = $req->fetch(PDO::FETCH_OBJ)){
	      $listePropose[] = new Propose($propose);
	    }
	    $req->closeCursor();
	    return $listePropose;
	  }

    public function getParcoursNum($vil_dep, $vil_arr) {
      $sql = "SELECT par_num FROM parcours WHERE vil_num1 = ".$vil_dep." AND vil_num2 = ".$vil_arr;

			$sql;

      $requete = $this->db->prepare($sql);
      $requete->execute();

      if ($requete->rowCount() == 0) {
        $sql = "SELECT par_num FROM parcours WHERE vil_num1 = ".$vil_arr." AND vil_num2 = ".$vil_dep;

        $requete = $this->db->prepare($sql);
        $requete->execute();
      }

      $numParc = $requete->fetch(PDO::FETCH_OBJ);

      return $numParc->par_num;
    }

    public function getProSens($vil_dep, $vil_arr) {
      $sql = "SELECT par_num FROM parcours WHERE vil_num1 =". $vil_dep." AND vil_num2 = ".$vil_arr;

      $requete = $this->db->prepare($sql);
      $requete->execute();

      if ($requete->rowCount() == 0) {
        return 0;
      }
      else{
        return 1;
      }
    }

		public function getNumSens($vil_dep, $vil_arr){
	    $sql = "SELECT par_num, 0 as pro_sens FROM parcours
	            WHERE (vil_num1 = :vil_dep AND vil_num2 = :vil_arr)
	            UNION
	            SELECT par_num, 1 as pro_sens FROM parcours
	            WHERE (vil_num1 = :vil_arr2 AND vil_num2 = :vil_dep2)";
	    $req = $this->db->prepare($sql);
	    $req->bindValue(':vil_dep',$vil_dep);
	    $req->bindValue(':vil_arr',$vil_arr);
	    $req->bindValue(':vil_dep2',$vil_dep);
	    $req->bindValue(':vil_arr2',$vil_arr);
	    $req->execute();

	    $propose = $req->fetch(PDO::FETCH_OBJ);
	    $newPropose = new Propose($propose);
	    return $newPropose;

	  }

		public function vilArr($num){
	    $listeVillesRecup = array();
	    $sql = "SELECT vil_num1 as vil_num, vil_nom FROM parcours pa JOIN propose p ON pa.par_num = p.par_num
	    JOIN ville v ON v.vil_num = pa.vil_num1 WHERE pro_sens = 0 AND vil_num2 = :num
	    UNION
	    SELECT vil_num2 as vil_num, vil_nom FROM parcours pa JOIN propose p ON pa.par_num = p.par_num
	    JOIN ville v ON v.vil_num = pa.vil_num2 WHERE pro_sens = 1 AND vil_num1 = :num2";
	    $req = $this->db->prepare($sql);
	    $req->bindValue(':num',$num);
	    $req->bindValue(':num2',$num);
	    $req->execute();
	    while($ville = $req->fetch(PDO::FETCH_OBJ)){
	      $listeVillesRecup[] = new Ville($ville);
	    }
	    return $listeVillesRecup;
	  }

		public function getAllVilles () {
			$listeVillesDep = array();

			$sql = 'SELECT DISTINCT * FROM (SELECT vil_num, vil_nom FROM propose pr, ville, parcours pa WHERE  vil_num = vil_num1
				AND pr.par_num = pa.par_num AND pro_sens = 0
				UNION SELECT vil_num, vil_nom FROM propose pr, parcours pa, ville WHERE vil_num = vil_num2 AND pr.par_num = pa.par_num AND pro_sens = 1)T1
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

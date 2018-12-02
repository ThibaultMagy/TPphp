<?php

    class ConnexionManager {

        private $db;

        public function __construct($db) {
            $this->db = $db;
        }


        public function getNumPersonne($login) {
            $temp = new PersonneManager($this->db);
            return $temp->getNumPersonne($login);
        }

        public function estCorrect($login, $pwd, $captcha, $premierChiffre, $deuxiemeChiffre) {

            if ($this->loginNonExistant($login)) {
                return false;
            } else {
                return ($this->pwdCorrect($login, $pwd) && $this->captchaCorrect($captcha, $premierChiffre, $deuxiemeChiffre));
            }
        }

        public function loginNonExistant($per_login) {

            $reqSQL = "SELECT per_login FROM personne WHERE per_login='".$per_login."'";
            $reqPreparee = $this->db->prepare($reqSQL);
            $reqPreparee->execute();

            $reqPreparee->fetch(PDO::FETCH_OBJ);
            $reqPreparee->closeCursor();

            return ($reqPreparee->rowCount() == 0);
        }

        public function pwdCorrect($per_login, $pwd) {
            $salt = "48@!alsd";
            $pwdSale = sha1($pwd.$salt);

            $reqSQL = "SELECT per_pwd FROM personne WHERE per_login='".$per_login."'";
            $reqPreparee = $this->db->prepare($reqSQL);
            $reqPreparee->execute();

            $pwdReq = $reqPreparee->fetch(PDO::FETCH_OBJ);
            $reqPreparee->closeCursor();

            return ($pwdReq->per_pwd == $pwdSale);
        }

        public function captchaCorrect($captcha, $premierChiffre, $deuxiemeChiffre) {
            return ((int)$captcha == ((int)$premierChiffre + (int)$deuxiemeChiffre));
        }
	}

?>

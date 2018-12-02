<?php
 $pdo = new Mypdo();
 $villeManager = new VilleManager($pdo);
 $parcoursManager = new ParcoursManager($pdo);
 $ProposeManager = new ProposeManager($pdo);
 if(empty($_POST["parc_vil1"]) && empty($_POST["parc_vil2"])){
?>
<h1>Proposer un trajet</h1>
<form action="#" method="POST">
<div class="formBloc">
  <div class="labelinputinline">
    <label for="depart">Ville de départ :</label>
    <select size="1" name="parc_vil1" required>
      <option value="0">Choisissez</option>
      <?php
        $listeParcours = $parcoursManager->getVilleParcours();
        foreach($listeParcours as $parcours){ ?>
      <option value="<?php echo $parcours->getParcVill1();?>"> <?php echo $villeManager->getVilNomId($parcours->getParcVill1());?></option>
        <?php
        }
        ?>
    </select>
  </div>
  <input class="subButton" type="submit" value="Valider" />
</div>
</form>
<?php }
if(!empty($_POST["parc_vil1"]) && empty($_POST["parc_vil2"])){
  $_SESSION["parc_vil1"] = $_POST["parc_vil1"];

  $num1 = $_POST["parc_vil1"];
  $_SESSION["parc_vil1"] = $num1;
?>
<form action="#" method="POST"
  <h1>Proposer un trajet</h1>
  <div class="formBloc">
    <div class="labelinput"><label for="villeDepart">Ville de départ : <?php echo $parcoursManager->getVilleNom($num1); ?></div>
    <div class="labelinput"><label for="dateDepart">Date de départ :</label> <input type="date" name="pro_date" value="<?php echo date('Y-m-d'); ?>" required/></div>
    <div class="labelinput"><label for="nombrePlaces">Nombre de places :</label> <input type="text" name="pro_place" required/></div>
  </div>
  <div class="formBloc">
    <div class="labelinput">
      </label> <label for="villeArrivee">Ville d'arrivée :</label>
      <select size="1" name="parc_vil2" required>
        <option value="0">Choisissez</option>
        <?php
          $ville = $parcoursManager->getVilleDispo($num1);
          foreach($ville as $parcours){ ?>
        <option value="<?php echo $parcours->getVilNum(); ?>"> <?php echo $villeManager->getVilNomId($parcours->getVilNum());?></option>
          <?php
          }
          ?>
      </select>
    </div>
    <div class="labelinput"><label for="heureDepart">Heure de départ :</label> <input type="time" name="pro_time" required/></div>
  </div>
  <input type="submit" value="Valider" class="subButton2" />
<?php
  }
  if(empty($_POST["parc_vil1"]) && !empty($_POST["parc_vil2"])){

    $par_num = $ProposeManager->getParcoursNum($_SESSION["parc_vil1"], $_POST["parc_vil2"]);
    $per_num = $_SESSION["numero"];
    $pro_date = $_POST["pro_date"];
    $pro_time = $_POST["pro_time"];
    $pro_place = $_POST["pro_place"];
    $pro_sens = $ProposeManager->getProSens($_SESSION["parc_vil1"], $_POST["parc_vil2"]);

    $arrayPropose = array('par_num' => $par_num, 'per_num' => $per_num, 'pro_date' => $pro_date, 'pro_time' => $pro_time, 'pro_place' => $pro_place, 'pro_sens' => $pro_sens);
    $propose = new Propose($arrayPropose);
    $retour=$ProposeManager->add($propose);

    if ($retour != 0) {
      ?></br><?php
      echo "	<img src=\"image/valid.png\" alt=\"valid\" title=\"insertionValide\">";
      echo "    La trajet a été proposé." ;
    }
    else
    {
      ?></br><?php
      echo "	<img src=\"image/erreur.png\" alt=\"erreur\" title=\"insertionInvalide\">";
      echo "    Erreur, le trajet n'a pas été proposé." ;
    }
  }
   ?>

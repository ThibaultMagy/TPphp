<?php

$pdo = new Mypdo();
$villeManager = new VilleManager($pdo);
$proposeManager = new ProposeManager($pdo);
$parcoursManager = new ParcoursManager($pdo);

if(empty($_POST["parc_vil1"]) && empty($_POST["parc_vil2"])) {
?>
<h1> Rechercher un trajet </h1>
<form action="" method="POST">
  <div class="formBloc">
    <label for="villeDepart">Ville de départ :</label>
    <select size="1" name="parc_vil1" id="parc_vil1" required>
      <option value="0">Choisissez</option>
      <?php
      $listeDepart = $proposeManager->getAllVilleDepart();
      foreach($listeDepart as $ville) {?>
          <option value="<?php echo $ville->getVilNum();?>"> <?php echo $ville->getVilNom() ;?></option>
      <?php } ?>
    </select>
  </div>
  <input class="subButton2" type="submit" value="Valider" required/>
  </form>
  <?php }
  if(!empty($_POST["parc_vil1"]) && empty($_POST["parc_vil2"])) {
    $_SESSION["vilnum1"] = $_POST["parc_vil1"];
  ?>
  <h1> Rechercher un trajet </h1>
  <form action="" method="POST">
  <div class="formBloc">
    <div class="labelinput"><label for="VilleDepart"> Ville de départ : </label> <?php echo $villeManager->getVille($_POST["parc_vil1"])->getVilNom(); ?></div>
    <div class="labelinput"><label for="DateDepart"> Date de départ : </label><input name"pro_date" id="pro_date" type="date"></input></div>
    <div class="labelinput">
      <label for="depart">A partir de : </label>
      <select size="1" name="temps" id="temps" required>
      <option value="0"  selected="selected">0h</option>
      <?php
      for($i = 1; $i < 24; $i++){
        if($i < 10){ ?>
          <option value="<?php echo "0".$i.":00:00" ?>"><?php echo $i."h" ?></option>
        <?php
        }
        else { ?>
          <option value="<?php echo $i.":00:00" ?>"><?php echo $i."h" ?></option>
        <?php }
        } ?>
        </select>
      </div>
  </div>
  <div class="formBloc">
    <div class="labelinput">
      <label for="VilleArrivee"> Ville d'arrivée : </label>
      <select size="1" name="parc_vil2" id="parc_vil2" required>
        <option value="0"> Choisissez</option>
        <?php
        $listeArrivee = $proposeManager->recupVilleArrivee($_POST["parc_vil1"]);
        foreach($listeArrivee as $ville) { ?>
          <option value="<?php echo $ville->getVilNum(); ?>"><?php echo $ville->getVilNom();?></option>
        <?php } ?>
      </select>
    </div>
    <div class="labelinput">
        <label for="Precision">Précision : </label>
        <select size="1" name="precision" id="precision" required>
          <option value="0" selected="selected">Ce jour</option>
          <option value="1">+/- 1 jour</option>
          <option value="2">+/- 2 jours</option>
          <option value="3">+/- 3 jours</option>
        </select>
  </div>
      <input class="subButton2" type="submit" value="Valider" />
  </div>
  </form>

  <?php
  }
  if(empty($_POST["parc_vil1"]) && !empty($_POST["parc_vil2"])) {

    $villeManager = new VilleManager($pdo);
    $personneManager = new PersonneManager($pdo);
    $avisManager = new AvisManager($pdo);
    $propose = $proposeManager->recupParNumEtSens($_SESSION["vilnum1"],$_POST["parc_vil2"]);
    $listePropose = $proposeManager->printTrajet($propose->getPerNum(), $propose->getProSens(),$_POST["pro_date"], $_POST["precision"], $_POST["temps"]);
    if(count($listePropose) == 0){
      ?>
      <h1> Rechercher un trajet </h1>
      <img src="image/erreur.png"> Désolé, pas de trajet disponible !
      <?php
      header("Refresh:2, url=./index.php?page=10");
    }else{
      ?>
      <h1> Rechercher un trajet </h1>
      <table border="1">
        <tr>
          <th>Ville départ</th>
          <th>Ville arrivée</th>
          <th>Date départ</th>
          <th>Heure départ</th>
          <th>Nombre de place(s)</th>
          <th>Nom du covoitureur</th>
        </tr>
        <?php foreach($listePropose as $propose){
      $part1 = "Moyenne des avis : ".$avisManager->getMoyenne($propose->getPerNum())->getAvisNote();
      $part2 = "Dernier avis : ".$avisManager->getAvisPersonne($propose->getPerNum())->getAvisComm();
      $infobulle = $part1." ".$part2;
      ?>
      <tr>
        <td><?php echo $villeManager->getVille($_SESSION["vilnum1"])->getVilNom(); ?></td>
        <td><?php echo $villeManager->getVille($_POST["parc_vil2"])->getVilNom(); ?></td>
        <td><?php echo getFrenchDate($propose->getProDate()); ?></td>
        <td><?php echo $propose->getProTime(); ?></td>
        <td><span title="<?php echo $infobulle ?>" class="tooltip"><?php echo $personneManager->getAllInfoPersonne($propose->getPerNum())->getPerNom()." ".$personneManager->getAllInfoPersonne($propose->getPerNum())->getPerPrenom(); ?></span></td>
      </tr>
      <?php } ?>
      </table>
      </br>
      <?php
    }
  }
?>

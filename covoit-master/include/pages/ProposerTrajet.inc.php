 <h1>Proposer un trajet</h1>

<?php
  $db = new myPdo();
  $manager = new ParcoursManager($db);
  $parcourManager = new ParcoursManager($db);
  $villeManager = new VilleManager($db);

  $tabVille = $villeManager->getAllVilles();
  $listeParcours = $parcourManager->getAllParcours();
  $parcour = $parcourManager->getVilleParcours();
  //var_dump($parcour);
?>
  <form>
    <div class="formBloc">
      <div class="labelinput">
        <label> Ville de départ : </label>
        <select class="" name="parc_vil1" required>
            <option value="0"> Choisissez</option>
            <?php foreach ($parcour as $parc){ ?>
              <option value="<?php echo $parc->getParcVill1() ?>"><?php echo $villeManager->getVilNomId($parc->getParcVill1());?></option>
            <?php } ?>
        </select>
      </div>
      <div class="labelinput">
        <label>Date de départ : </label><?php echo '<input type="date" name="pro_date" size="10" value="'.date('Y-m-d').'">'; ?>
      </div>
      <div class="labelinput">
        <label>Nombre de places : </label><input type="text" name="pro_place" size="10">
      </div>
    </div>

    <div class="formBloc">
      <div class="labelinput">
        <label> Ville d'arrivée : </label>
        <select class="" name="parc_vil2" required>
          <option value="0"> Choisissez</option>
          <?php //$villes2 = getVilleDispo($parcour->getVilleParcours()->getParcVill1()); ?>
          <?php foreach ($villes2 as $parc){ ?>
            <option value="<?php echo $parc->getParcVill2() ?>"><?php echo $parc->$villeManager->getVilNomId($parc->getParcVill2());?></option>
          <?php } ?>
        </select>
      </div>
      <div class="labelinput">
        <label>Heure de départ : </label><?php echo '<input type="time" name="pro_time" size="10" value="'.date("H:i:s").'">'; ?>
      </div>
    </div>
    <input type="submit" class="subButton2" name="bouton" value="Valider">
  </form>

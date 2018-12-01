<h1>Rechercher un trajet</h1>

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
      <label>Ville de départ : </label>
      <select class="" name="vil_dep" required>
        <option value="0"> Choisissez</option>
        <?php foreach ($tabVille as $ville){ ?>
          <option value="<?php echo $ville->getVilNum() ?>"><?php echo $villeManager->getVilNomId($ville->getVilNum());?></option>
        <?php } ?>
      </select>
    </div>

    <div class="labelinput">
      <label>Date de départ : </label>
      <input type="date" name="date_dep" required>
    </div>

    <div class="labelinput">
      <label>A partir de : </label>
      <select class="" name="heure_dep" required>
        <option value="0"> Choisissez</option>
        <?php foreach ($nomInstanceOuTableau as $objet){ ?>
          <option value="<?php echo $objet->getObjet() ?>"><?php echo $objetManager->getObjetId($objet->getObjet());?></option>
        <?php } ?>
      </select>
    </div>

  </div>




  <div class="formBloc">

    <div class="labelinput">
      <label>Ville d'arrivée : </label>
      <select class="" name="" required>
        <option value="0"> Choisissez</option>
        <?php foreach ($tabVille as $ville){ ?>
          <option value="<?php echo $ville->getVilNum() ?>"><?php echo $villeManager->getVilNomId($ville->getVilNum());?></option>
        <?php } ?>
      </select>
    </div>

    <div class="labelinput">
      <label>Précision : </label>
      <select class="" name="" required>
        <option value="0"> Choisissez</option>
        <?php foreach ($nomInstance as $objet){ ?>
          <option value="<?php echo $objet->getObjet() ?>"><?php echo $objetManager->getObjetId($objet->getObjet());?></option>
        <?php } ?>
      </select>
    </div>

    <input type="submit" class="subButton2" name="bouton" value="Valider">
  </div>

</form>

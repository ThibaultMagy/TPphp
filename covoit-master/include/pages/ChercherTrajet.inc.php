<h1>Rechercher un trajet</h1>

<form>

  <div class="formBloc">
    <div class="labelinput">
      <label>Ville de départ : </label>
      <select class="" name="" required>
        <option value="0"> Choisissez</option>
        <?php foreach ($nomInstance as $objet){ ?>
          <option value="<?php echo $objet->getObjet() ?>"><?php echo $objetManager->getObjetId($objet->getObjet());?></option>
        <?php } ?>
      </select>
    </div>

    <div class="labelinput">
      <label>Date de départ : </label>
    </div>

    <div class="labelinput">
      <label>A partir de : </label>
      <select class="" name="" required>
        <option value="0"> Choisissez</option>
        <?php foreach ($nomInstance as $objet){ ?>
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
        <?php foreach ($nomInstance as $objet){ ?>
          <option value="<?php echo $objet->getObjet() ?>"><?php echo $objetManager->getObjetId($objet->getObjet());?></option>
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

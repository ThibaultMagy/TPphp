<?php
$db = new myPdo();
$manager = new ParcoursManager($db);
$parcourManager = new ParcoursManager($db);
$villeManager = new VilleManager($db);

$tabVille = $villeManager->getAllVilles();
$listeParcours = $parcourManager->getAllParcours();
$parcour = $parcourManager->getVilleParcours();
 ?>

 <h1>Proposer un trajet</h1>


     <p>
     <label> Ville de départ : </label>
      <option value="0"> Choisissez</option>
     <select class="" name="parc_vil1" required>
       <?php foreach ($parcour as $parc){ ?>
         <option value="<?php echo $parc->getParcVill1() ?>"><?php echo $villeManager->getVilNomId($parc->getParcVill1());?></option>
       <?php } ?>
       </select>

       <input class="" type="submit" value="Valider"/>

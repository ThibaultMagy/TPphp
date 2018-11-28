<?php
$db = new myPdo();
$manager = new ParcoursManager($db);
$parcourManager = new ParcoursManager($db);
$villeManager = new VilleManager($db);

$tabVille = $villeManager->getAllVilles();
$listeParcours = $parcourManager->getAllParcours();
$parcour = $ParcoursManager->getParcVill1();
 ?>

 <h1>Proposer un trajet</h1>


     <p>
     <label> Ville de départ : </label>
     <select class="" name="parc_vil1" required>
       <?php foreach ($parcour as $villeParcours): ?>
         <option value="<?php echo $villeParcours->getParcVill1() ?>"><?php echo $villeParcours->getVilNom()?></option>
       <?php endforeach; ?>
       </select>

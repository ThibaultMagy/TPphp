<?php
$db = new myPdo();
$parcourManager = new ParcoursManager($db);
$villeManager = new VilleManager($db);
$listeParcours = $parcourManager->getAllParcours();

$nbParcours = $parcourManager->getNbParcours();
 ?>

 <h1> Liste des parcours </h1>
 <p> Actuellement <?php echo $nbParcours; ?> parcours sont enregistrées </p>
 <table>
   <tr>
      <th><b> Numéro </b> </th>
      <th><b> Ville départ</b></th>
      <th><b> Ville arrivée </b></th>
      <th><b> Nombre de km </b> </th>
   </tr>

   <?php foreach ($listeParcours as $par){?>
     <tr>
        <td class="tableauLister"><?php echo $par->getParcNum();?></td>
        <td class="TableauLister"><?php echo $villeManager->getVilNomId($par->getParcVill1());?></td>
        <td class="TableauLister"><?php echo $villeManager->getVilNomId($par->getParcVill2());?></td>
          <td class="TableauLister"><?php echo $par->getParcKm();?></td>
        </tr>
      <?php  }?>
      </table>

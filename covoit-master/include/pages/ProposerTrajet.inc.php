 <h1>Proposer un trajet</h1>

<?php
$db = new myPdo();
$manager = new ParcoursManager($db);
$parcourManager = new ParcoursManager($db);
$villeManager = new VilleManager($db);

$tabVille = $villeManager->getAllVilles();
$listeParcours = $parcourManager->getAllParcours();
$parcour = $parcourManager->getVilleParcours();

var_dump($parcour);
 ?>
     <label> Ville de départ : </label>

     <select class="" name="parc_vil1" required>
       <option value="0"> Choisissez</option>
       <?php foreach ($parcour as $parc){ ?>
         <option value="<?php echo $parc->getParcVill1() ?>"><?php echo $villeManager->getVilNomId($parc->getParcVill1());?></option>
       <?php }
        ?>
       </select>


       <label> Ville d'arrivée : </label>
       <select class="" name="parc_vil2" required>

         <option value="0"> Choisissez</option>
         <?php //$villes2 = getVilleDispo($parcour->getVilleParcours()->getParcVill1()); ?>
         <?php foreach ($villes2 as $parc){
            ?>

           <option value="<?php echo $parc->getParcVill2() ?>"><?php echo $parc->$villeManager->getVilNomId($parc->getParcVill2());?></option>
         <?php } ?>
         </select>



         <?php
             echo 'Date de départ : <input type="date" name="pro_date" size="10" value="'.date('Y-m-d').'">';
         ?>
             <br /><br />
         <?php
             echo 'Heure de départ : <input type="time" name="pro_time" size="10" value="'.date("H:i:s").'">';
         ?>
             <br /><br />
             Nombre de places : <input type="text" name="pro_place" size="10">
             <br /><br />
             <input type="submit" name="bouton" value="Valider">

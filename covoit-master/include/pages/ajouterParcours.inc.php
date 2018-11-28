<?php
$db = new myPdo();
$manager = new ParcoursManager($db);
$villeManager = new VilleManager($db);

$tabVille = $villeManager->getAllVilles();
 ?>

 <h1>Ajouter un parcours</h1>

 <?php if (empty($_POST["parc_vil1"]) && empty($_POST["parc_vil2"]) && empty($_POST["parc_km"])){ ?>
   <form class="" action="#" method="post">
     <p>
     <label> Ville 1 : </label>
     <select class="" name="parc_vil1" required>
       <?php foreach ($tabVille as $ville): ?>
         <option value="<?php echo $ville->getVilNum() ?>"><?php echo $ville->getVilNom()?></option>
       <?php endforeach; ?>
       </select>

       <label> Ville 2 : </label>
       <select class="" name="parc_vil2" required>
         <?php foreach ($tabVille as $ville): ?>
           <option value="<?php echo $ville->getVilNum() ?>"><?php echo $ville->getVilNom()?></option>
         <?php endforeach;?>
       </select>
      <label> Nb de km : </label>
      <input type="number" name="parc_km" value="" required>

    </p>
    <input  class="subButton" type="submit" value="Valider">
   </form>

<?php  } else {
  if ($_POST["parc_vil1"] != $_POST["parc_vil2"]) {
    $parcours = new Parcours($_POST);
    $manager->add($parcours);
    ?>
    <p><img src="image/valid.png" alt="valide" title="valide"> Le parcours a été ajoutée !</p.
<?php }
else {
  ?>
  <p>
    <img src="image/erreur.png" alt="erreur" title="erreur">
    Erreur dans l'ajout du parcours !
  </p>
    <?php

  }
} ?>

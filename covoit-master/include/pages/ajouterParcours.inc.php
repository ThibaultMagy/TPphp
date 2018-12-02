<?php
$db = new myPdo();
$manager = new ParcoursManager($db);
$villeManager = new VilleManager($db);

$tabVille = $villeManager->getAllVilles();
 ?>

 <h1>Ajouter un parcours</h1>

 <?php if (empty($_POST["vil_num1"]) && empty($_POST["vil_num2"]) && empty($_POST["par_km"])){ ?>
   <form class="" action="#" method="post">
     <div class="formBloc">
       <div class="labelinputinline">
         <label> Ville 1 : </label>
         <select class="" name="vil_num1" required>
           <?php foreach ($tabVille as $ville): ?>
             <option value="<?php echo $ville->getVilNum() ?>"><?php echo $ville->getVilNom()?></option>
           <?php endforeach; ?>
           </select>
         </div>

         <div class="labelinputinline">
         <label> Ville 2 : </label>
           <select class="" name="vil_num2" required>
             <?php foreach ($tabVille as $ville): ?>
               <option value="<?php echo $ville->getVilNum() ?>"><?php echo $ville->getVilNom()?></option>
             <?php endforeach;?>
           </select>
        </div>
        <div class="labelinputinline">
          <label> Nb de km : </label>
          <input type="number" name="par_km" value="" required>
        </div>
      </div>

    <input  class="subButton2" type="submit" value="Valider" />
   </form>

<?php  } else {
  if ($_POST["vil_num1"] != $_POST["vil_num2"]) {
    $parcours = new Parcours($_POST["par_km"], $_POST["vil_num1"], $_POST["vil_num2"]);
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

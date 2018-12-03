<?php
  $db = new myPdo();
  $personneManager = new PersonneManager($db);
  $etudiantManager = new EtudiantManager($db);
  $salarieManager = new SalarieManager($db);
  $tableauPersonnes = $personneManager->getAllPer();
  $nbPersonnes = $personneManager->getNbPer();

  if(empty($_GET["per_num"])){
?>

<h1>Liste des personnes enregistrées</h1>
<p> Actuellement <?php echo $nbPersonnes; ?> personnes sont enregistrées </p>
<div class="tab">
  <table>
    <tr>
      <th><b> Numéro </b> </th>
      <th><b> Nom </b></th>
      <th><b> Prénom </b></th>
    </tr>
    <?php foreach ($tableauPersonnes  as $personne): ?>
    <tr>

      <?php  echo "<td><a href=\"index.php?page=2&per_num=".$personne->getPerNum()."\">".$personne->getPerNum()."</a></td>"; ?>
      <td class="TableauLister"><?php echo $personne->getPerNom(); ?></td>
      <td class="TableauLister"><?php echo $personne->getPerPrenom(); ?></td>
    </tr>
    <?php endforeach; ?>
    </table>
    </div>
<?php }
      else{
        $per_num = $_GET["per_num"];
        $pers = $personneManager->getPersonne($per_num);
        if($personneManager->isEtudiant($per_num)){
          ?>
            <h1>Détail sur l'étudiant <?php echo $pers->getPerNom(); ?></h1>
            <div class="tab">
              <table>
                <tr>
                  <th><b>Prénom</b></th>
                  <th><b>Mail</b></th>
                  <th><b>Tel</b></th>
                  <th><b>Département</b></th>
                  <th><b>Ville</b></th>
                </tr>
                <tr>
                  <td><?php echo $pers->getPerPrenom(); ?></td>
                  <td><?php echo $pers->getPerMail(); ?></td>
                  <td><?php echo $pers->getPerTel(); ?></td>
                  <td><?php echo $etudiantManager->getDepNom($per_num); ?></td>
                  <td><?php echo $etudiantManager->getVilleNom($per_num); ?></td>
                </tr>
              </table>
            </div>
          <?php
        }
        else
        { ?>
          <h1>Détail sur le salarié <?php echo $pers->getPerNom(); ?></h1>
          <div class="tab">
          <table border=1>
              <tr>
                <th>Prénom</th>
                <th>Mail</th>
                <th>Tel</th>
                <th>Tel pro</th>
                <th>Fonction</th>
              </tr>
              <tr>
                <td><?php echo $pers->getPerPrenom(); ?></td>
                <td><?php echo $pers->getPerMail(); ?></td>
                <td><?php echo $pers->getPerTel(); ?></td>
                <td><?php echo $salarieManager->getTelPro($per_num) ?></td>
                <td><?php echo $salarieManager->getFonction($per_num) ?></td>
              </tr>
            </table>
          </div>
        <?php }
      } ?>

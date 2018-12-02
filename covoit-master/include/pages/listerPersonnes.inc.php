<?php
  $db = new myPdo();
  $personneManager = new PersonneManager($db);

  $tableauPersonnes = $personneManager->getAllPer();
  $nbPersonnes = $personneManager->getNbPer();
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
      <td class="TableauLister"><?php echo $personne->getPerNum(); ?></td>
      <td class="TableauLister"><?php echo $personne->getPerNom(); ?></td>
      <td class="TableauLister"><?php echo $personne->getPerPrenom(); ?></td>
    </tr>
<?php endforeach; ?>
</table>
</div>

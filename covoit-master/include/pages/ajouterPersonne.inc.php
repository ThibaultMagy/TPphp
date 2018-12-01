<?php
  $db = new myPdo();
  $personneManager = new PersonneManager($db);
  $etudiantManager = new EtudiantManager($db);
  $salarieManager = new SalarieManager($db);
  $divisionManager = new DivisionManager($db);
  $departementManager = new DepartementManager($db);

  $tabDivision = $divisionManager->getAllDivisions();
  $tabDepartement = $departementManager->getAllDepartement();
  $form1 = array();
  $form2 = array();

 ?>
<?php if (!isset($form1["per_nom"])) { ?>
        <h1>Ajouter une personne</h1>
        <form class="" action="" method="post">
        <table>
          <tr>
            <td>
              <label> Nom : </label>
              <input type="text" name="per_nom" value="" required>
            </td>
            <td>
              <label> Prénom : </label>
              <input type="text" name="per_prenom" value="" required>
            </td>
          </tr>
          <tr>
            <td>
              <label> Téléphone : </label>
              <input type="text" name="per_tel" value="" required>
            </td>
            <td>
              <label> Mail : </label>
              <input type="text" name="per_mail" value="" required>
            </td>
          </tr>
          <tr>
            <td>
              <label> Login : </label>
              <input type="text" name="per_login" value="" required>
            </td>
            <td>
              <label> Mot de passe : </label>
              <input type="password" name="per_pwd" value="" required>
              <!--password_crypte = sha1(sha1($password).SALT);-->
            </td>
          </tr>
        </table>
    <input type="radio" name="categorie" value="etu" id="etu" required><label for="etu">Étudiant</label>
    <input type="radio" name="categorie" value="perso" id="perso" required><label for="perso">Personnel</label>
    <input class="subButton" type="submit" value="Valider" name="Per">
  </form>
  <?php
    if(!empty($_POST["per_nom"])){$form1["per_nom"]=$_POST["per_nom"];}
    if(!empty($_POST["per_prenom"])){$form1["per_prenom"]=$_POST["per_prenom"];}
    if(!empty($_POST["per_tel"])){$form1["per_tel"]=$_POST["per_tel"];}
    if(!empty($_POST["per_mail"])){$form1["per_mail"]=$_POST["per_mail"];}
    if(!empty($_POST["per_login"])){$form1["per_login"]=$_POST["per_login"];}
    if(!empty($_POST["per_pwd"])){$form1["per_pwd"]=$_POST["per_pwd"];}

  }
  elseif(!empty($form1["per_nom"]) || $form1["categorie"]='etu' || !isset($form2["Etu"])){
    ?>
    <h1>Ajouter un étudiant</h1>
    <form method="post">
      <label>Année</label>
      <SELECT name="annee" required>
        <?php foreach ($tabDivision as $division): ?>
          <option value="<?php echo $division->getDivNum() ?>"><?php echo $division->getDivNom()?></option>
        <?php endforeach;?>
      </SELECT>

      <label>Département</label>
      <SELECT name="dep" size="1" required>
      <?php foreach ($tabDepartement as $departement){ ?>
        <option value="<?php echo $departement->getDepNum()?>"><?php echo $departement->getDepNom()?></option>
      <?php } ?>
      </SELECT>
      <input class="subButton" type="submit" value="Valider" name="Etu">
    </form>
    <?php
    if(!empty($_POST["annee"])){$form2["annee"]=$_POST["annee"];}
    if(!empty($_POST["dep"])){$form2["dep"]=$_POST["dep"];}
    if(!empty($_POST["Etu"])){$_form2["Etu"]=$_POST["Etu"];}
  }
  elseif(!empty($_SESSION["per_nom"]) || $_SESSION["categorie"]='perso' || !isset($_SESSION["Sal"])){ ?>
    <h1>Ajouter un salarié</h1>
    <form method="post">
      <label>Téléphone professionel : </label><SELECT name="tel" size="1" required>

      </SELECT>

      <label>Fonction : </label><SELECT name="fonction" size="1" required>

      </SELECT>
      <input class="subButton" type="submit" value="Valider" name="Sal">
    </form>
    <?php
    $_SESSION["tel"]=$_POST["tel"];
    $_SESSION["fonction"]=$_POST["fonction"];
  }
  elseif(isset($_SESSION["per_nom"]) || isset($_SESSION["categorie"]) || (isset($_SESSION["Etu"]) && isset($_SESSION["Sal"])))
  {
    if(isset($_SESSION["Etu"])){
    /*Premier if mettre les $_POST differents     if pour categorie etudiant ou slarie + nouveau if si on a cree un etudiant dans un autre if verifier si salarie est crée*/
    $personne = new Personne($_POST);
    $personneManager->add($personne);
    $etudiant = new Etudiant($_POST);
    $etudiantManager->add($etudiant);
  }
  elseif(isset($_SESSION["Sal"])){
    $salarie = new Salarie($_SESSION);
    $manager->add($salarie);
  }
  ?>
  <p>
    <img src="image/valid.png" alt="valide" title="valide">
    La personne a été ajoutée
  </p>
  <?php
}?>

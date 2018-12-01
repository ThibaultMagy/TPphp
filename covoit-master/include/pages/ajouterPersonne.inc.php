<?php
  $db = new myPdo();
  $personneManager = new PersonneManager($db);
  $etudiantManager = new EtudiantManager($db);
  $salarieManager = new SalarieManager($db);
  $divisionManager = new DivisionManager($db);
  $departementManager = new DepartementManager($db);

  $tabDivision = $divisionManager->getAllDivisions();
  $tabDepartement = $departementManager->getAllDepartement();

  $nom;
  $prenom;
  $pertel;
  $mail;
  $login;
  $pwd;
  $categorie;

  $annee;
  $dep;
  $tel;
  $fonction;
 ?>
<?php
  if (!isset($nom)) { ?>
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
  if(isset($_POST["per_nom"])){$nom=$_POST["per_nom"];};
  if(isset($_POST["per_prenom"])){$prenom=$_POST["per_prenom"];};
  if(isset($_POST["per_tel"])){$tel=$_POST["per_tel"];};
  if(isset($_POST["per_mail"])){$mail=$_POST["per_mail"];};
  if(isset($_POST["per_login"])){$login=$_POST["per_login"];};
  if(isset($_POST["per_pwd"])){$pwd=$_POST["per_pwd"];};
  if(isset($_POST["categorie"])){$categorie=$_POST["categorie"];};
  }
  elseif(!isset($annee) || $categorie=="etu"){
    $_POST = array();
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
    if(isset($_POST["annee"])){$annee=$_POST["annee"];};
    if(isset($_POST["dep"])){$dep=$_POST["dep"];};
  }
  elseif(!isset($tel) || $categorie=="perso"){
    $_POST = array();
    ?>
    <h1>Ajouter un salarié</h1>
    <form method="post">
      <label>Téléphone professionel : </label><SELECT name="tel" size="1" required>

      </SELECT>

      <label>Fonction : </label><SELECT name="fonction" size="1" required>

      </SELECT>
      <input class="subButton" type="submit" value="Valider" name="Sal">
    </form>
    <?php
    if(isset($_POST["tel"])){$tel=$_POST["tel"];};
    if(isset($_POST["fonction"])){$fonction=$_POST["fonction"];};
  }
  else
  {
    if($categorie=="etu"){
    $personneManager->add($nom, $prenom, $pertel, $mail, $login, $pwd);
    $etudiantManager->add($annee, $dep);
  }
  elseif($categorie=="perso"){
    $personneManager->add($nom, $prenom, $pertel, $mail, $login, $pwd);
    $salarieManager->add($tel, $fonction);
  }
  ?>
  <p>
    <img src="image/valid.png" alt="valide" title="valide">
    La personne a été ajoutée
  </p>
  <?php
}?>

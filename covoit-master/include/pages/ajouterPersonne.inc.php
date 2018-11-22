<?php
  $db = new myPdo();
  $personneManager = new PersonneManager($db);
  $etudiantManager = new EtudiantManager($db);
  $salarieManager = new SalarieManager($db);
  $divisionManager = new DivisionManager($db);

  $tabDivision = $divisionManager->getAllDivision();
 ?>
<h1>Ajouter une personne</h1>

<?php if (empty($_POST["per_nom"]) || empty($_POST["per_prenom"]) || empty($_POST["per_tel"]) || empty($_POST["per_mail"])
      || empty($_POST["per_login"]) || empty($_POST["per_pwd"])) {
        echo '<form class="" action="" method="post">
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
        </td>
      </tr>
    </table>
    <input type="radio" name="categorie" value="etu" id="etu" required><label for="etu">Étudiant</label>
    <input type="radio" name="categorie" value="perso" id="perso" required><label for="perso">Personnel</label>
    <input class="subButton" type="submit" value="Valider">
  </form>
  ';
  }
  elseif(!empty($_POST["per_nom"]) || !empty($_POST["per_prenom"]) || !empty($_POST["per_tel"]) || !empty($_POST["per_mail"])
        || !empty($_POST["per_login"]) || !empty($_POST["per_pwd"]) || isset($_POST['etu'])){
    echo'
    <form>
      <label>Année</label><SELECT name="annee" size="1" required>
      <?php foreach ($tabDivision as $division): ?>
        <option value="<?php echo $division->getDivNum() ?>"><?php echo $division->getDivNom()?></option>
      <?php endforeach; ?>
      </SELECT>

      <label>Département</label><SELECT name="dep" size="1" required>
      <?php
      while($row=mysqli_fetch_array($res,MYSQL_ASSOC)){?>
        <OPTION value="<?php echo $row[\'dep_nom\']; ?>">
        <?php
        echo $row[\'dep_nom\'];
        ?>
        </OPTION>
      <?php}?>
      </SELECT>
      <input class="subButton" type="submit" value="Valider">
    </form>
    ';
  }
  elseif(!empty($_POST["per_nom"]) || !empty($_POST["per_prenom"]) || !empty($_POST["per_tel"]) || !empty($_POST["per_mail"])
        || !empty($_POST["per_login"]) || !empty($_POST["per_pwd"]) || isset($_POST['perso'])){
    echo'
    <form>
      <label>Téléphone professionel : </label><SELECT name="tel" size="1" required>
      <?php
      while($row=mysqli_fetch_array($res,MYSQL_ASSOC)){?>
        <OPTION value="<?php echo $row[\'per_tel\']; ?>">
        <?php
        echo $row[\'per_tel\'];
        ?>
        </OPTION>
      <?php}?>
      </SELECT>

      <label>Fonction : </label><SELECT name="fonction" size="1" required>
      <?php
      while($row=mysqli_fetch_array($res,MYSQL_ASSOC)){?>
        <OPTION value="<?php echo $row[\'fon_libelle\']; ?>">
        <?php
        echo $row[\'fon_libelle\'];
        ?>
        </OPTION>
      <?php}?>
      </SELECT>
      <input class="subButton" type="submit" value="Valider">
    </form>
    ';
  }
  else {
    $personne = new Personne($_POST);
    $personneManager->add($personne);
    if(isset($_POST["etu"])){
        $etudiant = new Etudiant($_POST);
        $manager->add($etudiant);
    }
    elseif(isset($_POST['perso'])){
      $salarie = new Salarie($_POST);
      $manager->add($salarie);
    }
  ?>
  <p>
    <img src="image/valid.png" alt="valide" title="valide">
    La  "<b> <?php echo $_POST["per_prenom"]?></b> a été ajoutée
  </p>
<?php  }  ?>

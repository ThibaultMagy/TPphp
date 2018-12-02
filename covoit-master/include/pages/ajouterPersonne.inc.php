<?php
  $db = new myPdo();
  $personneManager = new PersonneManager($db);
  $etudiantManager = new EtudiantManager($db);
  $salarieManager = new SalarieManager($db);
  $divisionManager = new DivisionManager($db);
  $departementManager = new DepartementManager($db);
  $fonctionManager = new FonctionManager($db);

  $tabDivision = $divisionManager->getAllDivisions();
  $tabDepartement = $departementManager->getAllDepartement();
  $tabFonction = $fonctionManager->getAllFonctions();

?>
<?php
  if (empty($_POST["per_nom"]) && empty($_POST["per_tel"]) && empty($_POST["per_login"]) && empty($_POST["annee"]) && empty($_POST["dep"]) && empty($_POST["fonction"]) && empty($_POST["tel"])) {
    ?>
        <h1>Ajouter une personne</h1>
        <form class="" action="#" method="post">
          <div class="formBloc">
            <div class="labelinput">
              <label> Nom : </label>
              <input type="text" name="per_nom" value="" required>
            </div>
            <div class="labelinput">
              <label> Téléphone : </label>
              <input type="text" name="per_tel" value="" required>
            </div>
            <div class="labelinput">
              <label> Login : </label>
              <input type="text" name="per_login" value="" required>
            </div>
          </div>
          <div class="formBloc">
            <div class="labelinput">
              <label> Prénom : </label>
              <input type="text" name="per_prenom" value="" required>
            </div>
            <div class="labelinput">
              <label> Mail : </label>
              <input type="text" name="per_mail" value="" required>
            </div>
            <div class="labelinput">
              <label> Mot de passe : </label>
              <input type="password" name="per_pwd" value="" required>
            </div>
          </div>
              <!--password_crypte = sha1(sha1($password).SALT);-->
    <div class=formBlocext>
      <div class="labelinputinline"><input type="radio" name="categorie" value="etu" id="etu" required><label for="etu">Étudiant</label></div>
      <div class="labelinputinline"><input type="radio" name="categorie" value="perso" id="perso" required><label for="perso">Personnel</label></div>
    </div>
    <input class="subButton2" type="submit" value="Valider" name="Personne">
  </form>
  <?php }
  if(!empty($_POST["per_nom"]) && !empty($_POST["per_tel"]) && !empty($_POST["per_login"])){
    $pers = new Personne($_POST);
    $pers->setPerNom($_POST["per_nom"]);
    $pers->setPerPrenom($_POST["per_prenom"]);
    $pers->setPerTel($_POST["per_tel"]);
    $pers->setPerMail($_POST["per_mail"]);
    $pers->setPerLogin($_POST["per_login"]);
    $pers->setPerPwd($_POST["per_pwd"]);
    $_SESSION["addPers"] = serialize($pers);
    if($_POST["categorie"]=="etu"){
      $_SESSION["categorie"] = $_POST["categorie"];
  ?>
  <h1> Ajouter un étudiant </h1>
  <form action="" id="addEtu" method="post">
    <div class="formBloc">
      <div class="labelinputinline">
        <label> Année :</label>
        <select size="1" name="annee">
          <?php
            foreach($tabDivision as $division){ ?>
              <option value="<?php echo $division->getDivNum(); ?>"> <?php echo $division->getDivNom(); ?> </option>
            <?php } ?>
        </select>
      </div>
      <div class="labelinputinline">
        <label>Département : </label>
        <select size="1" name="dep">
          <?php
            foreach($tabDepartement as $departement){ ?>
              <option value="<?php echo $departement->getDepNum(); ?>"> <?php echo $departement->getDepNom(); ?></option>
            <?php } ?>
        </select>
      </div>
    </div>
    <input class="subButton2" type="submit" value="Valider"/>
  </form>
  <?php }
  else{
    $_SESSION["categorie"] = $_POST["categorie"];
    ?>
    <h1> Ajouter un salarié </h1>
    <form action="#" id="sal" method="POST">
      <div class="formBloc">
        <div class="labelinputinline">
          <label for="Telephone">Telephone professionnel :</label>
          <input type="text" name="tel" id="tel" size="15">
        </div>
        <div class="labelinputinline">
          <label for="Fonction">Fonction :</label>
          <select size="1" name="fonction">
            <?php
              foreach($tabFonction as $fonction){ ?>
                <option value="<?php echo $fonction->getFonNum(); ?>"> <?php echo $fonction->getFonLibelle(); ?> </option>
              <?php } ?>
          </select>
        </div>
      </div>
      <input class="subButton2" type="submit" value="Valider"/>
    </form>
    <?php }
    if(!empty($_POST["annee"]) && !empty($_POST["dep"]) && $_SESSION["categorie"] == "etu"){
      $personne = unserialize($_SESSION["addPers"]);
      $ajout = $personneManager->add($personne);
      $etudiant = new Etudiant($_POST);
      $etudiant->setDepNum($_POST["dep"]);
      $etudiant->setDivNum($_POST["annee"]);
      $addEtudiant = $etudiantManager->add($etudiant);
      ?>
      <img src="image/valid.png"> L'étudiant a bien été ajouté !
      </br></br>
      <?php
      header("Refresh:2, url=./index.php?page=0");
    }
    if(!empty($_POST["fonction"]) && !empty($_POST["tel"])){
      $add = unserialize($_SESSION["addPers"]);
      $ajout = $personneManager->add($add);
      $salarie = new Salarie($_POST);
      $salarie->setSalTelProf($_POST["tel"]);
      $salarie->setSalFonNum($_POST["fonction"]);
      $ajoutSalarie = $salarieManager->add($salarie);
      ?>
      <img src="image/valid.png"> Le salarié a bien été ajouté !
      </br></br>
      <?php
      header("Refresh:2, url=./index.php?page=0");
    }
  } ?>

<?php
  $db = new myPdo();
  $manager = new PersonneManager($db);
 ?>
<h1>Ajouter une personne</h1>

<?php if (empty($_POST["per_nom"]) && empty($_POST["per_prenom"]) && empty($_POST["per_tel"]) && empty($_POST["per_mail"])
      && empty($_POST["per_login"]) && empty($_POST["per_pwd"])) {
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
  else {
    $personne = new Personne($_POST);
    $manager->add($personne);
  ?>
  <p>
    <img src="image/valid.png" alt="valide" title="valide">
    La  "<b> <?php echo $_POST["per_prenom"]?></b> a été ajoutée
  </p>
<?php  }  ?>

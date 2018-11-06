<h1>Ajouter une ville</h1>

<form name="form" method="post">
  <h2>Nom : </h2>
  <input type="text" name="nomVille"></input>
  <input type="submit" name="sub" onclick="form.submit()" class="subButton"></input>
  <?php
    include('classes/Ville.class.php');
    if(isset($_POST["nomVille"])){
      $nomVille = $_POST["nomVille"];
      $ville = new Ville();
      $ville->setNom($nomVille);
    }
  ?>
</form>

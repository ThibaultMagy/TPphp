<?php
$db = new myPdo();
$personne= new PersonneManager($db);


if (empty($_POST[username]) && empty($_POST[password])) { ?>

  <h1>Pour vous connecter</h1>
  <form class="" action="#" method="post">
    <label> Nom d'utilisateur : </label>
    <input type="text" name="UserName" value="" required>
  <br>
  <br>
  <br>
    <label> Mot de passe : </label>
    <input type="password" name="password" value="" required>
  <br>
  <br>
      <input class="subButton" type="submit" value="Valider">

  </form>
<?php } else {
  $username = $_POST[username];
  $pswd = $_POST[password];
  $password_crypte=sha1($_POST[password]);
  $loger =$personne->getPersonneForPwdId($username,$password_crypte);
  var_dump($loger);
  if ($loger) {
    $personneLog = $personne->creationPersonne($username);
    $_SESSION["id"] = $personneLog->getPerLogin();
    $_SESSION["num"] = $personneLog->getPerNum();
    ?> <img src="image/valid.png"> Vous êtes connectés !
    <br> <br>
    Redirection automatique dans 2 secondes...
  <?php
  header("Refresh:2,url=./index.php?page=0");
}else {
  print_r($personneLog);
  print_r($loger);
    ?>
    <img src="image/erreur.png"> Erreur de connexion, veuillez réessayer.
    <?php
//header("Refresh:2,url=./index.php?page=11");

  }


}
 ?>

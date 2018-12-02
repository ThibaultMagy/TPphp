<?php
  if(empty($_POST["login"]) || empty($_POST["passwd"])){
    $randA = rand(1,9);
    $randB = rand(1,9);
    $reponse = $randA + $randB;
?>
<h1>Pour vous connecter</h1>
<form action="#" id="connexion" method="POST">
  <label for="Utilisateur">Nom d'utilisateur :</label>
  <input type="text" name="login" id="login"></input>
  </br></br>
  <label for="Passwd">Mot de passe :</label>
  <input type="password" name="passwd" id="passwd"></input>
  </br></br>
  <label for="code">
    <img src="image/nb/<?php echo $randA ?>.jpg">
    +
    <img src="image/nb/<?php echo $randB ?>.jpg">
    =
  </label>
  <input type="text" pattern="<?php echo $reponse ?>" name="code" id="code" required></input>
  </br></br>
  <input type="submit" value="Valider"></input>
</form>
</br>
<?php
}else{
  $pdo = new Mypdo();

  $login = $_POST["login"];
  $password = $_POST["passwd"];
  $password_crypte = sha1(sha1($password).SALT);

  $personneManager = new PersonneManager($pdo);
  $isPersonne = $personneManager->isPersonne($login, $password_crypte);
  if($isPersonne){
    $personne = $personneManager->getPersonne($login);
    $_SESSION["log"] = $personne->getPerLogin();
    $_SESSION["idPers"] = $personne->getPerNum();
?>
<img src="image/valid.png"> Vous vous êtes connecté avec succès !
</br></br>
Redirection automatique dans 2 secondes...

<?php
header("Refresh:2, url=./index.php?page=0");
}else{
?>
<img src="image/erreur.png"> Erreur de connexion, veuillez reessayer.

<?php header("Refresh:2, url=./index.php?page=11");
}
} ?>

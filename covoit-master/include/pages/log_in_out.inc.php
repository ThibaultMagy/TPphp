<?php
    $premierChiffre = rand(1,9);
    $deuxiemeChiffre = rand(1,9);
    $db = new myPdo();

    $ConnexionManager = new ConnexionManager($db);
?>

<?php
    if (empty($_SESSION['estConnecte']) || $_SESSION['estConnecte'] == false) {
        echo "<h1>Pour vous connecter</h1>";

        if (empty($_POST['login_personne'])) {
?>

<form action="#" method="POST">

    <table>

        <tr>
            <td><label for="login_personne">Login : </label></td>
            <td><input name="login_personne" type="text" maxlength="20" required></td>
        </tr>

        <tr>
            <td><label for="pwd_personne">Mot de passe : </label></td>
            <td><input name="pwd_personne" type="password" maxlength="100" required></td>
        </tr>

        <tr>

<?php
    echo "  <input type=\"text\" name=\"premierChiffre\" value=\"".$premierChiffre."\" hidden>";
    echo "  <input type=\"text\" name=\"deuxiemeChiffre\" value=\"".$deuxiemeChiffre."\" hidden>";
    echo "  <td><img src=\"./image/nb/".$premierChiffre.".jpg\" alt=\"un chiffre\"><b>+</b><img src=\"./image/nb/".$deuxiemeChiffre.".jpg\" alt=\"un chiffre\"><b>=</b></td>";
?>

            <td><input type="number" name="captcha" required></td>
        </tr>

    </table>

    <input type="submit" value="Valider">

</form>

<?php
        } else {
            if ($ConnexionManager->estCorrect($_POST['login_personne'], $_POST['pwd_personne'], $_POST['captcha'], $_POST['premierChiffre'], $_POST['deuxiemeChiffre'])) {

                $_SESSION['estConnecte'] = true;
                $_SESSION['numero'] = $ConnexionManager->getNumPersonne($_POST['login_personne']);
                $_SESSION['nom'] = $_POST['login_personne'];

                echo "<img src=\"./image/valid.png\" alt=\"icone valide\">";
                echo "<p>Vous avez bien été connecté !</p>\n";
                header("Refresh:2,url=./index.php?page=0"); //redirection sur index

            } else {

                echo "<img src=\"./image/erreur.png\" alt=\"icone erreur\">";
                echo "<p class=\"important\">Les informations saisies sont incorrectes</p>";
                header("Refresh:2,url=./index.php?page=0");//redirection sur page de connexion
            }
        }

    } else {

        $_SESSION['estConnecte'] = false;

        echo "<img src=\"./image/valid.png\" alt=\"icone valide\">";
        echo "<p>Vous avez bien été déconnecté.</p>";
        header("Refresh:2,url=./index.php?page=0"); //redirection sur index
    }
?>

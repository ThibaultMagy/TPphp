<?php include('classes/Personne.class.php'); ?>
<h1>Ajouter une personne</h1>

<FORM>
  <div id="gauche" class="gauche">
    <div id="texteGauche" class="gauche">
      <p>Nom :           </p><input placeholder=" ex : Durand" />
      <br />
      <p>Téléphone :     </p><input placeholder=" ex : 0555434355" />
      <br />
      <p>Login :         </p><input placeholder=" ex : jojo" />
  </div>

  <div id="droite" class="droite">
    <p>Prénom :        </p><input placeholder=" ex : Joe" />
    <br />
    <p>Mail :          </p><input placeholder=" ex jojo@joemail.com" />
    <br />
    <p>Mot de passe :  </p><input />
  </div>

  <div>
    <input type="radio" name="categorie" value="Etudiant" id="etu" class="rdButton"/> <label for="etu">Etudiant</label><br />
    <input type="radio" name="categorie" value="Personnel" id="perso" class="rdButton"/> <label for="perso">Personnel</label><br />
    <input type="submit" Value="Valider" class="subButton" />
  </div>
</FORM>

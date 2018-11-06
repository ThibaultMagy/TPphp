<?php
include('classes/Ville.class.php');
?>
<h1>Ajouter un parcours</h1>

<FORM>
  Ville1<SELECT>
    <?php
    while($row=mysqli_fetch_array($res,MY_SQL_ASSOC)){
      echo '<OPTION>';
      echo $row['vil_nom'];
    }
    ?>
  </SELECT>

  Ville2<SELECT>
    <?php
    ?>
  </SELECT>

  Nombre de kilomètre(s)<input placeholder=" ex: 250"></input>

  <button type="button">valider</button>

</FORM>

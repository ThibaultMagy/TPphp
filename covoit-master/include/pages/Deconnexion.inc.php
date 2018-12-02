<img src="image/valid.png"> Vous allez être déconnecté !
</br></br>
Redirection dans 2 secondes...

<?php
session_destroy();
header("Refresh:2, url=./index.php?page=0");
?>

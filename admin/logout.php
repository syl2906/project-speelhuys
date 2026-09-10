<?php


setcookie("speelhuys-session", "", time()-3600, "/");
header("location: ../index.php");

?>

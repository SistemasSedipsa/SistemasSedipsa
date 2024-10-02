<?php
session_start();

session_unset();
session_destroy();
header("Location: ../index.php?mensaje=Cierre%20de%20sesión%20exitoso&tipo=success");
exit();
?>
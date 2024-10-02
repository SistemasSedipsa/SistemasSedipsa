<?php
session_start();
session_unset();
session_destroy();
header("Location: ../index.php?mensaje=Has%20cerrado%20sesión%20correctamente&tipo=success");  // Redirige a la página de inicio de sesión con mensaje
exit();
?>

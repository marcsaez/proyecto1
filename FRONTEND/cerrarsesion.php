<?php
session_start();

session_unset();  // Elimina todas las variables de sesión
session_destroy();  // Destruye la sesión

// Redirecciona al usuario a login.php
header('Location: login.php');
exit();
?>

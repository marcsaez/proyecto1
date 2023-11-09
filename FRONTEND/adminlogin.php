<?php
include_once("funciones.php");

if($_POST){
    session_start();
    comprobacionDatosLogInAdmin();
} else {
    ?>
        <meta http-equiv="REFRESH" content="0;url=admin.php">
    <?php
}
?>
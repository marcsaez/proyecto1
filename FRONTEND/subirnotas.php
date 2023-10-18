<?php 
    session_start();
    if($_SESSION){
        include_once('funciones.php');
        $codigo = $_SESSION['codigo'];
        SubirNotas($codigo);
        
    }
?>
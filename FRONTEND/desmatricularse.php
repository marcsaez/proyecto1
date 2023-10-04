<?php 
    session_start();
    $dni = $_SESSION['dni'];
    $codigo = $_SESSION ['codigo'];
    include_once('funciones.php');
    if($_POST){
        desmatricular($dni, $codigo);
    } else{
        echo"ERROR";
    }
?>
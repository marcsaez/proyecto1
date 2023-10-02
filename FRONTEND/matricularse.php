<?php 
    session_start();
    $dni = $_SESSION['dni'];
    $codigo = $_SESSION ['codigo'];
    include_once('funciones.php');
    if($_POST){
        matricular($dni, $codigo);
    } else{
        echo"ERROR";
    }
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matricularse</title>
</head>
<body>
    
</body>
</html>
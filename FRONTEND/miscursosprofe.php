<?php 
    session_start();
    include_once('funciones.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
    <title>Mis Cursos</title>
</head>
<body>
    <?php
        if($_SESSION){
            $dni = $_SESSION['dni'];
            $datos = sessionProfe($dni);
            encabezadoProfe($datos);
            CursosProfe($dni);
               
        footer();
        } else{
            ?>
            <h2>ERROR: ¡SESION NO INICIADA!</h2>
            <meta http-equiv="REFRESH" content="3;url=login.php">
            <?php
        }
    ?>
</body>
</html>
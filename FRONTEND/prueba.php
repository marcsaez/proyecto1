<?php 
    // CREADO MOMENTARIAMENTE PARA HACER PRUEBAS CON EL HEADER
    session_start();
    $dni = $_SESSION['dni'];
    include_once('funciones.php');
    $datos = sessionAbrir($dni);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado cursos</title>
    <link rel="stylesheet" type="text/css" href="./css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
</head>
<body>
<?php
        encabezadoUsuario($datos)
?>
</body>
<?php 
    session_start();
    
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
        if($_SESSION){
            $dni = $_SESSION['dni'];
            include_once('funciones.php');
            $datos = sessionAbrir($dni);
    ?>
    <script src = "./js/concurso.js"></script>
    <header>
        <div class="header">
        <a href="menuadmin.php"><img src="./img/TECHrecortada.png" alt="TechAcademy" id="logo"></a>
            <h2 id="titulo">TECH ACADEMY</h2>
        </div>
        <?php 
            datosUserVisibles($datos);
        ?>
    </header>
    <?php

    $codigo = $_POST['codigo'];
    $_SESSION ['codigo'] = $codigo;
    mostrarCurso($dni, $codigo);
   
    ?>
    <footer>
        <div class="contacto">
            <p>consultas@techacademy.com</p>
            <p>C/de la Batlloria, Badalona</p>
        </div>
        <div class="copyright">
            <p>© 2023 TECH ACADEMY</p>
        </div>
    </footer>
    <?php
        } else{
            ?>
            <h2>ERROR: ¡SESION NO INICIADA!</h2>
            <meta http-equiv="REFRESH" content="3;url=login.php">
            <?php
        }
    ?>
</body>
</html>
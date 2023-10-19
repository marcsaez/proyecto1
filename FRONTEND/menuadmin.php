<?php
    include_once('funciones.php');
    adminLogin();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="./css/styles.css">
</head>
<body>
    <header>
        <div class="header">
            <img src="./img/TECHrecortada.png" alt="TechAcademy" id="logo">
            <h2 id="titulo">TECH ACADEMY</h2>
        </div>
        <div class="usuario">
        <?php
            echo '<p id="username" >'. $_SESSION['usuario'] .'</p>'
        ?>
            <img src="./img/98-1.jpg" alt="fotoperfil" id="fotoperfil">
        </div>
    </header>

    <a href="./admincursos.php"><h2>Cursos</h2></a>
    <a href="./adminprofes.php"><h2>Profesores</h2></a>
    <a href="./insertalumnos.php"><h2>Insertar Alumnos</h2></a>

    <footer>
        <div class="contacto">
            <p>consultas@techacademy.com</p>
            <p>C/de la Batlloria, Badalona</p>
        </div>
        <div class="copyright">
            <p>© 2023 TECH ACADEMY</p>
        </div>
    </footer>
</body>
</html>
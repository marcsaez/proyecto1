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

    <div class="curso-wrapper">
        <a href="./admincursos.php">
            <div class="menu">
                <img src="./img/curso.png">
                <h1>Cursos</h1>
            </div>
        </a>
        <a href="./adminprofes.php">
            <div class="menu">
                <img src="./img/profesor.png">
                <h1>Profesores</h1>
            </div>
        </a>
        <a href="./insertalumnos.php">
            <div class="menu">
                <img src="./img/alumno.png">
                <h1>Alumnos</h1>
            </div>
        </a>       
    </div>
    

</body>
</html>
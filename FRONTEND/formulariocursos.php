<?php 
    include("funciones.php");
    adminLogin();
    if ($_POST){
        crearcurso();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear curso</title>
    <link rel="stylesheet" type="text/css" href="./css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="header">
        <a href="menuadmin.php"><img src="./img/TECHrecortada.png" alt="TechAcademy" id="logo"></a>
            <h2 id="titulo">TECH ACADEMY</h2>
        </div>
        <div class="usuario">
        <?php
            echo '<p id="username" >'. $_SESSION['usuario'] .'</p>';
        ?>
            <img src="./img/98-1.jpg" alt="fotoperfil" id="fotoperfil">
        </div>
    </header>
    <a href="./admincursos.php"><span title="Volver administracion cursos"><img src="./img/flecha_atras.png" alt="atras" id="atras" style="width: 50px;"></span></a>
    <!-- <a href="./admincursos.php"><h2>Modificar cursos</h2></a> -->
    <h2>Crear Nuevo Curso</h2>

    <form action="#" method="post" enctype = "multipart/form-data">
        <p>Nombre del Curso:<input type="text" name="nombre" required maxlength="100"></p>
        
        <p>Descripción:<textarea name="descripcion" rows="4" cols="50" required maxlength="250"></textarea></p>

        <p>Horas:<input type="number" name="horas" required></p>       

        <p>Fecha de Inicio: (AAAA-MM-DD)<input type="date" name="inicio" required></p>       

        <p>Fecha de Finalización: (AAAA-MM-DD)<input type="date" name="final" required></p>        

        <p>DNI del Profesor:<input type="text" name="fk_profesor" required maxlength="9"></p>  

        <p>Imagen del curso:<input type="file" name="imagen" accept=".jpg, .png, .jpeg" required></p>
        
        <input type="submit" value="Crear Curso">
    </form>

</body>
</html>
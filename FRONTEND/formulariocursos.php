<?php 
    include("funciones.php");
    if ($_POST){
        crearcurso();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario cursos</title>
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
            <!-- FOTO DE PRUEBA PARA MEDIDAS (HAY QUE SACARLA DE LA BBDD) -->
            <p id="username" >Pablo de Gregorio</p>
            <img src="./img/98-1.jpg" alt="fotoperfil" id="fotoperfil">
        </div>
    </header>
    <h2>Crear Nuevo Curso</h2>

    <form action="" method="post">
        <label for="nombre">Nombre del Curso:</label>
        <input type="text" name="nombre" required><br>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" rows="4" cols="50" required></textarea><br>

        <label for="horas">Horas:</label>
        <input type="number" name="horas" required><br>

        <label for="inicio">Fecha de Inicio: (AAAA-MM-DD)</label>
        <input type="text" name="inicio" required><br>

        <label for="final">Fecha de Finalización: (AAAA-MM-DD)</label>
        <input type="text" name="final" required><br>

        <label for="fk_profesor">DNI del Profesor:</label>
        <input type="text" name="fk_profesor" required><br>

        <label for="imagen">Imagen del curso (solo formato PNG):</label>
        <input type="file" name="imagen" accept=".png"><br>
        
        <input type="submit" value="Crear Curso">
    </form>

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
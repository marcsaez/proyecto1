<?php 
    include("funciones.php");
    if ($_POST){
        crearProfe();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario profesor</title>
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
<h2>Crear Nuevo Profesor</h2>

    <form action="" method="post">
        <label for="dni">DNI del profesor:</label>
        <input type="text" name="dni" required><br>

        <label for="nombre">Nombre del profesor:</label>
        <input type="text" name="nombre" required><br>

        <label for="apellidos">Apellidos del profesor:</label>
        <input type="text" name="apellidos" required><br>

        <label for="titulo_academico">Titulo del profesor:</label>
        <input type="text" name="titulo_academico" required><br>

        <label for="foto">Foto (en proceso):</label>
        <input type="text" name="foto"><br>

        <input type="submit" value="Crear Profesor">
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
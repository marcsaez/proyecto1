<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin cursos</title>
    <link rel="stylesheet" type="text/css" href="./css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="header">
            <img src="./img/TECHrecortada.png" alt="TechAcademy" id="logo">
            <h2 id="titulo">TECH ACADEMY</h2>
        </div>
        <div class="usuario">
            <p id="username" >Pablo de Gregorio</p>
            <img src="./img/98-1.jpg" alt="fotoperfil" id="fotoperfil">
        </div>
    </header>
        <?php
            include_once("funciones.php");
            
            adminCursos();
        ?>
    </table>
</body>
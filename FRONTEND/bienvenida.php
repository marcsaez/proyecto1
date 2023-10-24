<?php 
    session_start();
    include_once('funciones.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="./css/styles.css">
</head>
<body class="home">
    <?php
    if($_SESSION){
        if ($_SESSION ['tipo']=='alumno') { 
            $dni = $_SESSION['dni'];
            $datos = sessionAbrir($dni);
            encabezadoUsuario($datos);
        }elseif($_SESSION ['tipo']=='admin'){
            EncabaezadoAlternativo();
        }elseif ($_SESSION ['tipo']=='profesor'){
            $dni = $_SESSION['dni'];
            $datos = sessionProfe($dni);
            encabezadoProfe($datos);
        }  
    } else{
        EncabaezadoAlternativo();
    }
    ?>
    <table>
        <tr>
            <td colspan="3">Mira a tu alrededor. Estás rodeado de informática. Es tan importante su papel en la actualidad que, muchas veces, ni siquiera nos paramos a pensarlo. Si tu sueño es ser informático y eres consciente de esta necesidad, este artículo te interesa. ¿No sabes qué especialidad de la informática escoger? </td>
        </tr>
        <tr>
            <td class="imagen"> <img src="./img/java.png" alt="Descripción de la imagen"></td>
            <td class="imagen"> <img src="./img/python.png" alt="Descripción de la imagen"></td>
            <td class="imagen"> <img src="./img/mysql.png" alt="Descripción de la imagen"></td>
        </tr>
    </table>

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
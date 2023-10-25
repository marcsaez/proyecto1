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
    <div class = "bienvenida">
        <div class = "FotoBienvenida" >
            <img src="./img/fondo1.jpg" alt="FotoPrincipal">
            <h1>TECH ACADEMY</h1>
        </div>
        <div class = "BodyBienvenida">

        </div>
    </div>
    <table>
        <tr>
            <th colspan = "3">Descubre tu futuro en la tecnologia: ¡Explora las especialdiades de la Informatica en Tech Academy!</th>
        </tr>
        <tr>
            <td colspan="3">Mira a tu alrededor. Estás rodeado de informática. Es tan importante su papel en la actualidad que, muchas veces, ni siquiera nos paramos a pensarlo. Si tu sueño es ser informático y eres consciente de esta necesidad, este artículo te interesa. ¿No sabes qué especialidad de la informática escoger? </td>
        </tr>
        <tr>
            <td class="imagen">  <img src="./img/java.png" alt="Descripción de la imagen"></td>
            <td class="imagen"> <img src="./img/python.png" alt="Descripción de la imagen"></td>
            <td class="imagen"> <img src="./img/mysql.png" alt="Descripción de la imagen"></td>
        </tr>
        <tr>
            <td colspan="3">La omnipresencia de la informática en nuestro día a día es innegable. Desde el smartphone en tu bolsillo hasta los sistemas que gestionan el tráfico de datos a nivel global, la tecnología informática está en todas partes, impulsando avances significativos en campos tan diversos como la medicina, la educación y la comunicación.
        Como futuro informático, te encuentras en una posición privilegiada para dar forma al mundo que te rodea. Sin embargo, con tantas especialidades disponibles en el campo de la informática, es natural que te enfrentes a la pregunta: '¿Qué camino debo seguir?'
        Cada especialidad informática ofrece un conjunto único de desafíos y oportunidades. Desde el desarrollo de software hasta la ciberseguridad, pasando por la inteligencia artificial y la administración de bases de datos, el abanico de posibilidades es amplio. En este artículo, te ayudaremos a explorar estas especialidades y a identificar la que mejor se adapte a tus intereses y objetivos profesionales.
        Descubre con nosotros las emocionantes posibilidades que el mundo de la informática tiene reservadas para ti. ¡Sigue leyendo y prepárate para tomar una decisión informada sobre tu futuro en esta apasionante industria!</td>
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
<?php
    try{
        if(session_start()){
            session_destroy();
            session_start();
        } else {
            session_start();
        }
        
    } catch (Exception $e) {
        echo "ERROR";
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" type="text/css" href="./css/inicio.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
</head>
<body>
    <?php
    include_once("funciones.php");
        //Si existeix l'array POST introdueix les dades a una posicio de SESSION i redirigeix a menu.php
        if($_POST) {
            comprobarDatosLogIn();
        }
        //Si no existeix l'array POST entra al un formulari
        else {
            formularioInicio();
        }
        ?>
</body>
</html>
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
    <div>
        <h1>ADMIN</h1>
        <form enctype="multipart/form-data" action="adminlogin.php" method="POST">
            <table>
                <tr>
                    <td class="imagen" colspan="2"> <img src="./img/TECHrecortada.png" alt="Descripción de la imagen"></td>
                </tr>
                <tr>
                    <td> <label for="id">ID:</label> </td> <td> <input type="text" name="id" id="id" required> </td>
                </tr>
                <tr>
                    <td> <label for="name">usuario:</label> </td> <td> <input type="text" name="usuario" id="name" required> </td>
                </tr>
                <tr>
                    <td> <label for="contraseña">Contraseña:</label> </td> <td> <input type="password" name="contraseña" id="contraseña" required> </td>
                </tr>
                <tr>
                    <td id="iniciar" style="text-align:center" colspan="2"> 
                        <input type="submit" name="Aceptar" value="Aceptar">
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <?php
    include_once("funciones.php");
        //Si existeix l'array POST introdueix les dades a una posicio de SESSION i redirigeix a menu.php
        
        ?>
</body>
</html>
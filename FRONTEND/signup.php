<?php
    include_once("funciones.php");
    if($_POST){
        formularioRegistro();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="./css/inicio.css">
</head>
<body>
    <div>
        <h1>INICIO DE SESIÓN</h1>
        <form enctype="multipart/form-data" action="" method="POST" id="registrofrom">
            <table>
                <tr>
                    <td class="imagen" colspan="2"> <img src="./img/TECHrecortada.png" alt="Descripción de la imagen"></td>
                </tr>
                <tr>
                    <td> <label for="nombre">Nombre:</label> </td> <td> <input type="text" name="nombre" id="nombre" required> </td>
                </tr>
                <tr>
                    <td> <label for="apellidos">Apellidos:</label> </td> <td> <input type="text" name="apellidos" id="apellidos" required> </td>
                </tr>
                <tr>
                    <td> <label for="edad">Edad:</label> </td> <td> <input type="text" name="edad" id="edad" required> </td>
                </tr>
                <tr>
                    <td> <label for="dni">DNI:</label> </td> <td> <input type="text" name="dni" id="dni" required> </td>
                </tr>
                <tr>
                    <td> <label for="contraseña">Contraseña:</label> </td> <td> <input type="password" name="contraseña" id="contraseña" required> </td>
                </tr>
                <tr>
                    <td> <label for="imagen">Foto de perfil:</label> </td> <td> <input type="file" name="imagen" id="imagen" accept="img/*"> </td>
                </tr>
                <tr>
                    <td id="registrar" style="text-align:center" colspan="2"> 
                        <input type="submit" name="Sign Up" value="Sign Up" id="registrar">
                    </td>
                </tr>
                <tr>
                    <td style="text-align:center" colspan="2">
                        <a href="login.php">Inicio de sesión</a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
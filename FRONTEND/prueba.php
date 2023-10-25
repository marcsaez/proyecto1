<?php 
    // CREADO MOMENTARIAMENTE PARA HACER PRUEBAS CON EL HEADER
    include_once('funciones.php');
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado cursos</title>
    <link rel="stylesheet" type="text/css" href="./css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
</head>
<body>
        <form enctype="multipart/form-data" action="prueba.php" method="POST" id="registrofrom">
            <table>
                <tr>
                    <td> <label for="imagen">Foto de perfil:</label> </td> <td> <input type="file" name="imagen" id="imagen" accept="img/*"> </td>
                </tr>
                <tr>
                    <td style="text-align:center" colspan="2"> 
                        <input type="submit" name="Sign Up" value="Sign Up" id="registrar">
                    </td>
                </tr>
            </table>
        </form>
<?php
        encabezadoUsuario($datos);
        
        moverImagenR("perfiles","47993200C");
?>
</body>
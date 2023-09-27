<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
</head>
<body>
    <?php
    include_once("funciones.php");
        //Si existeix l'array POST introdueix les dades a una posicio de SESSION i redirigeix a menu.php
        if($_POST) {
            $conexion = abrirBBDD();
            if($conexion == false) {
                mysqli_connect_error();
            }
            else {
                $sql = "SELECT contraseña FROM alumnos WHERE dni='".$_POST['dni']."';";
                $consulta = mysqli_query($conexion, $sql);
                $contraseñaBBDD = contenido($conexion, $sql);
                $contraseña = $_POST['contraseña'];
                $verificacion = verificarContraseña($contraseña, $contraseñaBBDD);
                if($verificacion == true) {
                    $_SESSION['dni'] = $_POST['dni'];
                    $_SESSION['contraseña'] = $_POST['contraseña'];
                    ?>
                    <meta http-equiv="REFRESH" content="0;url=listarcursos.php">
                    <?php
                }
                else {
                    ?>  
                        <script>
                            alert("El usuario no está registrado o alguno de los datos no es correcto");
                        </script>              
                        <meta http-equiv="REFRESH" content="0;url=login.php">
                    <?php
                }
    
            }
        }
        //Si no existeix l'array POST entra al un formulari
        else {
            formularioInicio();
        }
        ?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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
                $imagen_path = moverImagen();
                $contraseña = encriptacio();
                $sql = "INSERT INTO alumnos (dni, nombre, apellidos, edad, contraseña, foto) VALUES('".$_POST['dni']."', '".$_POST['nombre']."', '".$_POST['apellidos']."', '".$_POST['edad']."', '".$contraseña."', '".$imagen_path."')";
                $sql2 = "SELECT dni FROM alumnos WHERE dni='".$_POST['dni']."';";
                $consulta = mysqli_query($conexion, $sql2);
                $numlinias = mysqli_num_rows($consulta);
                if($numlinias > 0) {
                    ?>
                        <script>
                            alert("El usuario ya está registrado");
                        </script>                   
                    <?php
                }
                else {
                    $consulta = mysqli_query($conexion, $sql);
                }
    ?>
        <meta http-equiv="REFRESH" content="10;url=signup.php">
    <?php
            }
        }
        //Si no existeix l'array POST entra al un formulari
        else {
            formularioRegistro();
        }
        ?>
</body>
</html>
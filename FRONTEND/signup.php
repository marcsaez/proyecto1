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
                $imagen_path = 'img/' . $_POST['dni'];
                move_uploaded_file($_FILES['imagen']['tmp_name'], $imagen_path);
                $sql = "INSERT INTO alumnos (dni, nombre, apellidos, edad, contraseña, foto) VALUES('".$_POST['dni']."', '".$_POST['nombre']."', '".$_POST['apellidos']."', '".$_POST['edad']."', '".$_POST['contraseña']."', '".$imagen_path."')";
                $sql2 = "SELECT dni FROM alumnos WHERE dni='".$_POST['dni']."' AND contraseña='".$_POST['contraseña']."';";
                $consulta = mysqli_query($conexion, $sql2);
                $numlinias = mysqli_num_rows($consulta);
                if($numlinias > 0) {
                    echo "<h3>Ja estàs registrat</h3>";
                }
                else {
                    $consulta = mysqli_query($conexion, $sql);
                    echo "<h3>Registre amb éxit</h3>";
                }
    ?>
        <meta http-equiv="REFRESH" content="2;url=signup.php">
    <?php
            }
        }
        //Si no existeix l'array POST entra al un formulari
        else {
    ?>
            <form enctype="multipart/form-data" action="signup.php" method="POST">
                <table>
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
                        <td style="text-align:center" colspan="2"> 
                            <input type="submit" name="Aceptar" value="Aceptar">
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center" colspan="2">
                            <a href="login.php">Inicio de sesión</a>
                        </td>
                    </tr>
                </table>
            </form>
        <?php
        }
        ?>
</body>
</html>
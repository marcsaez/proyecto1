<?php 

function abrirBBDD(){
    try {
        $connection = mysqli_connect("localhost", "root", "", "tech_academy");
        return $connection;
    } 
    catch (Exception $e) {
        echo "<p>ERROR</p>";
        header("Location: formulariocursos.php");
        return false;
    }
    }

function insertarCurso($nombre, $descripcion, $horas, $inicio, $final, $activo, $fk_profesor,$connection){
    $sql = "SELECT * FROM cursos WHERE nombre = '$nombre'";
        $result = $connection->query($sql);
        if ($result->num_rows > 0) {
            // Si el usuario ya existe en la base de datos, mostramos un mensaje de error
            echo "<a href='menuadmin.php'>Volver al menu</a>";
        ?>
        <script>
            alert("EL CURSO YA ESTA CREADO!");
        </script>
        
        <?php

        } else {
            // Si el usuario no existe en la base de datos, lo insertamos
            $sql = "INSERT INTO cursos (nombre, descripcion, horas, inicio, final, activo, fk_profesor) VALUES ('$nombre', '$descripcion','$horas', '$inicio', '$final','$activo', '$fk_profesor')";
    
        if ($connection->query($sql) === TRUE) {
            // Si se ha insertado el usuario correctamente, mostramos un mensaje de éxito
            header("Location: menuadmin.php");
        } else {
            // Si ha habido un error al insertar el usuario, mostramos un mensaje de error
            echo '<p>Error al registrar el usuario: ' . $connection->error . '</p>';
        }
        }
}

function insertarProfesor($dni, $nombre, $apellidos, $titulo_academico, $foto, $activo, $connection){
    $sql = "SELECT * FROM profesor WHERE dni = '$dni'";
    $result = $connection->query($sql);
    
    if ($result->num_rows > 0) {
        // Si el usuario ya existe en la base de datos, mostramos un mensaje de error
    ?>
    <script>
        alert("EL PROFESOR YA ESTA CREADO!")
    </script>
    <?php

    } else {
        // Si el usuario no existe en la base de datos, lo insertamos
        $sql = "INSERT INTO profesor (dni, nombre, apellidos, titulo_academico, foto, activo) VALUES ('$dni', '$nombre','$apellidos', '$titulo_academico', '$foto','$activo')";

        if ($connection->query($sql) === TRUE) {
            // Si se ha insertado el usuario correctamente, mostramos un mensaje de éxito
            header("Location: menuadmin.php");
        } else {
            // Si ha habido un error al insertar el usuario, mostramos un mensaje de error
            echo '<p>Error al registrar el usuario: ' . $connection->error . '</p>';
        }
    }
}

function crearcurso(){
    if($_POST){
        //COGEMOS LOS DATOS DEL FORMULARIO
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $horas = $_POST['horas'];
        $inicio = $_POST['inicio'];
        $final = $_POST['final'];
        $activo = true;
        $fk_profesor = $_POST['fk_profesor'];

        $connection = abrirBBDD();
        
        if ($connection){
            insertarCurso($nombre,$descripcion,$horas,$inicio,$final,$activo,$fk_profesor,$connection);
        } else{
            header("Location: formulariocursos.php");
        }
    } else{
        header("Location: formulariocursos.php");
    }
}

function eliminarCurso(){
    if($_POST){
        if (isset($_POST['cursos']) && is_array($_POST['cursos'])) {
            $cursosSeleccionados = $_POST['cursos'];
            print_r($cursosSeleccionados);
            $conexion = abrirBBDD();
            if($conexion == false) {
                mysqli_connect_error();
            }
            else {
                foreach($cursosSeleccionados as $curso) {
                    $sql = "SELECT activo FROM cursos WHERE codigo = ".$curso.";";
                    $consulta = mysqli_query($conexion, $sql);
                    if ($consulta) {
                        $fila = mysqli_fetch_assoc($consulta);
                        if ($fila) {
                            $activo = $fila['activo'];
                            if ($activo == 1) {
                                $sql = "UPDATE cursos SET activo = 0 WHERE codigo = " . $curso;
                                $consulta = mysqli_query($conexion, $sql);
                            } else {
                                $sql = "UPDATE cursos SET activo = 1 WHERE codigo = " . $curso;
                                $consulta = mysqli_query($conexion, $sql);
                            }
                        }
                    }
                }
            }
            ?>
            <meta http-equiv="REFRESH" content="0;url=eliminarcurso.php">
            <?php
        }
        else {
            ?>
            <meta http-equiv="REFRESH" content="0;url=eliminarcurso.php">
            <?php
        }
    }
}

function eliminarprofes(){
    if($_POST){
        
        if (isset($_POST['profesores']) && is_array($_POST['profesores'])) {
            $profesoresSeleccionados = $_POST['profesores'];
    
            // Realizar la conexión a la base de datos 
            $connection = abrirBBDD();
    
            if ($connection) {
                foreach ($profesoresSeleccionados as $dni){
                    $busqueda = "SELECT activo FROM profesor WHERE dni = ?"; 
                    $stmt_busqueda = $connection->prepare($busqueda);
                        if ($stmt_busqueda) {
                            $stmt_busqueda->bind_param("s", $dni);
                            $stmt_busqueda->execute();
                            $stmt_busqueda->bind_result($activo);
                    
                            if ($stmt_busqueda->fetch()) {
                                // Si el resultado indica que está activo, desactívalo, y viceversa
                                $stmt_busqueda->close();
                                if ($activo == 1) {
                                    $sql = "UPDATE profesor SET activo = 0 WHERE dni = ?";
                                } else {
                                    $sql = "UPDATE profesor SET activo = 1 WHERE dni = ?";
                                }
                    
                                $stmt = $connection->prepare($sql);
                                if ($stmt) {
                                    $stmt->bind_param("s", $dni);
                                    $stmt->execute();
                                    $stmt->close();
                                }
                            }
                        }
                    }
                    
                    header("Location: profesdesactivar.php");
                }
        } else{
            header("Location: profesdesactivar.php");

        }
    } else{
        echo "<h1>No se relleno el formulario correctamente</h1>";
        sleep(1);
        header("Location: menuadmin.php");
}
}
function modificarCurso(){
    $conexion = abrirBBDD();

    // Obtener los datos enviados desde el formulario
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    // Consulta SQL para actualizar el curso
    $consulta = "UPDATE cursos SET nombre='$nombre', descripcion='$descripcion' WHERE codigo=$codigo";

    if ($conexion->query($consulta) === TRUE) {
        echo "Curso actualizado con éxito.";
        echo "<a href='menuadmin.php'><p>Volver al menu</p></a>";
    } else {
        echo "Error al actualizar el curso: " . $conexion->error;
    }

}

function crearProfe(){
    if($_POST){
        //COGEMOS LOS DATOS DEL FORMULARIO
        $dni = $_POST['dni'];
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $titulo_academico = $_POST['titulo_academico'];
        $foto = $_POST['foto'];
        $activo = true;

        $connection = abrirBBDD();

        if ($connection){
            insertarProfesor($dni, $nombre, $apellidos, $titulo_academico, $foto, $activo, $connection);
        } else{
            header("Location: formulariocursos.php");
        }

    } else{
        echo "<h1>No se relleno el formulario correctamente</h1>";
        sleep(1);
        header("Location: formulariocursos.php");
    }
}

function modificarProfe(){
        $conexion = abrirBBDD();

    // Obtener los datos enviados desde el formulario
    $dni = $_POST['dni'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $titulo_academico = $_POST['titulo_academico'];

    // Consulta SQL para actualizar el profesor
    $consulta = "UPDATE profesor SET nombre = '$nombre', apellidos = '$apellidos', titulo_academico = '$titulo_academico' WHERE dni = '$dni'";

    if ($conexion->query($consulta) === TRUE) {
        echo "Curso actualizado con éxito.";
        echo "<a href='menuadmin.php'>Volver al menu</a>";
    } else {
        echo "Error al actualizar el curso: " . $conexion->error;
    }
}

function formularioRegistro() {
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
                    <td id="registrar" style="text-align:center" colspan="2"> 
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

function moverImagen() {
    $imagen_ext = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
    $imagen_path = 'img/perfiles/' . $_POST['dni'] .'.'. $imagen_ext;
    move_uploaded_file($_FILES['imagen']['tmp_name'], $imagen_path);

    return $imagen_path;
}

function encriptacio() {
    $contraseña = $_POST['contraseña'];
    $contraseña_encriptada = password_hash($contraseña, PASSWORD_BCRYPT);

    return $contraseña_encriptada;
}
?>
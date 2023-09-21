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
?>
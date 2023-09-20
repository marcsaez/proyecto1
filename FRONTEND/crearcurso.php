<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creacion</title>
</head>
<body>
    <?php
    if($_POST){
       //HAY QUE HACER ESTO FUNCION
       try {
        $connection = mysqli_connect("localhost", "root", "", "tech_academy");
    } catch (Exception $e) {
        echo "<p>ERROR</p>";
        header("Location: formulariocursos.php");
        
    }
    
    //COGEMOS LOS DATOS DEL FORMULARIO
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $horas = $_POST['horas'];
    $inicio = $_POST['inicio'];
    $final = $_POST['final'];
    $activo = true;
    $fk_profesor = $_POST['fk_profesor'];
    
        
        $sql = "SELECT * FROM cursos WHERE nombre = '$nombre'";
        $result = $connection->query($sql);
        if ($result->num_rows > 0) {
            // Si el usuario ya existe en la base de datos, mostramos un mensaje de error
        ?>
        <script>
            alert("EL CURSO YA ESTA CREADO!")
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

    } else{
        echo "<h1>No se relleno el formulario correctamente</h1>";
        sleep(1);
        header("Location: formulariocursos.php");
    }
    ?>
    

</body>
</html>
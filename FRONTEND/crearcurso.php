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
        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $dbname = 'learningacademy';
    
        $conn = new mysqli($servername, $username, $password, $dbname);
    
    
        if ($conn ->connect_error) {
            echo "<p>Error de conexion</p>";
            $conn -> close();
        }
    
        //COGEMOS LOS DATOS DEL FORMULARIO
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $horas = $_POST['horas'];
        $inicio = $_POST['inicio'];
        $final = $_POST['final'];
        $fk_profesor = $_POST['fk_profesor'];
    
        $sql = "INSERT INTO CURSOS (nombre, descripcion, horas, inicio, final, fk_profesor) VALUES ('$nombre', '$descripcion','$horas', '$inicio', '$final', '$fk_profesor')";
    } else{
        echo "<h1>No se relleno el formulario correctamente</h1>";
        sleep(1);
        header("Location: formulariocursos.php");
    }
    ?>
    
</form>

</body>
</html>
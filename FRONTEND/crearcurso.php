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
            echo "<h1>No se relleno el formulario correctamente</h1>";
            sleep(1);
            header("Location: formulariocursos.php");
        }
    ?>
    

</body>
</html>
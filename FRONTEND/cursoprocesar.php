<?php
include("funciones.php");
$conexion = abrirBBDD();
if($conexion == false) {
    mysqli_connect_error();
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $codigo= $_POST['codigo'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $horas = $_POST['horas'];
        $inicio = $_POST['inicio'];
        $final = $_POST['final'];
        
        $sqlUpdate = "UPDATE cursos SET nombre='$nombre', descripcion='$descripcion', horas='$horas', inicio='$inicio', final='$final' WHERE codigo='$codigo'";

        if ($conexion->query($sqlUpdate) === TRUE) {
            // Redirigir a la misma página después de la actualización
             ?>               
                 <meta http-equiv="REFRESH" content="0;url=admincursos.php">
             <?php
        } else {
            echo "Error al actualizar los datos: " . $conexion->error;
        }

    }
}


?>
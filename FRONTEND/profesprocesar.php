<?php
include("funciones.php");
$conexion = abrirBBDD();
if($conexion == false) {
    mysqli_connect_error();
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $dni= $_POST['dni'];
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $titulo_academico = $_POST['titulo_academico'];
        
        $sqlUpdate = "UPDATE profesor SET nombre='$nombre', apellidos='$apellidos', titulo_academico='$titulo_academico' WHERE dni='$dni'";

        if ($conexion->query($sqlUpdate) === TRUE) {
            // Redirigir a la misma página después de la actualización
             ?>               
                 <meta http-equiv="REFRESH" content="0;url=adminprofes.php">
             <?php
        } else {
            echo "Error al actualizar los datos: " . $conexion->error;
        }

    }
}


?>
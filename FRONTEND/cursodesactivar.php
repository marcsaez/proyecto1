<?php
include("funciones.php");
$conexion = abrirBBDD();
if($conexion == false) {
    mysqli_connect_error();
} else {
    if ($_POST){
        $codigo= $_POST['codigo'];
        $sql = "SELECT activo FROM cursos WHERE codigo='$codigo'";
        $result = $conexion->query($sql);
        $linia = $result->fetch_assoc();
        $activo = $linia['activo'];
        if ($activo==1){
            $sqlUpdate = "UPDATE cursos SET activo=0 WHERE codigo='$codigo'";
        } else {
            $sqlUpdate = "UPDATE cursos SET activo=1 WHERE codigo='$codigo'";
        }

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
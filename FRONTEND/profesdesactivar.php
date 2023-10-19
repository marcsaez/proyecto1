<?php
include("funciones.php");
$conexion = abrirBBDD();
if($conexion == false) {
    mysqli_connect_error();
} else {
    if ($_POST){
        $dni= $_POST['dni'];
        $sql = "SELECT activo FROM profesor WHERE dni='$dni'";
        $result = $conexion->query($sql);
        $linia = $result->fetch_assoc();
        $activo = $linia['activo'];
        if ($activo==1){
            $sqlUpdate = "UPDATE profesor SET activo=0 WHERE dni='$dni'";
        } else {
            $sqlUpdate = "UPDATE profesor SET activo=1 WHERE dni='$dni'";
        }

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
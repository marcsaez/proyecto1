<?php
include_once('funciones.php');
$conexion = abrirBBDD();

// Obtener los datos enviados desde el formulario
$dni = $_POST['dni'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$titulo_academico = $_POST['titulo_academico'];

// Consulta SQL para actualizar el profesor
$consulta = "UPDATE profesor SET nombre = '$nombre', apellidos = '$apellidos', titulo_academico = '$titulo_academico' WHERE dni=$dni";

if ($conexion->query($consulta) === TRUE) {
    echo "Curso actualizado con éxito.";
} else {
    echo "Error al actualizar el curso: " . $conexion->error;
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
<meta http-equiv="REFRESH" content="0;url=menuadmin.php">
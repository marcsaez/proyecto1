<?php
include_once('funciones.php');
$conexion = abrirBBDD();

// Obtener los datos enviados desde el formulario
$codigo = $_POST['codigo'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];

// Consulta SQL para actualizar el curso
$consulta = "UPDATE cursos SET nombre='$nombre', descripcion='$descripcion' WHERE codigo=$codigo";

if ($conexion->query($consulta) === TRUE) {
    echo "Curso actualizado con éxito.";
} else {
    echo "Error al actualizar el curso: " . $conexion->error;
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>

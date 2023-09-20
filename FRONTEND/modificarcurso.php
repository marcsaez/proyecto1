<?php
// Conectarse a la base de datos (debes configurar tus credenciales)
$conexion = new mysqli("localhost", "usuario", "contraseña", "basededatos");

// Comprobar la conexión
if ($conexion->connect_error) {
    die("La conexión a la base de datos falló: " . $conexion->connect_error);
}

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

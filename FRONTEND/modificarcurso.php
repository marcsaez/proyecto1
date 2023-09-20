<?php
// Conectarse a la base de datos (debes configurar tus credenciales)
$conexion = new mysqli("localhost", "usuario", "contraseña", "basededatos");

// Comprobar la conexión
if ($conexion->connect_error) {
    die("La conexión a la base de datos falló: " . $conexion->connect_error);
}

// Obtener los datos enviados desde el formulario
$curso_id = $_POST['curso_id'];
$nuevo_nombre = $_POST['nuevo_nombre'];
$nueva_descripcion = $_POST['nueva_descripcion'];

// Consulta SQL para actualizar el curso
$consulta = "UPDATE cursos SET nombre='$nuevo_nombre', descripcion='$nueva_descripcion' WHERE id=$curso_id";

if ($conexion->query($consulta) === TRUE) {
    echo "Curso actualizado con éxito.";
} else {
    echo "Error al actualizar el curso: " . $conexion->error;
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>

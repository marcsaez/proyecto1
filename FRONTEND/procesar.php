<?php
include_once('funciones.php');
// Obtén los datos JSON enviados desde JavaScript
$jsonData = file_get_contents("php://input");
$data = json_decode($jsonData, true);

if ($data) {
    // Conexion a la base de datos
    $conexion = abrirBBDD();
    if($conexion == false) {
        mysqli_connect_error();
    }
    else {
        $repetidos = [];
        $noValidos = [];
        foreach($data as $alumno) {
            $contraseña = encriptacio($alumno['DNI']);
            $imagen_path = "img/perfiles/".$alumno['foto'];
            $dni = $alumno['DNI'];
            $nombre = $alumno['nombre'];
            $apellidos = $alumno['apellidos'];
            $edad = $alumno['edad'];
            $concurso = true;
            $sql2 = "SELECT dni FROM alumnos WHERE dni='$dni'";
            $consulta = mysqli_query($conexion, $sql2);
            $numlinias = mysqli_num_rows($consulta);
            if($numlinias > 0) {
                $repetidos[] = $dni;
            }
            else {
                if(comprobacionDNI($dni) == true && comprobacionEdad($edad) == true) {
                    $sql = "INSERT INTO alumnos (dni, nombre, apellidos, edad, contraseña, foto, concurso) VALUES ('$dni', '$nombre', '$apellidos', '$edad', '$contraseña', '$imagen_path', '$concurso')";
                    $consulta = mysqli_query($conexion, $sql);

                    foreach($alumno['cursos'] as $curso) {
                        $sql2 = "INSERT INTO matriculados (codigo, dni) VALUES ('$curso', '$dni')";
                        $consulta = mysqli_query($conexion, $sql2); 
                    }
                    
                }
                else {
                    $noValidos[] = $dni;
                }
            }   
        }
    }
    

    // Devuelve una respuesta (opcional)
    $response = array('message' => 'Datos recibidos y procesados en PHP');
    echo json_encode($response);
} else {
    echo 'No se recibieron datos válidos';
}
?>

<?php 
include_once("funciones.php");

    if($_POST){
        if (isset($_POST['cursos']) && is_array($_POST['cursos'])) {
            $cursosSeleccionados = $_POST['cursos'];
            print_r($cursosSeleccionados);
            $conexion = abrirBBDD();
            if($conexion == false) {
                mysqli_connect_error();
            }
            else {
                foreach($cursosSeleccionados as $curso) {
                    $sql = "SELECT activo FROM cursos WHERE codigo = ".$curso.";";
                    $consulta = mysqli_query($conexion, $sql);
                    if ($consulta) {
                        $fila = mysqli_fetch_assoc($consulta);
                        if ($fila) {
                            $activo = $fila['activo'];
                            if ($activo == 1) {
                                $sql = "UPDATE cursos SET activo = 0 WHERE codigo = " . $curso;
                                $consulta = mysqli_query($conexion, $sql);
                            } else {
                                $sql = "UPDATE cursos SET activo = 1 WHERE codigo = " . $curso;
                                $consulta = mysqli_query($conexion, $sql);
                            }
                        }
                    }
                }
            }
            ?>
            <meta http-equiv="REFRESH" content="0;url=eliminarcurso.php">
            <?php
        }
        else {
            ?>
            <meta http-equiv="REFRESH" content="0;url=eliminarcurso.php">
            <?php
        }
    }

?>
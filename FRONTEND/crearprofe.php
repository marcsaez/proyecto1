<?php
    include_once('funciones.php');
    if($_POST){
        //COGEMOS LOS DATOS DEL FORMULARIO
        $dni = $_POST['dni'];
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $titulo_academico = $_POST['titulo_academico'];
        $foto = $_POST['foto'];
        $activo = true;

        $connection = abrirBBDD();

        if ($connection){
            insertarProfesor($dni, $nombre, $apellidos, $titulo_academico, $foto, $activo, $connection);
        } else{
            header("Location: formulariocursos.php");
        }

    } else{
        echo "<h1>No se relleno el formulario correctamente</h1>";
        sleep(1);
        header("Location: formulariocursos.php");
    }
    
?>
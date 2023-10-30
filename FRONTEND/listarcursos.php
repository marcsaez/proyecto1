<?php 
    session_start();
    include_once("funciones.php");
    
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado cursos</title>
    <link rel="stylesheet" type="text/css" href="./css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
</head>
<body>
    <?php 
        if($_SESSION['tipo'] == "alumno"){
            $dni = $_SESSION['dni'];
            
            $datos = sessionAbrir($dni);

            encabezadoUsuario($datos);
            $datosConcur = datosconcurso($dni);         
            Concurso($dni);   
            listarCursos($dni);
                
            // footer();
        } else{
            echo "<script> 
                    alert('Acceso denegado, accede como alumno')
                </script>";
                echo "<meta http-equiv='REFRESH' content='0;url=login.php'>";
        }
    ?>
</body>

</html>
<?php 
    session_start();
    $dni = $_SESSION['dni'];
    include_once('funciones.php');
    $datos = sessionAbrir($dni);
?>
<!DOCTYPE html>
<html lang="en">
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
    <header>
        <div class="header">
        <a href="menuadmin.php"><img src="./img/TECHrecortada.png" alt="TechAcademy" id="logo"></a>
            <h2 id="titulo">TECH ACADEMY</h2>
        </div>
        <?php 
            datosUserVisibles($datos);
        ?>
    </header>
    
    <?php
            
            $conexion = abrirBBDD();
            if($conexion == false) {
                mysqli_connect_error();
            }
            else {
                $sql = "SELECT codigo FROM matriculados WHERE dni='$dni'";
                $result = $conexion->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $curso=$row['codigo'];
                        $cursoSql = "SELECT * FROM cursos WHERE codigo=$curso";
                        $cursoResult = $conexion->query($cursoSql); 
                        if ($cursoResult->num_rows > 0) {
                                echo '<div class="curso-wrapper">';
                                while ($cursoRow = $cursoResult->fetch_assoc()) {
                                    echo '<div class="curso">';
                                    echo '<h2>' . $cursoRow['nombre'] . '</h2>';
                                    echo '<p>' . $cursoRow['descripcion'] . '</p>';
                                    echo '<p>' . $cursoRow['horas'] . '</p>';
                                    echo '<form action="paginacurso.php" method="POST">';
                                    echo '<input type="hidden" name="codigo" value="' . $cursoRow['codigo'] . '">';
                                    echo '<button type="submit" name="ver_curso">Ver Curso</button>';
                                    echo '</form>';
                                    echo '</div>';
                                }
                                echo '</div>';
                            }
                    }
                } else {
                    echo "No estas matriculado en ningun curso.";
                }
            }   
    ?>


    <footer>
        <div class="contacto">
            <p>consultas@techacademy.com</p>
            <p>C/de la Batlloria, Badalona</p>
        </div>
        <div class="copyright">
            <p>© 2023 TECH ACADEMY</p>
        </div>
    </footer>
</body>
</html>
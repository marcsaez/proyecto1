<?php 
    include("funciones.php");
    if ($_POST){
        eliminarCurso();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar</title>
    <link rel="stylesheet" type="text/css" href="./css/styles.css">
</head>
<body>
    <header>
        <div class="header">
        <a href="menuadmin.php"><img src="./img/TECHrecortada.png" alt="TechAcademy" id="logo"></a>
            <h2 id="titulo">TECH ACADEMY</h2>
        </div>
        <div class="usuario">
            <!-- FOTO DE PRUEBA PARA MEDIDAS (HAY QUE SACARLA DE LA BBDD) -->
            <p id="username" >Pablo de Gregorio</p>
            <img src="./img/98-1.jpg" alt="fotoperfil" id="fotoperfil">
        </div>
    </header>

    <h2>Desactivar curso:</h2>
    <form method="POST" action="">
        <?php
            include_once("funciones.php");
            $conexion = abrirBBDD();
            if($conexion == false) {
                mysqli_connect_error();
            }
            else {
                $sql = "SELECT * FROM cursos WHERE activo = 1";
                $consulta = mysqli_query($conexion, $sql);
                $numlinias = mysqli_num_rows($consulta);
                for($i=0; $i<$numlinias; $i++) {
                    $linia = mysqli_fetch_array($consulta);
                    echo "<label for='curso_".$linia['codigo']."'><input type='checkbox' name='cursos[]' id='curso_".$linia['codigo']."' value='".$linia['codigo']."'> ".$linia['nombre']."(".$linia['codigo'].")</label><br>";
                }
            }
        ?>
        <input type="submit" value="Desactivar">
    </form>

    <h2>Activar curso:</h2>
    <form method="POST" action="cursoseliminar.php">
        <?php
            include_once("funciones.php");
            $conexion = abrirBBDD();
            if($conexion == false) {
                mysqli_connect_error();
            }
            else {
                $sql = "SELECT * FROM cursos WHERE activo = 0";
                $consulta = mysqli_query($conexion, $sql);
                $numlinias = mysqli_num_rows($consulta);
                for($i=0; $i<$numlinias; $i++) {
                    $linia = mysqli_fetch_array($consulta);
                    echo "<label for='curso_".$linia['codigo']."'><input type='checkbox' name='cursos[]' id='curso_".$linia['codigo']."' value='".$linia['codigo']."'> ".$linia['nombre']."(".$linia['codigo'].")</label><br>";
                }
            }
        ?>
        <input type="submit" value="Activar">
    </form>

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


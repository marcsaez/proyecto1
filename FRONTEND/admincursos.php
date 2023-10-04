<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin cursos</title>
    <link rel="stylesheet" type="text/css" href="./css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="header">
            <img src="./img/TECHrecortada.png" alt="TechAcademy" id="logo">
            <h2 id="titulo">TECH ACADEMY</h2>
        </div>
        <div class="usuario">
            <!-- FOTO DE PRUEBA PARA MEDIDAS (HAY QUE SACARLA DE LA BBDD) -->
            <p id="username" >Pablo de Gregorio</p>
            <img src="./img/98-1.jpg" alt="fotoperfil" id="fotoperfil">
        </div>
    </header>

    <h1>CURSOS</h1>
    <table class="admin">
        <tr class="blanco">
            <td>Codigo</td>
            <td>Nombre</td>
            <td>Fecha inicio</td>
            <td>Fecha final</td>
            <td>Horas</td>
            <td>Activo</td>
            <td>Editar</td>
            <td>Eliminar</td>
        </tr>
        <?php
            include_once("funciones.php");
            $conexion = abrirBBDD();
            $sql = "SELECT * FROM cursos";
            $consulta = mysqli_query($conexion, $sql);
            if($consulta == false) {
                mysqli_error($conexion);
            }
            else {
                $numlinias = mysqli_num_rows($consulta);
                for($i=0; $i<$numlinias; $i++) {
                    $linia = mysqli_fetch_array($consulta);
                    echo "<tr>";
                    echo "<td>".$linia['codigo']."</td>";
                    echo "<td>".$linia['nombre']."</td>";
                    echo "<td>".$linia['inicio']."</td>";
                    echo "<td>".$linia['final']."</td>"; 
                    echo "<td>".$linia['horas']."</td>";
                    if($linia['activo'] == "1") {
                        echo "<td> <img src='./img/punto_verde.png' alt='Verde'> </td>";
                    }
                    else {
                        echo "<td> <img src='./img/punto_rojo.png' alt='Rojo'> </td>";
                    }
                    echo "<td><a href='formulariomodificarcursos.php'><img src='./img/editar.png' alt='TechAcademy'></a></td>";
                    echo "<td><a href='eliminarcurso.php'><img src='./img/eliminar.png' alt='TechAcademy'></a></td>";
                    echo "</tr>";
                }
            }
        ?>
    </table>
</body>
<?php
    include_once("funciones.php");
    adminLogin();
?>
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
        <?php
            echo '<p id="username" >'. $_SESSION['usuario'] .'</p>'
        ?>
            <img src="./img/98-1.jpg" alt="fotoperfil" id="fotoperfil">
        </div>
    </header>
        <a href="./formulariocursos.php"><h2>Crear cursos</h2></a>
        <?php
            function adminProfes(){
                echo '<h1>PROFESORES</h1>
                    <table class="admin">
                        <tr class="blanco">
                            <td>DNI</td>
                            <td>Nombre</td>
                            <td>Apellidos</td>
                            <td>Titulo Academico</td>
                            <td>Foto</td>
                            <td>Activo</td>
                            <td>Editar</td>
                            <td>Eliminar</td>
                        </tr>';
            
                $conexion = abrirBBDD();
                $sql = "SELECT * FROM profesor";
                $result = $conexion->query($sql);
                if ($result->num_rows > 0) {
                    while ($linia = $result->fetch_assoc()){
                        echo '<tr>
                                <td>' . $linia['dni'] . '</td>
                                <td>' . $linia['nombre'] . '</td>
                                <td>' . $linia['apellidos'] . '</td>
                                <td>' . $linia['titulo_academico'] . '</td>
                                <td>' . $linia['foto'] . '</td>';
            
                            if ($linia['activo'] == "1") {
                                echo '<td> <img src="./img/punto_verde.png" alt="Verde"> </td>';
                            } else {
                                echo '<td> <img src="./img/punto_rojo.png" alt="Rojo"> </td>';
                            }
            
                            echo '<td>
                                <form action="profesmodificar.php" method="POST">
                                    <input type="hidden" name="dni" value="' . $linia['dni'] . '">
                                    <button type="submit" name="mod_profe"><img src="./img/editar.png" alt="TechAcademy"></button>
                                </form>
                            </td>
                            <td>
                                <form action="cursodesactivar.php" method="POST">
                                <input type="hidden" name="dni" value="' . $linia['dni'] . '">
                                <button type="submit" name="des_profes"><img src="./img/eliminar.png" alt="TechAcademy"></button>
                                </form>
                            </td>
                            </tr>';
            
                    }
                }
                else {
                    echo "NO HAY CURSOS";      
                }
                //echo '</table>';
            }
            adminProfes();
        ?>
    </table>
</body>
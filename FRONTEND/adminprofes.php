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
        <a href="menuadmin.php"><img src="./img/TECHrecortada.png" alt="TechAcademy" id="logo"></a>
            <h2 id="titulo">TECH ACADEMY</h2>
        </div>
        <div class="usuario">
        <?php
            echo '<p id="username" >'. $_SESSION['usuario'] .'</p>'
        ?>
            <img src="./img/98-1.jpg" alt="fotoperfil" id="fotoperfil">
        </div>
    </header>
        <?php
            function adminProfes(){
                echo '<table class="admin">
                        <tr class="titulo">
                            <td colspan="8"><h1>PROFESORES</h1></td>
                        </tr>
                        <tr class="titulo">
                            <td colspan="7" class="buscador">
                                <form enctype="multipart/form-data" action="" method="POST">
                                    <p>Busqueda por DNI/Nombre: <input type="search" name="busqueda" placeholder="DNI o Nombre"><a href = "adminprofes.php"><img src="./img/refresh.png" alt="RefrescarBusqueda" id ="Refresh"></a></p>
                                </form>
                            </td> 
                            <td class="añadir" colspan="1"><a href="./formularioprofes.php"><span title="Añadir profesor"><img src="./img/añadir.png" alt="añadir" id="añadir"></span></a></td>
                        </tr>
                        <tr class="blanco">
                            <td>DNI</td>
                            <td>Nombre</td>
                            <td>Apellidos</td>
                            <td>Titulo Academico</td>
                            <td>Foto</td>
                            <td>Activo</td>
                            <td>Editar</td>
                            <td>Desactivar</td>
                        </tr>';
            
                $conexion = abrirBBDD();
                if(isset($_POST['busqueda']) && strlen($_POST['busqueda']) > 0) {
                    $busqueda = $_POST['busqueda'];
                    $sql = "SELECT * FROM profesor WHERE nombre LIKE '%$busqueda%' OR dni LIKE '%$busqueda%'";
                }
                else {
                    $sql = "SELECT * FROM profesor"; 
                }
                $result = $conexion->query($sql);
                if ($result->num_rows > 0) {
                    while ($linia = $result->fetch_assoc()){
                        $info = pathinfo($linia['foto']);
                        if (isset($info['extension']) && $info['extension'] !== '') {
                            $foto = "<img src='./".$linia['foto']."' alt='fotoperfil' id='fotoperfil'>";
                            } else {
                            $foto = "<img src='./img/perfiles/default.png' alt='fotoperfil' id='fotoperfil'>";
                            }
                        echo '<tr>
                                <td>' . $linia['dni'] . '</td>
                                <td>' . $linia['nombre'] . '</td>
                                <td>' . $linia['apellidos'] . '</td>
                                <td>' . $linia['titulo_academico'] . '</td>
                                <td>' . $foto . '</td>';
            
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
                                <form action="profesdesactivar.php" method="POST">
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
                echo '</table>';
            }
            adminProfes();
            footer();
        ?>
    <!-- </table> -->
</body>
</html>
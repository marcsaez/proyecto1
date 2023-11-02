<?php 

// ############
// ENCABEZADO #
// ############

function datosUserVisibles($datos){
    echo "<a href='perfil.php'>";
    echo "<div class='usuario'>";
    echo "<p id='username' >";
    echo $datos['nombre']. ' ' .$datos['apellidos'] ;
    echo "</p>";
    $foto = $datos['foto'];
    $info = pathinfo($foto);
    if (isset($info['extension']) && $info['extension'] !== '') {
    echo "<img src='./".$datos['foto']."' alt='fotoperfil' id='fotoperfil'>";
    } else {
        echo "<img src='./img/perfiles/default.png' alt='fotoperfil' id='fotoperfil'>";
    }

    echo "</div>";
    echo "</a>";
}

function navegadorUsuario(){
    echo '<nav>
    <ul>
        <li><a href="listarcursos.php">Todos los cursos</a></li>
        <li><a href="miscursos.php">Mis cursos</a></li>
    </ul>
  </nav>';

}
function EncabaezadoAlternativo(){
    echo "<header>
    <div class='header'>
    <a href='bienvenida.php'><img src='./img/TECHrecortada.png' alt='TechAcademy' id='logo'></a>
        <h2 id='titulo'>TECH ACADEMY</h2>
    </div>";
    navegadorBienvenida2();
    echo "</header>";
}
function encabezadoBienvenida($datos){
    echo "<header>
    <div class='header'>
    <a href='bienvenida.php'><img src='./img/TECHrecortada.png' alt='TechAcademy' id='logo'></a>
        <h2 id='titulo'>TECH ACADEMY</h2>
    </div>";
    navegadorBienvenida();
    datosUserVisibles($datos);
    echo "</header>";
}
function navegadorBienvenida2(){
    echo '<nav>
    <ul>
        <li><a href="sobrenosotros.php">Sobre nosotros</a></li>
        <li><a href="#">Servicios</a></li>
        <li><a href="#">Contacto</a></li>
        <li><a href="login.php">Iniciar Sesion</a></li>

    </ul>
  </nav>';
}
function navegadorBienvenida(){
    echo '<nav>
    <ul>
        <li><a href="sobrenosotros.php">Sobre nosotros</a></li>
        <li><a href="#">Servicios</a></li>
        <li><a href="#">Contacto</a></li>
        <li><a href="miscursos.php">Mis Cursos</a></li>
    </ul>
  </nav>';
}
function encabezadoUsuario($datos){
    echo "<header>
    <div class='header'>
    <a href='bienvenida.php'><img src='./img/TECHrecortada.png' alt='TechAcademy' id='logo'></a>
        <h2 id='titulo'>TECH ACADEMY</h2>
    </div>";
    //echo "<h1> PRUEBA</h1>";
    navegadorUsuario();
    datosUserVisibles($datos);
    echo "</header>";
}
// ###################
// ENCABEZADO PROFES #
// ###################
function datosProfeVisibles($datos){
    echo "<div class='usuario'>";
    echo "<p id='username' >";
    echo $datos['nombre']. ' ' .$datos['apellidos'] ;
    echo "</p>";
    $foto = $datos['foto'];
    $info = pathinfo($foto);
    if (isset($info['extension']) && $info['extension'] !== '') {
    echo "<img src='./".$datos['foto']."' alt='fotoperfil' id='fotoperfil'>";
    } else {
        echo "<img src='./img/perfiles/default.png' alt='fotoperfil' id='fotoperfil'>";
    }

    echo "</div>";
}

function navegadorProfe(){
    echo '<nav>
    <ul>
        <li><a href="miscursosprofe.php">Mis cursos</a></li>
        <li><a href ="login.php">Cerrar Sesion</a></li>
    </ul>
  </nav>';

}

function encabezadoProfe($datos){
    echo "<header>
    <div class='header'>
    <img src='./img/TECHrecortada.png' alt='TechAcademy' id='logo'>
        <h2 id='titulo'>TECH ACADEMY</h2>
    </div>";
    //echo "<h1> PRUEBA</h1>";
    navegadorProfe();
    datosProfeVisibles($datos);
    echo "</header>";
}

// ############
// Base de Datos #
// ############

function abrirBBDD(){
    try {
        $connection = mysqli_connect("localhost", "admin", "password", "tech_academy");
        return $connection;
    } 
    catch (Exception $e) {
        echo "<p>ERROR</p>";
        header("Location: formulariocursos.php");
        return false;
    }
}


// ############
// Cursos     #
// ############

function datosconcurso($dni){
    $connection = abrirBBDD();
    $sql = "SELECT concurso FROM alumnos WHERE dni = '$dni'";
    $result = $connection->query($sql);
    return $result;
}

function Concurso($dni){
    $connection = abrirBBDD();
    $sql = "SELECT concurso FROM alumnos WHERE dni = '$dni'";
    $result = $connection->query($sql);
   
    if ($result == true){
         ?>
         <script src = "./js/concurso.js"></script>
         <?php
        $sql2 = "UPDATE alumnos SET concurso = false WHERE dni = '$dni'";
        $result2 = $connection->query($sql2);
        
    }
}

function insertarCurso($nombre, $descripcion, $horas, $inicio, $final, $activo, $imagen, $fk_profesor,$connection){
    $sql = "SELECT * FROM cursos WHERE nombre = '$nombre'";
        $result = $connection->query($sql);
        if ($result->num_rows > 0) {
            // Si el curso ya existe en la base de datos, mostramos un mensaje de error
            echo "<a href='menuadmin.php'>Volver al menu</a>";
        ?>
        <script>
            alert("EL CURSO YA ESTA CREADO!");
        </script>
        
        <?php

        } else {
            if($inicio >= date('Y-m-d')){
                echo "hola";
            // Si el usuario no existe en la base de datos, lo insertamos
            $sql = "INSERT INTO cursos (nombre, descripcion, horas, inicio, final, activo, foto, fk_profesor) VALUES ('$nombre', '$descripcion','$horas', '$inicio', '$final','$activo', '$imagen', '$fk_profesor')";
            }else{
                ?>
                <script>
                    alert("Error, NO puedes crear un curso anterior a la fecha de hoy");
                </script>
                <?php
            }
    
        try  {
            if($connection->query($sql) === TRUE){
                header("Location: menuadmin.php");
            }
            // Si se ha insertado el usuario correctamente, mostramos un mensaje de éxito
        } catch(Exception $e) {
            // Si ha habido un error al insertar el curso, mostramos un mensaje de error
            echo "Error";
        }
        }
}



function crearcurso(){
    if($_POST){
        //COGEMOS LOS DATOS DEL FORMULARIO
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $horas = $_POST['horas'];
        $inicio = $_POST['inicio'];
        $final = $_POST['final'];
        $activo = true;
        $fk_profesor = $_POST['fk_profesor'];
        $nombresinespacio = str_replace(' ', '',$nombre);
        try{
            $imagencurso = moverImagenR("cursos", $nombresinespacio);
        }catch(Exception $e){
            echo "";
        }
        $timestamp = strtotime($inicio);
        $TiempoInicio = date('Y-m-d', $timestamp);
        $timestamp2 = strtotime($final);
        $TiempoFinal = date('Y-m-d', $timestamp2);

        $connection = abrirBBDD();
        
        if ($connection){
            insertarCurso($nombre,$descripcion,$horas,$TiempoInicio,$TiempoFinal,$activo,$imagencurso,$fk_profesor,$connection);
        } else{
            header("Location: formulariocursos.php");
        }
    } else{
        header("Location: formulariocursos.php");
    }
}

function eliminarCurso(){
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
}

function modificarCurso(){
    $conexion = abrirBBDD();

    // Obtener los datos enviados desde el formulario
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    // Consulta SQL para actualizar el curso
    $consulta = "UPDATE cursos SET nombre='$nombre', descripcion='$descripcion' WHERE codigo=$codigo";

    if ($conexion->query($consulta) === TRUE) {
        echo "Curso actualizado con éxito.";
        echo "<a href='menuadmin.php'><p>Volver al menu</p></a>";
    } else {
        echo "Error al actualizar el curso: " . $conexion->error;
    }

}

// ADMIN
function adminLogin(){
    session_start();
    if($_SESSION){
        if($_SESSION['tipo']=='admin'){
    
        $id = $_SESSION['id'];
        $usuario = $_SESSION['usuario'];
        $contraseña = $_SESSION['contraseña'];

        $conexion = abrirBBDD();
        $sql = "SELECT usuario, contraseña FROM administradores WHERE id=$id";
    
        $result = $conexion->query($sql);
        $row = $result->fetch_assoc();
        if ($usuario == $row['usuario'] && $contraseña == $row['contraseña']) {
            // Almacenar los datos en la sesión
            $_SESSION['id'] = $id;
            $_SESSION['usuario'] = $usuario;
            $_SESSION['contraseña'] = $contraseña;
            $_SESSION['tipo']=='admin';
            
        } else {
            ?>  
                <script>
                    alert("No se ha iniciado session correctamente");
                </script>              
                <meta http-equiv="REFRESH" content="0;url=admin.php">
            <?php
        }
    } else {
        ?>  
                <script>
                    alert("No tienes permisos de admin");
                </script>              
                <meta http-equiv="REFRESH" content="0;url=login.php">
            <?php
    }

    } else {
        ?>  
                <script>
                    alert("No se ha iniciado session correctamente");
                </script>              
                <meta http-equiv="REFRESH" content="0;url=admin.php">
            <?php

    }

}
function adminCursos(){
    echo '<table class="admin">
            <tr class="titulo">
                <td colspan="8"><h1>CURSOS</h1></td>
            </tr>
            <tr class="titulo">
                <td colspan="7" class="buscador">
                    <form enctype="multipart/form-data" action="" method="POST">
                        <p>Busqueda por Codigo/Nombre: <input type="search" name="busqueda" placeholder="Codigo o Nombre"><a href = "admincursos.php"><img src="./img/refresh.png" alt="RefrescarBusqueda" id ="Refresh"></a></p>
                    </form>
                </td> 
                <td class="añadir" colspan="1"><a href="./formulariocursos.php"><span title="Añadir curso"><img src="./img/añadir.png" alt="añadir" id="añadir"></span></a></td>
            </tr>
            <tr class="blanco">
                <td>Codigo</td>
                <td>Nombre</td>
                <td>Fecha inicio</td>
                <td>Fecha final</td>
                <td>Horas</td>
                <td>Activo</td>
                <td>Editar</td>
                <td>Desactivar</td>
            </tr>';

    $conexion = abrirBBDD();
    if(isset($_POST['busqueda']) && strlen($_POST['busqueda']) > 0) {
        $busqueda = $_POST['busqueda'];
        $sql = "SELECT * FROM cursos WHERE nombre LIKE '%$busqueda%' OR codigo LIKE '%$busqueda%'";
    }
    else {
        $sql = "SELECT * FROM cursos";
    }
    $result = $conexion->query($sql);
    if ($result->num_rows > 0) {
        while ($linia = $result->fetch_assoc()){
            echo '<tr>
                    <td>' . $linia['codigo'] . '</td>
                    <td>' . $linia['nombre'] . '</td>
                    <td>' . $linia['inicio'] . '</td>
                    <td>' . $linia['final'] . '</td>
                    <td>' . $linia['horas'] . '</td>';

                if ($linia['activo'] == "1") {
                    echo '<td> <img src="./img/punto_verde.png" alt="Verde"> </td>';
                } else {
                    echo '<td> <img src="./img/punto_rojo.png" alt="Rojo"> </td>';
                }

                echo '<td>
                    <form action="cursomodificar.php" method="POST">
                        <input type="hidden" name="codigo" value="' . $linia['codigo'] . '">
                        <button type="submit" name="mod_curso"><img src="./img/editar.png" alt="TechAcademy"></button>
                    </form>
                </td>
                <td>
                    <form action="cursodesactivar.php" method="POST">
                    <input type="hidden" name="codigo" value="' . $linia['codigo'] . '">
                    <button type="submit" name="des_curso"><img src="./img/eliminar.png" alt="TechAcademy"></button>
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

function cursoModificar($codigo){
    $conexion = abrirBBDD();
    if($conexion == false) {
        mysqli_connect_error();
    } else {
        $sql = "SELECT * FROM cursos WHERE codigo='$codigo'";
        $result = $conexion->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            echo "<div class='perfil'>";

            echo "<form action='cursoprocesar.php' method='POST' enctype='multipart/form-data'>";
            echo "<label for='codigo'>CODIGO:</label>";
            echo "<input type='text' id='codigo' name='codigo' value='" . $row['codigo'] . "' readonly required><br>";
            echo "<label for='nombre'>Nombre:</label>";
            echo "<input type='text' id='nombre' name='nombre' value='" . $row['nombre'] . "' required><br>";
            echo "<label for='descripcion'>Descripcion:</label>";
            echo "<textarea name='descripcion' rows='4' cols='50' required>" . $row['descripcion'] . "</textarea><br>";
            echo "<label for='horas'>Horas:</label>";
            echo "<input type='number' name='horas' value='" . $row['horas'] . "' required><br>";
            echo "<label for='Inicio'>Inicio:</label>";
            echo "<input type='date' name='inicio' value='" . $row['inicio'] . "' required><br>";
            echo "<label for='final'>Final:</label>";
            echo "<input type='date' name='final' value='" . $row['final'] . "' required><br>";

            // echo "<img src='./".$row['foto']."' alt='fotocurso' id='fotocurso'>";
            // echo "<label for='Foto'>Foto:</label>";
            // echo "<input type='file' name='imagen' accept='img/*' value='./".$row['foto']."' required><br>";

            echo "<input type='submit' value='Guardar'>";
            echo "</form>";
            echo "</div>";

        }

    }
}

function profeModificar($dni){
    $conexion = abrirBBDD();
    if($conexion == false) {
        mysqli_connect_error();
    } else {
        $sql = "SELECT * FROM profesor WHERE dni='$dni'";
        $result = $conexion->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            echo "<div class='perfil'>";

            echo "<form action='profesprocesar.php' method='POST' enctype='multipart/form-data'>";
            echo "<label for='dni'>dni:</label>";
            echo "<input type='text' id='dni' name='dni' value='" . $row['dni'] . "' readonly required><br>";
            echo "<label for='nombre'>Nombre:</label>";
            echo "<input type='text' id='nombre' name='nombre' value='" . $row['nombre'] . "' required><br>";
            echo "<label for='apellidos'>apellidos:</label>";
            echo "<input type='text' id='apellidos' name='apellidos' value='" . $row['apellidos'] . "' required><br>";
            echo "<label for='titulo_academico'>Titulo academico:</label>";
            echo "<input type='text' id='titulo_academico' name='titulo_academico' value='" . $row['titulo_academico'] . "' required><br>";

            // echo "<img src='./".$row['foto']."' alt='fotocurso' id='fotocurso'>";
            // echo "<label for='Foto'>Foto:</label>";
            // echo "<input type='file' name='imagen' accept='img/*' value='./".$row['foto']."' required><br>";

            echo "<input type='submit' value='Guardar'>";
            echo "</form>";
            echo "</div>";

        }

    }
}

// LISTAR CURSOS
function listarCursos($dni){
    $conexion = abrirBBDD();
        if($conexion == false) {
            mysqli_connect_error();
            echo '<p> ERROR </p>';
        }
        else {
            echo '<h2> Todos los cursos: </h2>';
            //Poner buscador
            ?>
            <form enctype="multipart/form-data" action="" method="POST">
                <p>Busqueda de curso por nombre: <input type="search" name="busqueda" placeholder="Nombre"> <a href="listarcursos.php"><img src="./img/refresh.png" alt="RefrescarBusqueda" id ="Refresh"></a></p>
            </form>
            <?php
            $control = date('Y-m-d');
            if(isset($_POST['busqueda']) && strlen($_POST['busqueda']) > 0) {
                $busqueda = $_POST['busqueda'];
                $sql = "SELECT * FROM cursos WHERE codigo NOT IN (SELECT codigo FROM matriculados WHERE dni = '$dni') AND inicio > '$control' AND nombre LIKE '%$busqueda%';";
            }
            else {
                $sql = "SELECT * FROM cursos WHERE codigo NOT IN (SELECT codigo FROM matriculados WHERE dni = '$dni') AND inicio > '$control';";
            }
            $result = $conexion->query($sql);
            if ($result->num_rows > 0) {
                echo '<div class="curso-wrapper">';
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="curso">';
                    echo '<h2>' . $row['nombre'] . '</h2>';
                    echo '<p>' . $row['descripcion'] . '</p>';
                    echo '<p>'.'Horas: ' . $row['horas'] . '</p>';
                    $foto = $row['foto'];
                    $fotoSinEspacios= str_replace(' ', '', $foto);
                    $info = pathinfo($foto);
                    if (isset($info['extension']) && $info['extension'] !== '') {
                    echo "<img src='./".$fotoSinEspacios."' alt='fotocurso' class='fotocurso'>";
                    } else {
                        echo "";
                    }
                    echo '<form action="paginacurso.php" method="POST">';
                    echo '<input type="hidden" name="codigo" value="' . $row['codigo'] . '">';
                    echo '<button type="submit" name="ver_curso" class="botonvercurso">Ver Curso</button>';
                    echo '</form>';
                    echo '</div>';
                }
                echo '</div>';
            }
            else {
                echo "<h2>No se encontraron cursos.</h2>";
            }
        } 
}

function misCursos($dni,$nombre){
    $conexion = abrirBBDD();
    if($conexion == false) {
        mysqli_connect_error();
    }
    else {
        echo '<h2>Bienvenido ' . $nombre . ', estos son tus cursos:'. '</h2>';
        $sql = "SELECT codigo FROM matriculados WHERE dni='$dni'";
        $result = $conexion->query($sql);
        if ($result->num_rows > 0) {
            echo '<div class="curso-wrapper">';
            while ($row = $result->fetch_assoc()) {
                $curso=$row['codigo'];
                $cursoSql = "SELECT * FROM cursos WHERE codigo=$curso";
                $cursoResult = $conexion->query($cursoSql); 
                if ($cursoResult->num_rows > 0) {
                       
                        while ($cursoRow = $cursoResult->fetch_assoc()) {
                            echo '<div class="curso">';
                            echo '<h2>' . $cursoRow['nombre'] . '</h2>';
                            echo '<p>' . $cursoRow['descripcion'] . '</p>';
                            echo '<p>' .'Horas: ' . $cursoRow['horas'] . '</p>';
                            $foto = $cursoRow['foto'];
                            $fotoSinEspacios= str_replace(' ', '', $foto);
                            $info = pathinfo($foto);
                            if (isset($info['extension']) && $info['extension'] !== '') {
                            echo "<img src='./".$fotoSinEspacios."' alt='fotocurso' class='fotocurso'>";
                            } else {
                                echo "";
                            }
                            echo '<form action="paginacurso.php" method="POST">';
                            echo '<input type="hidden" name="codigo" value="' . $cursoRow['codigo'] . '">';
                            echo '<button type="submit" name="ver_curso" class="botonvercurso">Ver Curso</button>';
                            echo '</form>';
                            echo '</div>';
                        }
                        
                    }
            }
            echo '</div>';
        } else {
            echo "No estas matriculado en ningun curso.";
        }
    }
}

function mostrarCurso($dni, $codigo){
        $conexion = abrirBBDD();
        if($conexion == false) {
            mysqli_connect_error();
        }
        else {

            $sql1 = "SELECT * FROM cursos WHERE codigo = $codigo";
            $result = $conexion->query($sql1);
            $curso = $result->fetch_assoc();
        
            // Verificar si el estudiante está matriculado en el curso
            $sql_verificar = "SELECT * FROM matriculados WHERE codigo = '$codigo' AND dni = '$dni'";
            $result_verificar = $conexion->query($sql_verificar);
        
            echo '<div class="paginacurso">';
            echo '<h2>' . $curso['nombre'] . '</h2>';
            echo '<p>' . $curso['descripcion'] . '</p>';
            echo '<p>'. 'Horas: '. $curso['horas'] . '</p>';
            $foto = $curso['foto'];
            $fotoSinEspacios= str_replace(' ', '', $foto);
            $info = pathinfo($foto);
            if (isset($info['extension']) && $info['extension'] !== '') {
                echo "<img src='./".$fotoSinEspacios."' alt='fotocurso' id='fotocurso2'>";
            } else {
                echo "";
            }

            if ($result_verificar->num_rows > 0) {
                // El estudiante ya está matriculado, muestra otro contenido en su lugar
                // Obtener la nota actual de la base de datos
                $notaActual = ObtenerNotaAlumno($dni, $codigo);
                if ($notaActual < 1){
                    echo '<h3>Nota todavia no disponible</h3>';
                }else{
                    echo '<h3>'.'Nota: ' ."$notaActual".'</h3>';
                }

                
                echo "<form action='desmatricularse.php' method='POST'>";
                echo "<button type='submit' name='Darbaja'>Darse de baja</button>";
                echo "</form>";
            } else {
                // El estudiante no está matriculado, muestra el formulario de matriculación
                echo "<form action='matricularse.php' method='POST'>";
                echo "<button type='submit' name='Matricularse'>Matricularse</button>";
                echo "</form>";
            }
            echo '</div>';
        }
}

// ############
// Profesores #
// ############

function insertarProfesor($dni, $nombre, $apellidos, $titulo_academico, $foto, $activo, $contraseña, $connection){
    $sql = "SELECT * FROM profesor WHERE dni = '$dni'";
    $result = $connection->query($sql);
    
    if ($result->num_rows > 0) {
        // Si el usuario ya existe en la base de datos, mostramos un mensaje de error
    ?>
    <script>
        alert("EL PROFESOR YA ESTA CREADO!")
    </script>
    <?php

    } else {
        // Si el usuario no existe en la base de datos, lo insertamos
        $sql = "INSERT INTO profesor (dni, nombre, apellidos, titulo_academico, foto, activo, contraseña) VALUES ('$dni', '$nombre','$apellidos', '$titulo_academico', '$foto','$activo', '$contraseña')";

        if ($connection->query($sql) === TRUE) {
            // Si se ha insertado el usuario correctamente, mostramos un mensaje de éxito
            header("Location: menuadmin.php");
        } else {
            // Si ha habido un error al insertar el usuario, mostramos un mensaje de error
            echo '<p>Error al registrar el usuario: ' . $connection->error . '</p>';
        }
    }
}

function eliminarprofes(){
    if($_POST){
        
        if (isset($_POST['profesores']) && is_array($_POST['profesores'])) {
            $profesoresSeleccionados = $_POST['profesores'];
    
            // Realizar la conexión a la base de datos 
            $connection = abrirBBDD();
    
            if ($connection) {
                foreach ($profesoresSeleccionados as $dni){
                    $busqueda = "SELECT activo FROM profesor WHERE dni = ?"; 
                    $stmt_busqueda = $connection->prepare($busqueda);
                        if ($stmt_busqueda) {
                            $stmt_busqueda->bind_param("s", $dni);
                            $stmt_busqueda->execute();
                            $stmt_busqueda->bind_result($activo);
                    
                            if ($stmt_busqueda->fetch()) {
                                // Si el resultado indica que está activo, desactívalo, y viceversa
                                $stmt_busqueda->close();
                                if ($activo == 1) {
                                    $sql = "UPDATE profesor SET activo = 0 WHERE dni = ?";
                                } else {
                                    $sql = "UPDATE profesor SET activo = 1 WHERE dni = ?";
                                }
                    
                                $stmt = $connection->prepare($sql);
                                if ($stmt) {
                                    $stmt->bind_param("s", $dni);
                                    $stmt->execute();
                                    $stmt->close();
                                }
                            }
                        }
                    }
                    
                    header("Location: profesdesactivar.php");
                }
        } else{
            header("Location: profesdesactivar.php");

        }
    } else{
        echo "<h1>No se relleno el formulario correctamente</h1>";
        sleep(1);
        header("Location: menuadmin.php");
}
}

function crearProfe(){
    if($_POST){
        //COGEMOS LOS DATOS DEL FORMULARIO
        $foto = moverImagenR("perfiles", $_POST['dni']);
        $contraseña = encriptacio($_POST['contraseña']);
        $dni = $_POST['dni'];
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $titulo_academico = $_POST['titulo_academico'];
        $activo = true;

        $connection = abrirBBDD();

        if ($connection){
            insertarProfesor($dni, $nombre, $apellidos, $titulo_academico, $foto, $activo, $contraseña, $connection);
        } else{
            header("Location: formulariocursos.php");
        }

    } else{
        echo "<h1>No se relleno el formulario correctamente</h1>";
        sleep(1);
        header("Location: formulariocursos.php");
    }
}

function modificarProfe(){
        $conexion = abrirBBDD();

    // Obtener los datos enviados desde el formulario
    $dni = $_POST['dni'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $titulo_academico = $_POST['titulo_academico'];

    // Consulta SQL para actualizar el profesor
    $consulta = "UPDATE profesor SET nombre = '$nombre', apellidos = '$apellidos', titulo_academico = '$titulo_academico' WHERE dni = '$dni'";

    if ($conexion->query($consulta) === TRUE) {
        echo "Curso actualizado con éxito.";
        echo "<a href='menuadmin.php'>Volver al menu</a>";
    } else {
        echo "Error al actualizar el curso: " . $conexion->error;
    }
}

// ############
// Registro   #
// ############

function formularioRegistro() {
    if($_POST) {
        $usuarioregistrado = false;
        $conexion = abrirBBDD();
        if($conexion == false) {
            mysqli_connect_error();
        }
        else {

            $imagen_path = moverImagenR("perfiles", $_POST['dni']);
            $contraseña = encriptacio($_POST['contraseña']);
            $dni = $_POST['dni'];
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $edad = $_POST['edad'];
            $concurso = true;
            if(comprobacionDNI($dni) == true && comprobacionEdad($edad) == true) {
                $sql = "INSERT INTO alumnos (dni, nombre, apellidos, edad, contraseña, foto, concurso) VALUES ('$dni', '$nombre', '$apellidos', '$edad', '$contraseña', '$imagen_path', '$concurso')";
                $sql2 = "SELECT dni FROM alumnos WHERE dni='$dni'";
                $consulta = mysqli_query($conexion, $sql2);
                $numlinias = mysqli_num_rows($consulta);
                if($numlinias > 0) {
                    $usuarioregistrado = true; 
                    ?>
                    <script>
                        alert("¡Usuario registrado!")
                    </script>
                    <?php
                }
                else {
                    $_SESSION['tipo'] = "alumno";
                    $consulta = mysqli_query($conexion, $sql);
                    $datoconcursos = datosconcurso($dni);
                    header("Location: listarcursos.php?registro_exitoso=true");
                }
            }
            else if (comprobacionDNI($dni) == true) {
                ?>
                    <script>
                        alert("La edad es incorrecta")
                    </script>
                    <meta http-equiv="REFRESH" content="0;url=signup.php">
                <?php
            }
            else if (comprobacionEdad($edad) == true) {
                ?>  
                    <script>
                        alert("El DNI es incorrecto") 
                    </script>
                    <meta http-equiv="REFRESH" content="0;url=signup.php">
                <?php
            }
            else {
                ?>
                    <script>
                        alert("El DNI y la edad son incorrectos")
                    </script>
                    <meta http-equiv="REFRESH" content="0;url=signup.php">
                <?php
            }
            
        }
    }
    //Si no existeix l'array POST entra al un formulari
    else {
        formularioRegistro();
    }
    return $usuarioregistrado;
}

function moverImagen() {
    $imagen_ext = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
    $imagen_path = 'img/perfiles/' . $_POST['dni'] .'.'. $imagen_ext;
    move_uploaded_file($_FILES['imagen']['tmp_name'], $imagen_path);

    return $imagen_path;
}

function moverImagenR($path, $name) {
    $imagen_ext = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
    $imagen_path = './img/'. $path .'/' . $name .'.'. $imagen_ext;
    move_uploaded_file($_FILES['imagen']['tmp_name'], $imagen_path);
    
    return $imagen_path;
}

function eliminarImagen($path) {
    if (file_exists($path)) {
        unlink($path);
    }
}

function encriptacio($contraseña) {
    //$contraseña = $_POST['contraseña'];
    $contraseña_encriptada = password_hash($contraseña, PASSWORD_BCRYPT);

    return $contraseña_encriptada;
}

function comprobacionDNI($dni) {
	$letras = 'TRWAGMYFPDXBNJZSQVHLCKE';
	$numero = substr($dni, 0, 8);
	if(ctype_digit($numero)) {
		$residuo = (int)$numero%23;
		if($dni[8] == $letras[$residuo]) {
			return true;
		}
		else {
			return false;
		}
	}
	else {
		return  false;
	}
}

function comprobacionEdad($edad) {
	if(ctype_digit($edad)) {
		return true;
	}
	else {
		return false;
	}
}


function formularioInicio() {
    ?>
    <div>
        <h1>INICIO DE SESIÓN</h1>
        <form enctype="multipart/form-data" action="login.php" method="POST">
            <table>
                <tr>
                    <td class="imagen" colspan="2"> <a href="bienvenida.php"> <img src="./img/TECHrecortada.png" alt="Descripción de la imagen"> </a> </td>
                </tr>
                <tr>
                    <td> <label for="dni">DNI:</label> </td> <td> <input type="text" name="dni" id="dni" required> </td>
                </tr>
                <tr>
                    <td> <label for="contraseña">Contraseña:</label> </td> <td> <input type="password" name="contraseña" id="contraseña" required> </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center"> <input type="checkbox" name="profesor" id="profesor"> <label for="profesor">Soy profesor</label></td>
                </tr>
                <tr>
                    <td id="iniciar" style="text-align:center" colspan="2"> 
                        <input type="submit" name="Aceptar" value="Aceptar">
                    </td>
                </tr>
                <tr>
                    <td style="text-align:center" colspan="2">
                        <a href="signup.php">Registrarse</a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <?php
}

function contenido($conexion, $sql) {
    $consulta = mysqli_query($conexion, $sql);
    $linia = mysqli_fetch_array($consulta);
    
    return $linia[0];
}

function verificarContraseña($contraseña, $contraseñaBBDD) {
    return password_verify($contraseña, $contraseñaBBDD);
}
// CREAR UNA FUNCION IGUAL PARA PROFESORES
function sessionAbrir($dni){
    $conexion = abrirBBDD();

    $sql = "SELECT * FROM alumnos WHERE dni = '$dni'";
    $result = $conexion->query($sql);
    $lineas = $result -> fetch_assoc();

    $nombre = $lineas['nombre'];
    $apellidos = $lineas['apellidos'];
    $edad = $lineas['edad'];
    $foto = $lineas['foto'];

    $datos = array(
        'nombre'=>$nombre,
        'apellidos' => $apellidos,
        'edad' => $edad, 
        'foto' => $foto
    );

    return $datos;
}


// ############
// MATRICULAR #
// ############
function DatosCurso($codigo){
    $conex = abrirBBDD();
    $sql = "SELECT inicio, final,nombre, descripcion FROM cursos WHERE codigo = '$codigo'";
    $result = $conex ->query($sql);
    $fila = $result->fetch_assoc();
    $inicio = $fila['inicio'];
    $final = $fila['final'];
    $nombre = $fila['nombre'];
    $descripcion = $fila['descripcion'];
    $datos = array(
        'inicio' => $inicio,
        'final' => $final,
        'nombre' => $nombre,
        'descripcion' => $descripcion
    );

    return $datos;
}
//EL CODIGO CONTIENE CONTROL DE FECHAS POR SI HICIERAN FALTA EN UN FUTURO. 
function matricular($dni, $codigo) {
    $conexion = abrirBBDD();
    $datos = DatosCurso($codigo);
    $inicio = $datos['inicio'];
    $final = $datos['final'];
    if($final > date('Y-m-d')){
        if($inicio > date('Y-m-d')){
            $sql = "INSERT INTO matriculados (codigo, dni, nota) VALUES ('$codigo', '$dni',0)";
            try {
                if ($conexion->query($sql)) {
                    // La consulta se ejecutó correctamente.
                    ?>
                    <script>
                        alert("¡Matriculado con éxito!");
                        window.location.href = "listarcursos.php";
                    </script>
                    <?php
                    return true;
                } else {
                    // Hubo un error en la consulta.
                    throw new Exception("Error en la consulta: " . $conexion->error);
                }
            } catch (Exception $ex) {
                ?>
                <script>
                    alert("¡ERROR! Ya estas matriculado");
                </script>
                <?php
                return false;
            }
        } else{
            ?>
            <script>
                alert("¡ERROR! CURSO INICIADO");
                window.location.href = "listarcursos.php";
            </script>
            <?php
        }
    } else{
        ?>
        <script>
            alert("¡ERROR! CURSO FINALIZADO");
            window.location.href = "listarcursos.php";
        </script>
        <?php
    }
    
}
function desmatricular($dni, $codigo) {
    $conexion = abrirBBDD();
    $sql = "DELETE FROM matriculados WHERE codigo = '$codigo' AND dni = '$dni'";
    try {
        if ($conexion->query($sql)) {
            // La consulta se ejecutó correctamente.
            ?>
            <script>
                alert("¡Desmatriculado con éxito!");
                window.location.href = "listarcursos.php";
            </script>
            <?php
            return true;
        } else {
            // Hubo un error en la consulta.
            throw new Exception("Error en la consulta: " . $conexion->error);
        }
    } catch (Exception $ex) {
        ?>
        <script>
            alert("¡ERROR!");
            window.location.href = "listarcursos.php";
        </script>
        <?php
        return false;
    }
}


// ############
// PERFIL     #
// ############

function perfil($dni){
    // echo '<h2>'. $dni . '</h2>';
    $conexion = abrirBBDD();
    if($conexion == false) {
        mysqli_connect_error();
    }
    else {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Comprobar si se ha enviado el formulario
            $nuevoNombre = $_POST['nombre'];
            $nuevoApellidos = $_POST['apellidos'];
            $nuevoEdad = $_POST['edad'];
            //Si se cumplen las condiciones para cambiar la contraseña se guarda la nueva
            if ($_POST['contraseña']) {
                $sql = "SELECT contraseña FROM alumnos WHERE dni='".$_SESSION['dni']."';";
                $contraseñaBBDD = contenido($conexion, $sql);
                $contraseña = $_POST['contraseña'];
                $verificacion = verificarContraseña($contraseña, $contraseñaBBDD);
                if($verificacion == true) {
                    $contraseñaNueva = $_POST['contraseña_nueva'];
                }
                else {
                    ?>  
                        <script>
                            alert("La contraseña no se ha cambiado porque la contraseña actual no es correcta");
                        </script>              
                    <?php
                    $contraseñaNueva = "";
                } 
            } 
            // Obtener el DNI de la sesión o de alguna otra fuente
            $dni = $_SESSION['dni']; // Asegúrate de que esta variable de sesión esté configurada correctamente
            if(!empty($contraseñaNueva)) {
                $contraseña = encriptacio($contraseñaNueva);
                if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                    eliminarImagen($_SESSION['foto']);
                    $imagen_path = moverImagenR("perfiles", $dni);
                    // Actualizar los datos en la base de datos
                    $sqlUpdate = "UPDATE alumnos SET nombre = '$nuevoNombre', apellidos = '$nuevoApellidos', edad = '$nuevoEdad', contraseña = '$contraseña', foto = '$imagen_path' WHERE dni = '$dni'";
                }
                else {
                    //Actualizar los datos en la base de datos sin la foto porque no se ha editado
                    $sqlUpdate = "UPDATE alumnos SET nombre = '$nuevoNombre', apellidos = '$nuevoApellidos', edad = '$nuevoEdad', contraseña = '$contraseña' WHERE dni = '$dni'";
                }
            }
            else {
                if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                    eliminarImagen($_SESSION['foto']);
                    $imagen_path = moverImagenR("perfiles", $dni);
                    // Actualizar los datos en la base de datos
                    $sqlUpdate = "UPDATE alumnos SET nombre = '$nuevoNombre', apellidos = '$nuevoApellidos', edad = '$nuevoEdad', foto = '$imagen_path' WHERE dni = '$dni'";
                }
                else {
                    //Actualizar los datos en la base de datos sin la foto porque no se ha editado
                    $sqlUpdate = "UPDATE alumnos SET nombre = '$nuevoNombre', apellidos = '$nuevoApellidos', edad = '$nuevoEdad' WHERE dni = '$dni'";
                }
            } 
            
            if ($conexion->query($sqlUpdate) === TRUE) {
                // Redirigir a la misma página después de la actualización
                ?>               
                    <meta http-equiv="REFRESH" content="0;url=perfil.php">
                <?php
            } else {
                echo "Error al actualizar los datos: " . $conexion->error;
            }
        }
        
        $sql = "SELECT * FROM alumnos WHERE dni='$dni'";
        $result = $conexion->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['foto'] = $row['foto']; //ayudita

            echo "<div class='perfil'>";
            
            echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='post' enctype='multipart/form-data'>";
            echo "<div class = 'textosperfil'>";
            // Rellenar el formulario con los valores de la consulta
            echo "<label for='dni'>DNI:</label>";
            echo "<input type='text' id='dni' name='dni' value='" . $row['dni'] . "' disabled><br>";

            echo "<label for='nombre'>Nombre:</label>";
            echo "<input type='text' id='nombre' name='nombre' value='" . $row['nombre'] . "' required><br>";

            echo "<label for='apellidos'>Apellidos:</label>";
            echo "<input type='text' id='apellidos' name='apellidos' value='" . $row['apellidos'] . "' required><br>";

            echo "<label for='edad'>Edad:</label>";
            echo "<input type='number' id='edad' name='edad' value='" . $row['edad'] . "' required><br>";
            
            echo "<label for='change_password_checkbox'>Cambiar contraseña</label> <input type='checkbox' id='change_password_checkbox' onchange='togglePasswordFields()'><br>";
            

            //Si se selecciona el checkbox anterior se despliega el cambio de contraseña
            echo "<div id='password_fields' style='display: none;'>";

                echo "<label for='contraseña'>Contraseña actual:</label>";
                echo "<input type='password' id='contraseña' name='contraseña'><br>";

                echo "<label for='contraseña_nueva'>Contraseña nueva:</label>";
                echo "<input type='password' id='contraseña_nueva' name='contraseña_nueva'><br><br>";

            echo "</div>";

            echo "<label for='imagen'>Foto de perfil:</label>";
            echo "<input type='file' name='imagen' id='imagen' accept='img/*'><br>";

            // Botón para enviar el formulario
            echo "<input type='submit' value='Guardar'>";
            echo "</div>";
            echo "</form>";
            echo '<a href="cerrarsesion.php">Cerrar Sesión</a>';
            echo "</div>";
        }   
    }
}

#PROFES
function CursosProfe($dni){
    $conexion = abrirBBDD();  
    if($conexion == false) {
        mysqli_connect_error();
    }
    else {
        //echo '<h2>Bienvenido, ' . $nombre . '</h2>';
        echo '<h2>Mis cursos:</h2>';
        $sql = "SELECT * FROM cursos WHERE fk_profesor = '$dni'";
        $result = $conexion->query($sql);
        if ($result->num_rows > 0) {
            echo '<div class="curso-wrapper">';
            while ($row = $result->fetch_assoc()) {
                $curso=$row['codigo'];
                $cursoSql = "SELECT * FROM cursos WHERE codigo=$curso";
                $cursoResult = $conexion->query($cursoSql); 
                if ($cursoResult->num_rows > 0) {
                        
                        while ($cursoRow = $cursoResult->fetch_assoc()) {
                            echo '<div class="curso">';
                            echo '<h2>' . $cursoRow['nombre'] . '</h2>';
                            echo '<p>' . $cursoRow['descripcion'] . '</p>';
                            echo '<p>'.'Horas: ' . $cursoRow['horas'] . '</p>';
                            $foto = $cursoRow['foto'];
                            $fotoSinEspacios= str_replace(' ', '', $foto);
                            $info = pathinfo($foto);
                            if (isset($info['extension']) && $info['extension'] !== '') {
                            echo "<img src='./".$fotoSinEspacios."' alt='fotocurso' class='fotocurso'>";
                            } else {
                                echo "";
                            }
                            echo '<form action="notas.php" method="POST">';
                            echo '<input type="hidden" name="codigo" value="' . $cursoRow['codigo'] . '">';
                            echo '<button type="submit" name="ver_curso">Poner Notas</button>';
                            echo '</form>';
                            echo '</div>';
                        }
                        
                    }
            }
            echo '</div>';
        } else {
            echo "No tienes ningun curso habilitado.";
        }
    }
}
function sessionProfe($dni){
    $conexion = abrirBBDD();

    $sql = "SELECT * FROM profesor WHERE dni = '$dni'";
    $result = $conexion->query($sql);
    $lineas = $result -> fetch_assoc();

    $nombre = $lineas['nombre'];
    $apellidos = $lineas['apellidos'];
    $foto = $lineas['foto'];

    $datos = array(
        'nombre'=>$nombre,
        'apellidos' => $apellidos,
        'foto' => $foto
    );

    return $datos;
}
function DatosAlumnos($dni){
    $conexion = abrirBBDD();
    $sql = "SELECT nombre, apellidos FROM alumnos WHERE dni = '$dni'";
    $result = $conexion->query($sql);
    $cosas = $result->fetch_assoc();
    $nombre = $cosas['nombre'];
    $apellido = $cosas['apellidos'];

    $datos = array(
        'nombre' => $nombre,
        'apellidos' => $apellido,
        'dni' => $dni
    );
    return $datos;
}
function SubirNotas($codigo){
    try{
    if(isset($_POST['notas'])){
        $notas = $_POST['notas'];
        $conexion = abrirBBDD();
        $notanumero = floatval($notas); 
        
        foreach($notas as $dni => $notanumero){
            if ($notanumero <= 10 && $notanumero >=1){
                
                $sql = "UPDATE matriculados SET nota = '$notanumero' WHERE dni = '$dni' AND codigo = '$codigo'"; 
                $result = $conexion->query($sql);
            } else{
                ?>
                <script>
                    alert("Una nota introducida esta fuera del limite(1-10)\nVuelve a introducir las notas correctamente");
                </script>
                <?php
                echo '<meta http-equiv="REFRESH" content="0;url=notas.php">';
            }
           
        }
        echo '<meta http-equiv="REFRESH" content="0;url=notas.php">';
    }
    } catch (Exception $e){
        echo '<meta http-equiv="REFRESH" content="0;url=miscurosprofe.php">';
    }
}
function notas($codigo){
    $conexion = abrirBBDD();
    $datos = DatosCurso($codigo);
    $nombre = $datos['nombre'];
    $datafinal = $datos['final'];
    $sql = "SELECT dni FROM matriculados WHERE codigo = '$codigo'";
    $result = $conexion->query($sql);
    if ($result->num_rows > 0) {
        echo "<form action='subirnotas.php' method='POST'>";
        echo '<div class="notas">';
        echo "<h1>$nombre</h1>";
        
        while ($curso = $result->fetch_assoc()){
            $dni = $curso['dni'];
            $datos = DatosAlumnos($dni);
            // Obtener la nota actual de la base de datos
            $notaActual = ObtenerNotaAlumno($dni,$codigo);
            echo "<p>" . $datos['nombre'] ." ".  $datos['apellidos']." ";
            echo "<input type='text' class='nota' name='notas[$dni]' pattern='^(10|\d(\.\d{1,2})?)$' value='$notaActual'>"."</p>";
        }
        if($datafinal < date('Y-m-d')){
            echo "<button type='submit' name='Notas'>Subir notas</button>";
            echo '</div>';
            echo "</form>";
        } else{
            echo "<h3>El curso debe finalizar para poder poner notas</h3>";
            echo '</div>';
            echo "</form>";
        }
        
        
    } else{
        echo "<h1>No hay alumnos inscritos</h1>";
    }
}

// Función para obtener la nota actual de un alumno por su DNI
function ObtenerNotaAlumno($dni,$codigo) {
    $conexion = abrirBBDD();
    $sql = "SELECT nota FROM matriculados WHERE dni = '$dni' AND codigo = $codigo";
    $result = $conexion->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['nota'];
    }
    return ''; // Valor predeterminado si no se encuentra una nota en la base de datos
}


// ########
// FOOTER #
// ########
function footer() {
    ?>
    <div class="pie">
        <footer>
            <div class="contacto">
                <p>consultas@techacademy.com</p>
                <p>C/de la Batlloria, Badalona</p>
            </div>
            <div class="copyright">
                <p>© 2023 TECH ACADEMY</p>
            </div>
        </footer>
    </div>
    <?php
}
function ControlUsuario($sesion){
    if($sesion != "alumno"){
        return false;
    } else{
        return true;
    }
}
?>

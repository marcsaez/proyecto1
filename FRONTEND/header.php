
<?php
    // CREADO MOMENTARIAMENTE, MOVER A funciones.php
    include_once('funciones.php');

    function navegadorUsuario(){
        echo '<nav>
        <ul>
            <li><a href="listarcursos.php">Todos los cursos</a></li>
            <li><a href="miscursos.php">Mis cursos</a></li>
        </ul>
      </nav>';

    }
    function encabezadoUsuario($datos){
        echo "<header>
        <div class='header'>
        <a href='menuadmin.php'><img src='./img/TECHrecortada.png' alt='TechAcademy' id='logo'></a>
            <h2 id='titulo'>TECH ACADEMY</h2>
        </div>";
        //echo "<h1> PRUEBA</h1>";
        navegadorUsuario();
        datosUserVisibles($datos);
        echo "</header>";
    }
?>
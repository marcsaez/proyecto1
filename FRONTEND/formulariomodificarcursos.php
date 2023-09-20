<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario cursos</title>
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
<h2>Modificar Curso</h2>

    <form method="post" action="procesar_modificacion.php">
        <label for="codigo">Selecciona un curso:</label>
        <select name="codigo">
            <?php
            include_once('funciones.php')
            // Esta funcion devuelve la conexion o false si no se establece la conexión
            $conexion = abrirBBDD()

            // Consulta SQL para obtener la lista de cursos
            $consulta = "SELECT codigo, nombre FROM cursos";
            $resultados = $conexion->query($consulta);

            // Generar las opciones del select
            while ($fila = $resultados->fetch_assoc()) {
                echo "<option value='" . $fila['id'] . "'>" . $fila['nombre'] . "</option>";
            }

            // Cerrar la conexión a la base de datos
            $conexion->close();
            ?>
        </select>
        <br>
        <label for="nuevo_nombre">Nuevo nombre del curso:</label>
        <input type="text" name="nuevo_nombre">
        <br>
        <label for="nueva_descripcion">Nueva descripción del curso:</label>
        <textarea name="nueva_descripcion"></textarea>
        <br>
        <input type="submit" value="Modificar Curso">
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
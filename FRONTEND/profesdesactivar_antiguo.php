<?php 
    include("funciones.php");
    if ($_POST){
        eliminarprofes();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Profes</title>
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
            <!-- FOTO DE PRUEBA PARA MEDIDAS (HAY QUE SACARLA DE LA BBDD) -->
            <p id="username" >Pablo de Gregorio</p>
            <img src="./img/98-1.jpg" alt="fotoperfil" id="fotoperfil">
        </div>
    </header>
    <h2>Desactivar Profesor:</h2>

    <form method="POST" action="">
        <?php 
        include_once("funciones.php");
        $connection = abrirBBDD();
        if ($connection) {
            $sql = "SELECT * FROM profesor WHERE activo = 1";
            $result = $connection->query($sql);

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $dni = $row['dni'];
                    $nombre = $row['nombre'];

                    echo "<label for='profesor_$dni'><input type='checkbox' name='profesores[]' id='profesor_$dni' value='$dni'> $nombre ($dni)</label><br>";
                }
            }
            
            // Cierra la conexión a la base de datos
            $connection = null;
        }
        ?>
        <input type="submit" value="Desactivar">
    </form>
        <h2>Activar Profesor:</h2>
    <form method="POST" action="desactivarprofe.php">
        <?php 
        include_once("funciones.php");
        $connection = abrirBBDD();
        if ($connection) {
            $sql = "SELECT * FROM profesor WHERE activo = 0";
            $result = $connection->query($sql);

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $dni = $row['dni'];
                    $nombre = $row['nombre'];

                    echo "<label for='profesor_$dni'><input type='checkbox' name='profesores[]' id='profesor_$dni' value='$dni'> $nombre ($dni)</label><br>";
                }
            }
            
            // Cierra la conexión a la base de datos
            $connection = null;
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
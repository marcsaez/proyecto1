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
        <div class="usuario">
            <!-- FOTO DE PRUEBA PARA MEDIDAS (HAY QUE SACARLA DE LA BBDD) -->
            <p id="username" >Pablo de Gregorio</p>
            <img src="./img/98-1.jpg" alt="fotoperfil" id="fotoperfil">
        </div>
    </header>
    <?php
    $sql = "SELECT * FROM cursos";
    $result = $conn->query($sql);

    // Contador para rastrear el número de cursos mostrados
    $contador = 0;

    // Si hay resultados, muestra los cursos en bloques de tres
    if ($result->num_rows > 0) {
        echo '<div class="curso-container">';
        while ($row = $result->fetch_assoc()) {
            echo '<div class="curso">';
            echo '<h2>' . $row['nombre'] . '</h2>';
            echo '<p>' . $row['descripcion'] . '</p>';
            echo '</div>';
            
            // Incrementa el contador
            $contador++;
            
            // Cierra el bloque de tres cursos y abre uno nuevo cada vez que se alcanza el tercer curso
            if ($contador % 3 == 0) {
                echo '</div>';
                echo '<div class="curso-container">';
            }
        }
        echo '</div>';
    } else {
        echo "No se encontraron cursos.";
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
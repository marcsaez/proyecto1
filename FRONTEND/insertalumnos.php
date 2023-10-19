<?php
    include_once('funciones.php');
    adminLogin();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Enviar Datos de Alumnos a PHP con XMLHttpRequest</title>
    <link rel="stylesheet" type="text/css" href="./css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="header">
        <a href="menuadmin.php" ><img src="./img/TECHrecortada.png" alt="TechAcademy" id="logo"></a>
            <h2 id="titulo">TECH ACADEMY</h2>
        </div>
        <div class="usuario">
        <?php
            echo '<p id="username" >'. $_SESSION['usuario'] .'</p>'
        ?>
            <img src="./img/98-1.jpg" alt="fotoperfil" id="fotoperfil">
        </div>
    </header>

    <input type="file" id="archivoInput" />
    <button id="procesarArchivo">Procesar Archivo</button>
    <div id="tablaContainer"></div>

    <script>
        const archivoInput = document.getElementById('archivoInput');
        const procesarBoton = document.getElementById('procesarArchivo');
        let datosAlumnos = [];

        archivoInput.addEventListener('change', function(e) {
            const archivo = e.target.files[0];

            if (archivo) {
                const lector = new FileReader();

                lector.onload = function(e) {
                    const contenido = e.target.result;
                    const lineas = contenido.split('\n');

                    datosAlumnos = lineas.map(linea => {
                        const [DNI, nombre, apellidos, edad, contraseña, foto, cursosString] = linea.split(';');

                        // Extraer cursos entre paréntesis y dividirlos en un array
                        const cursosSinParentesis = cursosString.replace(/[()]/g, '');
                        const cursos = cursosSinParentesis.split(',');

                        return { DNI, nombre, apellidos, edad, contraseña, foto, cursos };
                    });
                    crearTabla(datosAlumnos);
                };

                lector.readAsText(archivo);
            }
        });

        procesarBoton.addEventListener('click', function() {
            //Pregunta de confiramcion
            const confirmacion = confirm('¿Estás seguro de insertar los datos?');

            //Si se confirma se envia el array para realizar los insert a la base de datos
            if(confirmacion) {
                // Crear una instancia de XMLHttpRequest
                const xhr = new XMLHttpRequest();
                const url = 'procesar.php';

                xhr.open('POST', url, true);
                xhr.setRequestHeader('Content-Type', 'application/json');

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Manejar la respuesta del servidor aquí (si es necesario)
                        console.log('Respuesta de PHP:', xhr.responseText);
                    }
                };

                // Enviar el array de datos como JSON al servidor
                xhr.send(JSON.stringify(datosAlumnos));
            }
            
        });

        function crearTabla(datosAlumnos) {
            var tablaContainer = document.getElementById('tablaContainer');
            var tabla = document.createElement('table');

            // Crea el encabezado
            var thead = document.createElement('thead');
            var encabezado = thead.insertRow();

            var encabezados = ['DNI', 'Nombre', 'Apellidos', 'Edad', 'Contraseña', 'Path foto', 'Cursos'];

            // For para crear el encabezado con sus respectivos th y su contenido
            for (var i = 0; i < encabezados.length; i++) {
                var encabezadoCelda = document.createElement('th');
                encabezadoCelda.innerHTML = encabezados[i];
                encabezado.appendChild(encabezadoCelda);
            }

            // Despues de crear el thead se añade a table
            tabla.appendChild(thead);

            // Crea el cuerpo de la tabla y llena los datos
            var tbody = document.createElement('tbody');
            for (var i = 0; i < datosAlumnos.length; i++) {
                var fila = document.createElement('tr');

                var valores = [datosAlumnos[i].DNI, datosAlumnos[i].nombre, datosAlumnos[i].apellidos, datosAlumnos[i].edad, datosAlumnos[i].contraseña, datosAlumnos[i].foto, datosAlumnos[i].cursos];

                for (var j = 0; j < valores.length; j++) {
                    var celda = document.createElement('td');
                    celda.innerHTML = valores[j];
                    fila.appendChild(celda);
                }

                tbody.appendChild(fila);
            }
            // Despues de crear el tbody se añade a table
            tabla.appendChild(tbody);

            // Despues de crear la tabla se añade al div
            tablaContainer.appendChild(tabla);
        }
    </script>

    <!-- <footer>
        <div class="contacto">
            <p>consultas@techacademy.com</p>
            <p>C/de la Batlloria, Badalona</p>
        </div>
        <div class="copyright">
            <p>© 2023 TECH ACADEMY</p>
        </div>
    </footer> -->
</body>
</html>

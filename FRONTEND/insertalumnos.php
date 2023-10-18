<!DOCTYPE html>
<html>
<head>
    <title>Enviar Datos de Alumnos a PHP con XMLHttpRequest</title>
</head>
<body>
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
            const confirmacion = confirm('¿Estás seguro de insertar los datos?');

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
            tabla.setAttribute('border', '1');

            // Crea el encabezado
            var thead = document.createElement('thead');
            var encabezado = thead.insertRow();

            var encabezados = ['DNI', 'Nombre', 'Apellidos', 'Edad', 'Contraseña', 'Path foto', 'Cursos'];

            for (var i = 0; i < encabezados.length; i++) {
                var encabezadoCelda = document.createElement('th');
                encabezadoCelda.innerHTML = encabezados[i];
                encabezado.appendChild(encabezadoCelda);
            }

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
            tabla.appendChild(tbody);

            tablaContainer.appendChild(tabla);
}

    </script>
</body>
</html>

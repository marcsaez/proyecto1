document.addEventListener("DOMContentLoaded", function(){
    
    const frases = [
        "¡Enhorabuena! ¡Has ganado un curso gratis!",
        "¡Enhorabuena! ¡Has ganado un 33% de descuento en tu primer curso!",
        "Una lastima, no has ganado nada..."
    ];

    const url = new URLSearchParams(window.location.search);

    if (url.has("registro_exitoso")){
        function concursoaleatorio(){
            const aleatorio = Math.floor(Math.random() * frases.length);
            const fraserandom = frases[aleatorio];
            
            const opcionesVentana = {
            width: 400, // Ancho de la ventana en píxeles
            height: 200, // Altura de la ventana en píxeles
            top: 2500, // Posición superior en píxeles
            left: 2500, // Posición izquierda en píxeles
        };

        // Generar las opciones como una cadena de texto
        const opcionesTexto = Object.keys(opcionesVentana).map(key => `${key}=${opcionesVentana[key]}`).join(",");

        // Abrir una nueva ventana con las opciones especificadas
        const nuevaVentana = window.open("", "", opcionesTexto);
            
           // Agregar el contenido HTML a la nueva ventana
           nuevaVentana.document.write("<h1>Concurso por nuevo:</h1>");
           nuevaVentana.document.write("<p>" + fraserandom + "</p>");
           window.location.href = 'listarcursos.php'; 
        }
        concursoaleatorio();

    } 
    });
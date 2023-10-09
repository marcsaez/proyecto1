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
            
           // Abrir una nueva ventana
           const nuevaVentana = window.open('', '', 'width=400,height=200');
            
           // Agregar el contenido HTML a la nueva ventana
           nuevaVentana.document.write("<h1>Concurso por nuevo:</h1>");
           nuevaVentana.document.write("<p>" + fraserandom + "</p>");
           window.location.href = 'listarcursos.php'; 
        }
        concursoaleatorio();

    } 
    });
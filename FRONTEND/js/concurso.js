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
            alert("Concurso por novato:\n\n"+fraserandom);
            
        }
        concursoaleatorio();
    }
    });
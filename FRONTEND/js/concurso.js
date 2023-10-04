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
            
            const mensajeDiv = document.createElement("div");
            mensajeDiv.textContent = "Concurso por novato:\n\n" + fraserandom;
            mensajeDiv.style.position = "fixed";
            mensajeDiv.style.top = "50%";
            mensajeDiv.style.left = "50%";
            mensajeDiv.style.transform = "translate(-50%, -50%)";
            mensajeDiv.style.backgroundColor = "white";
            mensajeDiv.style.padding = "20px";
            mensajeDiv.style.border = "1px solid #ccc";
            mensajeDiv.style.boxShadow = "0 4px 6px rgba(0, 0, 0, 0.1)";
            mensajeDiv.style.zIndex = "9999";

            // Agregar el elemento al body
            document.body.appendChild(mensajeDiv);
            
        }
        concursoaleatorio();
    }
    });
document.addEventListener('DOMContentLoaded', function() {

    eventListeners();
    darkMode();
    eliminarAlerta();
});

function darkMode() {

    const preferDarkMode = window.matchMedia('(prefers-color-scheme: dark)');
    // console.log(preferDarkMode.matches);

    if (preferDarkMode.matches) {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }

    preferDarkMode.addEventListener('change', function(){
        if (preferDarkMode.matches) {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
    });

    const darkModeBtn = document.querySelector(".dark-mode-btn");
    darkModeBtn.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
    });
}

function eventListeners() {
    // Desplegar barra de navegacion
    const mobileMenu = document.querySelector('.mobile-menu');
    mobileMenu.addEventListener('click', displayNav)

    // Mostrar campos de seleccion en formulario de contacto
    const opcionesContacto = document.querySelectorAll('input[name="contacto"]');

    // Aca el 'input' se refiere al elemento que se esta iterando
    // Similar a si se usara opcionesContacto as input en PHP
    // Se usa sintaxis de flecha, por lo que la funcion a ejecutar no tiene llaves y va todo en la misma linea
    opcionesContacto.forEach(input => input.addEventListener('click', mostrarCamposContacto))
}

// Eliminar texto de confirmación de CRUD en admin/index.php
function eliminarAlerta() {
    setTimeout( function() {
        const alerta = document.querySelector('.alerta.exito');
        const alertaPadre = alerta.parentElement;
        alertaPadre.removeChild(alerta);
    }, 3500);
}

function displayNav() {
    const navegacion = document.querySelector('.navegacion');

    if(navegacion.classList.contains('mostrar')){
        navegacion.classList.remove('mostrar');
    } else{
        navegacion.classList.add('mostrar');
    }

    // Misma funcion:
    // navegacion.classList.toggle('mostrar'); 
}

function mostrarCamposContacto(e) {
    const camposContacto = document.querySelector('#camposContacto');

    if(e.target.value === 'telefono') {
        camposContacto.innerHTML = `

            <input type="tel" placeholder="Tu Teléfono" id="telefono" name="telefono">

            <p> Datos de llamada </p>

            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" name="fecha">

            <label for="hora">Hora</label>
            <input type="time" id="hora" min="09:00" max="18:00" name="hora">

        `;
    } else {
        camposContacto.innerHTML = `

            <input type="email" placeholder="Tu E-mail" id="email" name="email" required>

        `;
    }
}


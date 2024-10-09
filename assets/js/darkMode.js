// Seleccionamos el botón y todos los elementos
const toggleBtn = document.getElementById('temaOscuro');
const header = document.querySelector('.header');
const btnFilters = document.querySelector('.btn-filters');
const body = document.querySelector('body');
const footer = document.querySelector('footer');
const menu = document.querySelector('.menu');
const cerrar = document.querySelector('.cerrar');
const btnsubir = document.querySelectorAll('.btn-subir');

// Creamos un array que contiene todos los elementos
const elements = [header, btnFilters, body, footer, menu, cerrar, ...btnsubir];

// Evento para alternar el modo oscuro al hacer clic
toggleBtn.addEventListener('click', () => {
    console.log('Checkbox toggled');
    
    // Aplicamos la clase 'dark' a todos los elementos del array
    elements.forEach(element => {
        element.classList.toggle('dark');
    });
});

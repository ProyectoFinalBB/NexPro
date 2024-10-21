const toggleBtn = document.getElementById('temaOscuro'); // El botón toggle
const header = document.querySelector('.header');
const btnFilters = document.querySelector('.btn-filters');
const body = document.querySelector('body');
const footer = document.querySelector('footer');
const menu = document.querySelector('.menu');
const cerrar = document.querySelector('.cerrar');
const btnsubir = document.querySelectorAll('.btn-subir');
const containerFrases = document.querySelectorAll('.container-frases');
const tituloLogin = document.querySelector('.titulo-login');
const botonEnviar = document.querySelector('.boton-enviar');
const inputLogin = document.querySelectorAll('.input-login');
const headerCTRLUSR = document.querySelector('.headerCTRLUSR');
const navCTRLUSR = document.querySelector('.navCTRLUSR');
const inputRegistro = document.querySelectorAll('.input-registro');
const tituloPantalla = document.querySelector('.titulo-pantalla'); 
const formularioRegistro = document.querySelector('.formulario-registro');
const iconImgCTRLUSR = document.querySelector('.icon-imgCTRLUSR');
const elements = [header, btnFilters, body, footer, menu, cerrar, ...btnsubir, ...containerFrases, tituloLogin, botonEnviar, ...inputLogin, headerCTRLUSR, navCTRLUSR, ...inputRegistro, tituloPantalla, formularioRegistro, iconImgCTRLUSR];

function toggleDarkMode() {
    elements.forEach(element => {
        if (element) {
            element.classList.toggle('dark');
        }
    });

    if (body.classList.contains('dark')) {
        localStorage.setItem('darkMode', 'enabled');
    } else {
        localStorage.setItem('darkMode', 'disabled');
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const darkMode = localStorage.getItem('darkMode');
    
    if (darkMode === 'enabled') {
        elements.forEach(element => {
            if (element) {
                element.classList.add('dark');
            }
        });
        if (toggleBtn) {
            toggleBtn.checked = true;  
        }
    }
});


if (toggleBtn) {
    toggleBtn.addEventListener('click', () => {
        toggleDarkMode();
    });
} else {
    console.log("El botón toggle para el tema oscuro no existe en el DOM.");
}

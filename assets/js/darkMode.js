const toggleBtn = document.getElementById('temaOscuro'); 
const header = document.querySelector('.header');
const btnFiltersByClass = document.querySelector('.btn-filters');
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
const botonRetroceder = document.querySelectorAll('.boton-retroceder img');
const cerrarSesion = document.querySelector('.cerrar-sesion a');
const cambiarContrasenia = document.querySelector('.texto-contrasena');
const headerSoli = document.querySelector('.headerSoli');
const proyectosAceptados = document.querySelector('#proyectosAceptados');
const proyectosPendientes = document.querySelector('#proyectosPendientes');
const userData = document.querySelectorAll('#userData');
const userItem = document.querySelectorAll('.user-item');
const userItemHover = document.querySelectorAll('.user-item:hover');
const icon = document.querySelectorAll('.icon');
const iconHover = document.querySelectorAll('.icon:hover');
const userInfo = document.querySelectorAll('.user-info');
const proyectoItem = document.querySelectorAll('.proyecto-item');
const proyectoInfo = document.querySelectorAll('.proyecto-info h3');
const proyectoInfoP = document.querySelectorAll('.proyecto-info p');
const modalContent = document.querySelector('.modal-content');
const modalPdfContent = document.querySelector('.modal-pdf-content');
const modalContentH2 = document.querySelector('.modal-content h2');
const modalContentSpan = document.querySelector('.modal-content span');
const modalDataUl = document.querySelector('.modal-data ul');
const formContenedor = document.querySelectorAll('.formContenedor label');
const inputProyecto = document.querySelector('#archivoProyecto');
const tagsMModal = document.querySelector('.tags-modal');
const tagsModalHeader = document.querySelector('.tags-modal-header h3');
const tagItem = document.querySelectorAll('.tag-item');
const modalPdfContentSpan = document.querySelector('.modal-pdf-content span');
const menuImg = document.querySelector('.menu-img');
const resultadosIntegrantes = document.querySelector('.resultados-integrantes');
const integrantesSeleccionados = document.querySelector('.integrantes-seleccionados');

const elements = [header, btnFiltersByClass, body, footer, menu, cerrar,
 ...btnsubir, ...containerFrases, tituloLogin, botonEnviar,
 ...inputLogin, headerCTRLUSR, navCTRLUSR, ...inputRegistro, tituloPantalla, formularioRegistro,
 iconImgCTRLUSR, ...botonRetroceder, cerrarSesion, cambiarContrasenia, headerSoli, proyectosAceptados,
  proyectosPendientes, ...userData, ...userItem, ...userItemHover, ...icon, ...iconHover, ...userInfo,
   ...proyectoItem, ...proyectoInfo, ...proyectoInfoP, modalContent, modalPdfContent, modalContentH2,
    modalContentSpan, modalDataUl, ...formContenedor, inputProyecto, tagsMModal, tagsModalHeader,
     ...tagItem, modalPdfContentSpan, menuImg, resultadosIntegrantes, integrantesSeleccionados];

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
   
}

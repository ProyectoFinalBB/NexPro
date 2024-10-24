
   document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('header').style.display = 'flex';
    document.getElementById('menuCTRLUsuario').style.display = 'none';
    document.getElementById('menuSolicitudProyectos').style.display = 'none';
    document.getElementById('userData').style.display = 'none'; 
    Listado('../controllers/listarEstudiante.php')
    ListadoProyectosPendientes()
    ListadoProyectosAceptados()


});

function redirectToView(ruta, param) {
    const baseURL = '../controllers/viewController.php?param='+param;
    
    const url = new URL(baseURL, window.location.href);
    
    url.searchParams.append('ruta', ruta);

    window.location.href = url;
}

function deleteUser(userId) {
    console.log('Deleting user', userId);

    // Usar la función confirmarEliminacion que maneja el idioma
    if (!confirmarEliminacion()) {
        return; 
    }

    var datos = {
        userId: userId,
        eliminarUsr: "eliminarUsr"
    };

    fetch('../controllers/eliminarUsuario.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json' 
        },
        body: JSON.stringify(datos) 
    })
    .then(response => response.json()) 
    .then(data => {
        console.log(data.message); 
        document.getElementById("mensajeResultado").innerText = data.message;
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById("mensajeResultado").innerText = "Ocurrió un error durante la eliminación.";
    });
}

function confirmarEliminacion() {
    const idioma = localStorage.getItem('idioma') || 'es'; // Por defecto a español
    const mensajes = {
        es: "¿Estás seguro de que deseas eliminar este usuario?",
        en: "Are you sure you want to delete this user?"
    };
    return confirm(mensajes[idioma]);
}

function confirmarModificación() {
    const idioma = localStorage.getItem('idioma') || 'es'; // Por defecto a español
    const mensajes = {
        es: "¿Estás seguro de que deseas modificar este usuario?",
        en: "Are you sure you want to modify this user?"
    };
    return confirm(mensajes[idioma]);
}

function esMovil() {
    return window.innerWidth <= 768; 
}



function Listado($ruta) {
    fetch($ruta)
    .then(response => response.json())
    .then(data => {
        const userList = document.getElementById('userList');
        userList.innerHTML = ''; 
        data.forEach(user => {
            const listItem = document.createElement('div');
            listItem.className = 'user-item';

            const icon = document.createElement('span');
            icon.className = 'fa fa-user-circle icon';
            listItem.appendChild(icon);

       
            const userInfo = document.createElement('span');
            userInfo.textContent = `${user.nombrecompleto} - ${user.ci}`;
            userInfo.className = 'user-info';
            listItem.appendChild(userInfo);

            const editIcon = document.createElement('span');
            editIcon.className = 'fa fa-pencil-alt icon';
            editIcon.onclick = function () {  redirectToView("../views/modificarUsuario.php", user.id_usr);         
            };
            listItem.appendChild(editIcon);

            const deleteIcon = document.createElement('span');
            deleteIcon.className = 'fa fa-trash icon';
            deleteIcon.onclick = function () { deleteUser(user.id_usr); };
            listItem.appendChild(deleteIcon);

            userList.appendChild(listItem);
        });

        document.getElementById('userData').style.display = 'block';
    })
    .catch(error => console.error('Error:', error));
}









    

// Front

//obtener rol
function obtenerRolUsuario() {
    return fetch('../controllers/obtenerRolUsuario.php')
        .then(response => response.json())
        .then(data => data.rol)
        .catch(error => {
            console.error('Error al obtener el rol del usuario:', error);
            return 'guest';
        });
}

//Listar proyectos Aceptados
function ListadoProyectosAceptados() {
    obtenerRolUsuario().then(userRole => {
        fetch('../controllers/listadoProyectosAceptados.php')
            .then(response => response.json())
            .then(data => {
                const proyectosList = document.getElementById('proyectosAceptadosList');
                proyectosList.innerHTML = ''; 

                data.forEach(proyecto => {
                    const listItem = document.createElement('li'); 
                    listItem.className = 'proyecto-item'; 

                    
                    const pdfIcon = document.createElement('img');
                    pdfIcon.src = '../assets/img/pdfimg.png'; 
                    pdfIcon.className = 'pdf-icon';
                    listItem.appendChild(pdfIcon);

                   
                    const proyectoInfo = document.createElement('div');
                    proyectoInfo.className = 'proyecto-info';

                    const proyectoTitulo = document.createElement('h3');
                    proyectoTitulo.textContent = proyecto.titulo;
                    proyectoInfo.appendChild(proyectoTitulo);

                    const miembrosText = proyecto.miembros && Array.isArray(proyecto.miembros) 
                        ? `Miembros: ${proyecto.miembros.join(', ')}` 
                        : 'Miembros: No especificados';

                    const miembros = document.createElement('p');
                    miembros.textContent = miembrosText;
                    proyectoInfo.appendChild(miembros);

                    
                    const tagsHidden = document.createElement('h4');
                    tagsHidden.className = 'tags-ocultos';
                    tagsHidden.style.display = 'none'; 
                    tagsHidden.textContent = proyecto.tags.join(', '); 
                    listItem.appendChild(tagsHidden); 


                    listItem.onclick = function() {
                        mostrarModalInicio(proyecto);  
                    };

                    listItem.appendChild(proyectoInfo);

                    if (userRole === 'administrador') {
                        const eliminarBtn = document.createElement('button');
                        eliminarBtn.textContent = 'Eliminar';
                        eliminarBtn.className = 'btn-eliminar';

                        eliminarBtn.onclick = function(e) {
                            e.stopPropagation(); 
                            eliminarProyecto(proyecto.id);
                        };

                        listItem.appendChild(eliminarBtn);
                    }

                    proyectosList.appendChild(listItem);
                });

                document.getElementById('proyectosAceptadosList').style.display = 'block';
            })
            .catch(error => console.error('Error al cargar los proyectos:', error));
    });
}


function eliminarProyecto(proyectoId) {
    const confirmacion = confirm('¿Estás seguro de que deseas eliminar este proyecto?');
    if (confirmacion) {
    
        fetch(`../controllers/eliminarProyecto.php`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',  
            },
            body: JSON.stringify({ id: proyectoId }) 
        })
        .then(response => {
            
            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor');
            }
            return response.json();
        })
        .then(data => {
            if (data.status === 'success') {
                alert(data.message);  
                ListadoProyectosAceptados();  
            } else {
                alert(data.message);  
            }
        })
        .catch(error => console.error('Error al eliminar el proyecto:', error));
    }
}



    //Modales
        //Modal Inicio
        function mostrarModalInicio(proyecto) {
   
            document.getElementById('nombreProyectoInicio').textContent = proyecto.titulo;
            pdfIcon = document.getElementById('pdf-icon-inicio')
            pdfIcon.onclick = function() {
                            
                mostrarPDF(proyecto.ruta);  
            };

            const miembrosList = document.getElementById('miembrosProyectoInicio');
            miembrosList.innerHTML = ''; 
        
            if (proyecto.miembros && Array.isArray(proyecto.miembros)) {
                proyecto.miembros.forEach(miembro => {
                    const listItem = document.createElement('li');
                    listItem.textContent = miembro;
                    miembrosList.appendChild(listItem);
                });
            } else {
                const listItem = document.createElement('li');
                listItem.textContent = 'Miembros: No especificados';
                miembrosList.appendChild(listItem);
            }
        
        
        
            const modal = document.getElementById('modalProyectoInicio');
            modal.style.display = 'block';
        }
        
        //cerrar Modal Inicio
        function cerrarModalInicio() {
            const modal = document.getElementById('modalProyectoInicio');
            modal.style.display = 'none';
        }
        
        document.querySelector('.closeI').onclick = cerrarModalInicio;
        window.onclick = function(event) {
            const modal = document.getElementById('modalProyectoInicio');
            if (event.target == modal) {
                cerrarModalInicio();
            }
        }

// Listar proyectos pendientes 
function ListadoProyectosPendientes() {
    // Obtener el idioma guardado en localStorage
    const idiomaGuardado = (['es', 'en'].includes(localStorage.getItem('idioma'))) ? localStorage.getItem('idioma') : 'es';

    // Cargar las traducciones
    fetch('../assets/js/idiomas.json')
        .then(response => response.json())
        .then(traducciones => {
            // Hacer la solicitud de los proyectos pendientes
            fetch('../controllers/listadoSolicitudesProy.php') 
                .then(response => response.json())
                .then(data => {
                    const proyectosList = document.getElementById('proyectosPendientesList');
                    proyectosList.innerHTML = '';  

                    data.forEach(proyecto => {
                        const listItem = document.createElement('li');
                        listItem.className = 'proyecto-item';

                        const pdfIcon = document.createElement('img');
                        pdfIcon.src = '../assets/img/pdfimg.png';  
                        pdfIcon.className = 'pdf-icon';
                        listItem.appendChild(pdfIcon);

                        const proyectoInfo = document.createElement('div');
                        proyectoInfo.className = 'proyecto-info';

                        const proyectoTitulo = document.createElement('h3');
                        proyectoTitulo.textContent = proyecto.titulo;
                        proyectoInfo.appendChild(proyectoTitulo);

                        
                        const miembrosText = proyecto.miembros && Array.isArray(proyecto.miembros) 
                            ? `${traducciones[idiomaGuardado]['miembros']}: ${proyecto.miembros.join(', ')}` 
                            : `${traducciones[idiomaGuardado]['miembros']}: No especificados`;

                        const miembros = document.createElement('p');
                        miembros.textContent = miembrosText;
                        proyectoInfo.appendChild(miembros);

                        
                        const tagsText = proyecto.tags && Array.isArray(proyecto.tags) 
                            ? `${traducciones[idiomaGuardado]['tags']}: ${proyecto.tags.join(', ')}` 
                            : `${traducciones[idiomaGuardado]['tags']}: No especificados`;

                        const tags = document.createElement('p');
                        tags.textContent = tagsText;
                        proyectoInfo.appendChild(tags);

                        listItem.appendChild(proyectoInfo);

                        listItem.onclick = function() {
                            mostrarModal(proyecto);  
                        };

                        proyectosList.appendChild(listItem);
                    });

                    document.getElementById('proyectosPendientes').style.display = 'block';
                })
                .catch(error => console.error('Error al cargar los proyectos:', error));
        })
        .catch(error => console.error('Error al cargar las traducciones:', error));
}

    //Modal proyectos pendientes

        //MOstrar modal solicitudes pendientes

        
    
function mostrarModal(proyecto) {
   
    document.getElementById('nombreProyecto').textContent = proyecto.titulo;
    tagsProyectos = document.getElementById("tagsProyectos")
    pdfIcon = document.getElementById('pdf-icon')
    pdfIcon.onclick = function() {
                    
        mostrarPDF(proyecto.ruta);  
    };

    const miembrosList = document.getElementById('miembrosProyecto');
    miembrosList.innerHTML = ''; 

    if (proyecto.miembros && Array.isArray(proyecto.miembros)) {
        proyecto.miembros.forEach(miembro => {
            const listItem = document.createElement('li');
            listItem.textContent = miembro;
            miembrosList.appendChild(listItem);
        });
    } else {
        const listItem = document.createElement('li');
        listItem.textContent = 'Miembros: No especificados';
        miembrosList.appendChild(listItem);
    }

    const tagsText = proyecto.tags && Array.isArray(proyecto.tags) 
    ? ` ${proyecto.tags.join(', ')}` 
    : ' No especificados';

const tags = document.createElement('li');
tags.textContent = tagsText;
tagsProyectos.appendChild(tags);

//listItem.appendChild(tagsProyectos);

    

    const aprobarBtn = document.getElementById('aprobarBtn');
    const rechazarBtn = document.getElementById('rechazarBtn');


    aprobarBtn.onclick = null;
    rechazarBtn.onclick = null;

    aprobarBtn.onclick = function() {
        aceptarProyecto(proyecto.id);
        cerrarModal(); 
    };

    rechazarBtn.onclick = function() {
        denegarProyecto(proyecto.id); 
        cerrarModal(); 
    };

    const modal = document.getElementById('modalProyecto');
    modal.style.display = 'block';
}





        //Btn aceptar y denegar


        function aceptarProyecto(id) {
            fetch('../controllers/cambiarEstadoProyecto.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id: id, estado: 'aceptado' }) 
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Proyecto aceptado exitosamente');
                    ListadoProyectosPendientes(); 
                    ListadoProyectosAceptados();
                } else {
                    alert('Error al aceptar el proyecto');
                }
            })
            .catch(error => console.error('Error:', error));
        }
        
        function denegarProyecto(id) {
            fetch('../controllers/cambiarEstadoProyecto.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id: id, estado: 'denegado' })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Proyecto denegado exitosamente');
                    ListadoProyectosPendientes(); 
                } else {
                    alert('Error al denegar el proyecto');
                }
            })
            .catch(error => console.error('Error:', error));
        }
        
        
        //cerrar Modal Solicitudes
        function cerrarModal() {
            const modal = document.getElementById('modalProyecto');
            modal.style.display = 'none';
        }
        
        document.querySelector('.close').onclick = cerrarModal;
        window.onclick = function(event) {
            const modal = document.getElementById('modalProyecto');
            if (event.target == modal) {
                cerrarModal();
            }
        }

        
    // Funcion PDF
    function mostrarPDF(ruta) {
        const modalPDF = document.getElementById('modalPDF');
        const pdfFrame = document.getElementById('pdfFrame');
    
        pdfFrame.src = `../uploads/pdfs/${ruta}`;
        modalPDF.style.display = 'block';  
    }
    
    function cerrarModalPDF() {
        const modalPDF = document.getElementById('modalPDF');
        const pdfFrame = document.getElementById('pdfFrame');
    
        pdfFrame.src = ''; 
        modalPDF.style.display = 'none';  
    }
    
    


    
//menu
function abrirMenu() {
    const menuPerfil = document.getElementById('menuPerfil');
    if (esMovil()) {
        menuPerfil.classList.add('menu-abierto-movil');
        menuPerfil.classList.remove('menu-cerrado-movil');

        menuPerfil.classList.remove('menu-abierto-pc');
        menuPerfil.classList.remove('menu-cerrado-pc');
    } else {
        menuPerfil.classList.add('menu-abierto-pc');
        menuPerfil.classList.remove('menu-cerrado-pc');

        menuPerfil.classList.remove('menu-cerrado-movil');
        menuPerfil.classList.remove('menu-abierto-movil');
    }
}

function cerrarMenu() {
    const menuPerfil = document.getElementById('menuPerfil');
    if (esMovil()) {
        menuPerfil.classList.add('menu-cerrado-movil');
        menuPerfil.classList.remove('menu-abierto-movil');

        menuPerfil.classList.remove('menu-abierto-pc');
        menuPerfil.classList.remove('menu-cerrado-pc');
    } else {
        menuPerfil.classList.add('menu-cerrado-pc');
        menuPerfil.classList.remove('menu-abierto-pc');

        menuPerfil.classList.remove('menu-cerrado-movil');
        menuPerfil.classList.remove('menu-abierto-movil');
    }
}



document.getElementById('cerrarMenu').addEventListener('click', cerrarMenu);


document.getElementById('nav-btn').addEventListener('click', handleMenuState);

function handleMenuState() {
    const menuPerfil = document.getElementById('menuPerfil');
    
    
    if (esMovil()) {
        if (menuPerfil.classList.contains('menu-abierto-movil')) {
            cerrarMenu();  
        } else {
            abrirMenu();   
        }
    } else {
        if (menuPerfil.classList.contains('menu-abierto-pc')) {
            cerrarMenu();  
        } else {
            abrirMenu();   
        }
    }
}


document.getElementById('menu-img').addEventListener('click', abrirMenu);


function toggleMenu(menu) {
    const header = document.getElementById('header');
    const menuCTRLUsuario = document.getElementById('menuCTRLUsuario');
    const menuSolicitudProyectos = document.getElementById('menuSolicitudProyectos');

    header.style.display = 'none';
    menuCTRLUsuario.style.display = 'none';
    menuSolicitudProyectos.style.display = 'none';

    if (menu === 'controlUsuarios') {
        menuCTRLUsuario.style.display = 'block';
        
    cerrarMenu()
    } else if (menu === 'solicitudProyectos') {
        menuSolicitudProyectos.style.display = 'block';
        
        cerrarMenu()
    }  else if (menu === 'headerInicio') {
        header.style.display = 'flex';
        
    }

}

    document.addEventListener('DOMContentLoaded', () => {
        const navLinks = document.querySelectorAll('.nav-link');
    
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                navLinks.forEach(nav => nav.parentElement.classList.remove('active'));
    
                this.parentElement.classList.add('active');
            });
        });
    });
    
    //buscador

    
document.querySelector('.search-input').addEventListener('input', function() {
    const query = this.value.toLowerCase(); 
    const proyectos = document.querySelectorAll('.proyecto-item'); 

    proyectos.forEach(function(proyecto) {
        const titulo = proyecto.querySelector('h3').textContent.toLowerCase(); 
        const tags = proyecto.querySelector('h4').textContent.toLowerCase(); 
        const miembros = proyecto.querySelector('p').textContent.toLowerCase();
        

        
        if (titulo.includes(query) || miembros.includes(query) || tags.includes(query)) {
            proyecto.style.display = ''; 
        } else {
            proyecto.style.display = 'none'; 
        }
    });
});

const btnFilters = document.getElementById("btn-filters");
const tagsModal = document.querySelector('.tags-modal');
const overlay = document.querySelector('.overlay');
const closeModalBtn = document.querySelector('.close-btn');
const tagItems = document.querySelectorAll('.tag-item');
const searchInput = document.querySelector('.search-input');


btnFilters.addEventListener('click', function() {
    tagsModal.classList.add('show');
    overlay.classList.add('show');
});


closeModalBtn.addEventListener('click', function() {
    tagsModal.classList.remove('show');
    overlay.classList.remove('show');
});


overlay.addEventListener('click', function() {
    tagsModal.classList.remove('show');
    overlay.classList.remove('show');
});

tagItems.forEach(tag => {
    tag.addEventListener('click', function() {
    
        tagItems.forEach(item => item.classList.remove('selected'));

        const tagValue = tag.getAttribute('data-value');
        
    
        searchInput.value = tagValue;
        tag.classList.add('selected');

       
        searchInput.dispatchEvent(new Event('input'));
    });
});

// Función de búsqueda
document.querySelector('.search-input').addEventListener('input', function() {
    const query = this.value.toLowerCase(); 
    const proyectos = document.querySelectorAll('.proyecto-item'); 
    
    proyectos.forEach(function(proyecto) {
        const titulo = proyecto.querySelector('h3').textContent.toLowerCase(); 
        const tags = proyecto.querySelector('h4').textContent.toLowerCase(); 
        const miembros = proyecto.querySelector('p').textContent.toLowerCase();

    
        if (titulo.includes(query) || tags.includes(query) || miembros.includes(query)) {
            proyecto.style.display = ''; 
        } else {
            proyecto.style.display = 'none'; 
        }
    });
});

document.addEventListener('DOMContentLoaded', () => {
  
    document.getElementById('header').style.display = 'flex';
    document.getElementById('menuCTRLUsuario').style.display = 'none';
    document.getElementById('menuSolicitudProyectos').style.display = 'none';
    document.getElementById('userData').style.display = 'none';
    

    Listado('../controllers/listarEstudiante.php');
    ListadoProyectosPendientes();
    ListadoProyectosAceptados();

    
        window.onclick = function(event) {
            const modalProyectoInicio = document.getElementById('modalProyectoInicio');
            const modalProyecto = document.getElementById('modalProyecto');
            const modalPDF = document.getElementById("modalPDF");
           
    
            if (event.target == modalProyectoInicio) {
                cerrarModalInicio();
            }
            if (event.target == modalProyecto) {
                cerrarModal();
            }
            if (event.target == modalPDF) {
                cerrarModalPDF();
            }
        };
        document.addEventListener('click', function(event) {
            const menuPerfil = document.getElementById('menuPerfil');
            const navBtn = document.getElementById('nav-btn');
            const menuImg = document.getElementById("menu-img")
            
            if (!menuPerfil.contains(event.target) && !navBtn.contains(event.target) && !menuImg.contains(event.target)) {
                cerrarMenu(); 
            }
        });
   

});





function redirectToView(ruta, param) {
    const baseURL = '../controllers/viewController.php?param='+param;
    
    const url = new URL(baseURL, window.location.href);
    
    url.searchParams.append('ruta', ruta);

    window.location.href = url;
}

function deleteUser(userId) {
    console.log('Deleting user', userId);

    const idioma = localStorage.getItem('idioma') || 'es'; 
    const mensajes = {
        es: "¿Estás seguro de que deseas eliminar este usuario?",
        en: "Are you sure you want to delete this user?"
    };

    mostrarConfirmacion(mensajes[idioma], (confirmado) => {
        if (!confirmado) {
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
        .then(response => {
            if (!response.ok) {
               
                throw new Error('Error en la respuesta del servidor');
            }
            return response.json();
        })
        .then(data => {
       
            if (data.status === 'success') {
                mostrarNotificacion(idioma === 'es' ? "Usuario eliminado correctamente." : "User deleted successfully.", false);

                
            let rutaListado = '';

            
            console.log('Rol recibido:', data.rol);

            
            switch(data.rol.trim().toLowerCase()) {
                case 'alumno':
                    rutaListado = '../controllers/listarEstudiante.php';
                    break;
                case 'profesor':
                    rutaListado = '../controllers/listarProfesor.php';
                    break;
                case 'administrador':
                    rutaListado = '../controllers/listarAdministrador.php';
                    break;
                default:
                    console.error('Rol desconocido:', data.rol);
                    return;
            }

            
            Listado(rutaListado);
        

            } else {
                mostrarNotificacion(idioma === 'es' ? "Ocurrió un error durante la eliminación." : "An error occurred during deletion.", true);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            mostrarNotificacion(idioma === 'es' ? "Ocurrió un error durante la eliminación." : "An error occurred during deletion.", true); 
        });
    });
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

        if (data.length === 0) {
            const noUsersMessage = document.createElement('p');
            noUsersMessage.textContent = 'No hay usuarios para mostrar';
            noUsersMessage.className = 'noUsuarios'; 
            noUsersMessage.id="noUsuarios";
            userList.appendChild(noUsersMessage);
            const idiomaActual = localStorage.getItem('idioma') || 'es';
            aplicarTraduccion(idiomaActual);
        } else {

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
        }
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

function ListadoProyectosAceptados() {
    const idiomaGuardado = (['es', 'en'].includes(localStorage.getItem('idioma'))) ? localStorage.getItem('idioma') : 'es';

    Promise.all([
        fetch('../assets/js/idiomas.json').then(response => response.json()).catch(() => null),
        obtenerRolUsuario(),
        fetch('../controllers/listadoProyectosAceptados.php').then(response => response.json())
    ])
    .then(([traducciones, userRole, data]) => {
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
                ? `${traducciones ? traducciones[idiomaGuardado]['miembros'] : 'Miembros'}: ${proyecto.miembros.join(', ')}`
                : `${traducciones ? traducciones[idiomaGuardado]['miembros'] : 'Miembros'}: No especificados`;

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
                eliminarBtn.textContent = traducciones ? traducciones[idiomaGuardado]['eliminar'] : 'Eliminar';
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
    .catch(error => console.error('Error al cargar los proyectos o traducciones:', error));
}



function eliminarProyecto(proyectoId) {
    mostrarConfirmacion('¿Estás seguro de que deseas eliminar este proyecto?', (confirmado) => {
        if (!confirmado) {
            return; 
        }

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
                mostrarNotificacion(idioma === 'es' ? "Éxito" : "Success", false);

                ListadoProyectosAceptados();
            } else {
                mostrarNotificacion(idioma === 'es' ? "Algo salió mal" : "Something went wrong", true);

            }
        })
        .catch(error => console.error('Error al eliminar el proyecto:', error));
    });
}




    //Modales
        //Modal Inicio
        function mostrarModalInicio(proyecto) {
   
            document.getElementById('nombreProyectoInicio').textContent = proyecto.titulo;

            document.getElementById('descripcionProyecto').textContent = proyecto.descripcion || "Descripción no disponible";

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
  
    const idiomaGuardado = (['es', 'en'].includes(localStorage.getItem('idioma'))) ? localStorage.getItem('idioma') : 'es';

    fetch('../assets/js/idiomas.json')
        .then(response => response.json())
        .then(traducciones => {
         
            fetch('../controllers/listadoSolicitudesProy.php') 
                .then(response => response.json())
                .then(data => {
                    const proyectosList = document.getElementById('proyectosPendientesList');
                    proyectosList.innerHTML = '';  

            if (data.length === 0) {
                const noProjectMessage = document.createElement('p');
                noProjectMessage.textContent = 'No hay proyectos para mostrar';
                noProjectMessage.className = 'noUsuarios'; 
                noProjectMessage.id = "noProjectMessage";
                proyectosList.appendChild(noProjectMessage);
                const idiomaActual = localStorage.getItem('idioma') || 'es';
                aplicarTraduccion(idiomaActual);
            } else {

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
            }
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
            const tagsProyectos = document.getElementById("tagsProyectos");
            const pdfIcon = document.getElementById('pdf-icon');
        
            pdfIcon.onclick = function() {
                mostrarPDF(proyecto.ruta);  
            };
        
            document.getElementById('descripcionProyect').textContent = proyecto.descripcion || "Descripción no disponible";
        
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
    
            tagsProyectos.innerHTML = '';
 
            const tagsText = proyecto.tags && Array.isArray(proyecto.tags) 
                ? ` ${proyecto.tags.join(', ')}` 
                : ' No especificados';
        
            const tags = document.createElement('li');
            tags.textContent = tagsText;
            tagsProyectos.appendChild(tags);
        
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
                    mostrarNotificacion(idioma === 'es' ? "Proyecto aceptado exitosamente." : "Project accepted successfully.");

                    ListadoProyectosPendientes(); 
                    ListadoProyectosAceptados();
                } else {
                    mostrarNotificacion(idioma === 'es' ? "Error al aceptar el proyecto." : "Error accepting the project.", true);

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
                    mostrarNotificacion(idioma === 'es' ? "Proyecto denegado exitosamente." : "Project denied successfully.");

                    ListadoProyectosPendientes(); 
                } else {
                    mostrarNotificacion(idioma === 'es' ? "Error al denegar el proyecto." : "Error denying the project.", true);

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


document.getElementById('menu-img').addEventListener('click', handleMenuState);

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

    
    const btnFilters = document.getElementById("btn-filters");
    const tagsModal = document.querySelector('.tags-modal');
    const overlay = document.querySelector('.overlay');
    const closeModalBtn = document.querySelector('.close-btn');
    const tagItems = document.querySelectorAll('.tag-item');
    const searchInput = document.querySelector('.search-input');

document.querySelector('.search-input').addEventListener('input', function() {
    const query = this.value.toLowerCase(); 
    const proyectos = document.querySelectorAll('.proyecto-item'); 

    proyectos.forEach(function(proyecto) {
        const tituloElem = proyecto.querySelector('h3');
        const tagsElem = proyecto.querySelector('h4');
        const miembrosElem = proyecto.querySelector('p');

        const titulo = tituloElem ? tituloElem.textContent.toLowerCase() : '';
        const tags = tagsElem ? tagsElem.textContent.toLowerCase() : '';
        const miembros = miembrosElem ? miembrosElem.textContent.toLowerCase() : '';

        if (titulo.includes(query) || miembros.includes(query) || tags.includes(query)) {
            proyecto.style.display = ''; 
        } else {
            proyecto.style.display = 'none'; 
        }
    });
});




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




function mostrarNotificacion(mensaje, esError = false) {
    const idiomaGuardado = localStorage.getItem('idioma') || 'es';

    fetch('../assets/js/idiomas.json')
        .then(response => response.json())
        .then(traducciones => {
            const notificacion = document.createElement('div');
            notificacion.className = `notificacion ${esError ? 'error' : ''}`; 
            notificacion.textContent = mensaje;

            document.body.appendChild(notificacion);

            setTimeout(() => {
                notificacion.classList.add('mostrar');
            }, 10);

            setTimeout(() => {
                notificacion.classList.remove('mostrar');
                notificacion.addEventListener('transitionend', () => {
                    notificacion.remove();
                });
            }, 3000);
        })
        .catch(error => console.error('Error al cargar las traducciones:', error));
}

function mostrarConfirmacion(mensaje, callback) {
    const idiomaGuardado = localStorage.getItem('idioma') || 'es';

    fetch('../assets/js/idiomas.json')
        .then(response => response.json())
        .then(traducciones => {
            const modal = document.getElementById('confirmacionModal');
            const mensajeElement = document.getElementById('mensajeConfirmacion');
            const btnConfirmar = document.getElementById('btnConfirmar');
            const btnCancelar = document.getElementById('btnCancelar');

            mensajeElement.textContent = mensaje; 
            modal.style.display = 'flex';

            btnConfirmar.textContent = traducciones[idiomaGuardado]?.confirmar || 'Confirmar';
            btnCancelar.textContent = traducciones[idiomaGuardado]?.cancelar || 'Cancelar';

            btnConfirmar.onclick = () => {
                modal.style.display = 'none'; 
                callback(true); 
            };

            btnCancelar.onclick = () => {
                modal.style.display = 'none';
                callback(false);
            };
        })
        .catch(error => console.error('Error al cargar las traducciones:', error));
}

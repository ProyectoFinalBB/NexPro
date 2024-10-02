
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

 
    if (!confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
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
function ListadoProyectosPendientes() {
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
                    ? `Miembros: ${proyecto.miembros.join(', ')}` 
                    : 'Miembros: No especificados';

                const miembros = document.createElement('p');
                miembros.textContent = miembrosText;
                proyectoInfo.appendChild(miembros);

                listItem.appendChild(proyectoInfo);

                listItem.onclick = function() {
                    mostrarModal(proyecto);  
                };

                proyectosList.appendChild(listItem);
            });

            document.getElementById('proyectosPendientes').style.display = 'block';
        })
        .catch(error => console.error('Error al cargar los proyectos:', error));
}


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


function ListadoProyectosAceptados() {
    fetch('../controllers/listadoProyectosAceptados.php')
    .then(response => response.json())
    .then(data => {
        const proyectosList = document.getElementById('proyectosAceptadosList');
        proyectosList.innerHTML = ''; // Limpiar la lista antes de agregar los proyectos

        data.forEach(proyecto => {
            const listItem = document.createElement('li'); // Crear un elemento de lista

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

                listItem.appendChild(proyectoInfo);

                listItem.onclick = function() {
                    mostrarModalInicio(proyecto);  
                };

                proyectosList.appendChild(listItem);
            });

            document.getElementById('proyectosAceptadosList').style.display = 'block';
        })
        .catch(error => console.error('Error al cargar los proyectos:', error));
}
/*

function mostrarModal(proyecto) {
   
    document.getElementById('nombreProyecto').textContent = proyecto.titulo;

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


function mostrarModalInicio(proyecto) {
   
    document.getElementById('nombreProyectoInicio').textContent = proyecto.titulo;

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


*/

// Función para mostrar cualquier modal de proyecto
function mostrarModal(proyecto, modalId, nombreId, miembrosId, aprobarBtnId, rechazarBtnId) {
    // Asignar el título del proyecto
    document.getElementById(nombreId).textContent = proyecto.titulo;

    // Limpiar y llenar la lista de miembros
    const miembrosList = document.getElementById(miembrosId);
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

    // Botones de aprobar y rechazar
    const aprobarBtn = document.getElementById(aprobarBtnId);
    const rechazarBtn = document.getElementById(rechazarBtnId);

    // Limpiar eventos previos de los botones
    aprobarBtn.onclick = null;
    rechazarBtn.onclick = null;

    // Asignar acciones a los botones
    aprobarBtn.onclick = function() {
        aceptarProyecto(proyecto.id);
        cerrarModal(modalId);
    };

    rechazarBtn.onclick = function() {
        denegarProyecto(proyecto.id);
        cerrarModal(modalId);
    };

    // Mostrar el modal
    const modal = document.getElementById(modalId);
    modal.style.display = 'block';
}

// Función para cerrar cualquier modal
function cerrarModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.style.display = 'none';
}

// Asignar eventos a los botones de cerrar
function asignarEventosCerrar(modalId, closeClass) {
    document.querySelector(`.${closeClass}`).onclick = function() {
        cerrarModal(modalId);
    };

    // Cerrar modal al hacer clic fuera de él
    window.onclick = function(event) {
        const modal = document.getElementById(modalId);
        if (event.target === modal) {
            cerrarModal(modalId);
        }
    };
}

// Asignar eventos de cierre para ambos modales
asignarEventosCerrar('modalProyecto', 'close');
asignarEventosCerrar('modalProyectoInicio', 'closeI');






function confirmarEliminacion() {
    return confirm("¿Estás seguro de que deseas eliminar este usuario?");
}
function confirmarModificación() {
    return confirm("¿Estás seguro de que deseas modificar este usuario?");
}
function esMovil() {
    return window.innerWidth <= 768; 
}

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
document.getElementById('nav-btn').addEventListener('click', abrirMenu);
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
    } else if (menu === 'solicitudProyectos') {
        menuSolicitudProyectos.style.display = 'block';
    }  else if (menu === 'headerInicio') {
        header.style.display = 'flex';
    }

    document.getElementById('menuPerfil').style.display = 'none';
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
    
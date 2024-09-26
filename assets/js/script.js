
   document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('header').style.display = 'flex';
    document.getElementById('menuCTRLUsuario').style.display = 'none';
    document.getElementById('menuSolicitudProyectos').style.display = 'none';
    document.getElementById('userData').style.display = 'none'; 
    Listado('../controllers/listarEstudiante.php')



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
            proyectosList.innerHTML = ''; // Limpiar la lista antes de agregar los proyectos

            data.forEach(proyecto => {
                const listItem = document.createElement('li'); // Crear un elemento de lista

                const proyectoInfo = document.createElement('span');
                proyectoInfo.textContent = `${proyecto.titulo} - ${proyecto.descripcion}`;
                proyectoInfo.className = 'proyecto-info';
                listItem.appendChild(proyectoInfo);

                const aceptarBtn = document.createElement('button');
                aceptarBtn.textContent = 'Aceptar';
                aceptarBtn.className = 'aceptar-btn';
                aceptarBtn.onclick = function () {
                    // Aquí puedes manejar el evento para aceptar el proyecto
                    aceptarProyecto(proyecto.id);
                };
                listItem.appendChild(aceptarBtn);

                const denegarBtn = document.createElement('button');
                denegarBtn.textContent = 'Denegar';
                denegarBtn.className = 'denegar-btn';
                denegarBtn.onclick = function () {
                    // Aquí puedes manejar el evento para denegar el proyecto
                    denegarProyecto(proyecto.id);
                };
                listItem.appendChild(denegarBtn);

                proyectosList.appendChild(listItem);
            });

            document.getElementById('proyectosPendientes').style.display = 'block';
        })
        .catch(error => console.error('Error al cargar los proyectos:', error));
}


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
    
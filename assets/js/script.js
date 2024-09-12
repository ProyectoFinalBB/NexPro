
   // Iniciar con el header visible y el menú de control de usuarios oculto
   document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('header').style.display = 'flex';
    document.getElementById('menuCTRLUsuario').style.display = 'none';
});

document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('userData').style.display = 'none'; // Si tienes un elemento con ID 'userData'
});


function redirectToView(ruta, param) {
    const baseURL = '../controllers/viewController.php?param='+param;
    
    const url = new URL(baseURL, window.location.href);
    
    url.searchParams.append('ruta', ruta);

    window.location.href = url;
}

function editUser(userId) {
    console.log('Editing user', userId);
    
}

function deleteUser(userId) {
    console.log('Deleting user', userId);

    // Llamamos a la función de confirmación y verificamos la respuesta
    if (!confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
        return; // Si el usuario no confirma, detenemos la ejecución
    }
    
    var datos = {
        userId: userId,
        eliminarUsr: "eliminarUsr"
    };

    fetch('../controllers/eliminarUsuario.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json' // Indicar que los datos son JSON
        },
        body: JSON.stringify(datos) // Convertir el objeto de datos a JSON
    })
    .then(response => response.json()) // Procesar la respuesta del servidor como JSON
    .then(data => {
        // Mostrar el mensaje de resultado en la página
        console.log(data.message); // También podemos verlo en la consola para depuración
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
        userList.innerHTML = ''; // Limpiar cualquier contenido previo

        // Mostrar cada usuario en una lista con iconos y botones
        data.forEach(user => {
            const listItem = document.createElement('div');
            listItem.className = 'user-item';

            // Icono de usuario
            const icon = document.createElement('span');
            icon.className = 'fa fa-user-circle icon';
            listItem.appendChild(icon);

            // Información del usuario
            const userInfo = document.createElement('span');
            userInfo.textContent = `${user.nombrecompleto} - ${user.ci}`;
            userInfo.className = 'user-info';
            listItem.appendChild(userInfo);

            // Icono de editar
            const editIcon = document.createElement('span');
            editIcon.className = 'fa fa-pencil-alt icon';
            editIcon.onclick = function () {  redirectToView("../views/modificarUsuario.php", user.id_usr);         
            };
            listItem.appendChild(editIcon);

            // Icono de eliminar
            const deleteIcon = document.createElement('span');
            deleteIcon.className = 'fa fa-trash icon';
            deleteIcon.onclick = function () { deleteUser(user.id_usr); };
            listItem.appendChild(deleteIcon);

            // Añadir al listado principal
            userList.appendChild(listItem);
        });

        // Mostrar el contenedor de los datos
        document.getElementById('userData').style.display = 'block';
    })
    .catch(error => console.error('Error:', error));
}

function confirmarEliminacion() {
    return confirm("¿Estás seguro de que deseas eliminar este usuario?");
}
function confirmarModificación() {
    return confirm("¿Estás seguro de que deseas modificar este usuario?");
}
document.getElementById('cerrarMenu').addEventListener('click', function() {
    document.getElementById('menuPerfil').style.display = 'none';
});

 document.getElementById('nav-btn').addEventListener('click', function() {
    document.getElementById('menuPerfil').style.display = 'block';
});

    function toggleMenu() {
        const header = document.getElementById('header');
        const menuCTRLUsuario = document.getElementById('menuCTRLUsuario');
    
        // Alternar la visibilidad del header y el menú de control de usuarios
        if (header.style.display === 'none') {
            header.style.display = 'flex';
            menuCTRLUsuario.style.display = 'none';
        } else {
            header.style.display = 'none';
            menuCTRLUsuario.style.display = 'block';
        }
        document.getElementById('menuPerfil').style.display = 'none';
    }

    document.addEventListener('DOMContentLoaded', () => {
        // Obtener todos los enlaces del menú de navegación
        const navLinks = document.querySelectorAll('.nav-link');
    
        // Agregar un evento de clic a cada enlace de la navegación
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                // Remover la clase 'active' de todos los elementos
                navLinks.forEach(nav => nav.parentElement.classList.remove('active'));
    
                // Agregar la clase 'active' al elemento clicado
                this.parentElement.classList.add('active');
            });
        });
    });
    
 // Función para obtener el parámetro "param" de la URL
 function getParameterByName(name) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name); // Retorna el valor del parámetro
}

// Obtener el valor del parámetro "param" en la URL
const param = getParameterByName('param');

// Verificar si existe el parámetro antes de llamar a la función
if (param) {
    // Llamar a la función modificarUsrCampos con el valor del parámetro
    modificarUsrCampos(param);
} else {
    console.log('El parámetro "param" no se encuentra en la URL.');
}


function modificarUsrCampos(usr_id) {
    usr_id = parseInt(usr_id, 10)
    // Usar fetch para enviar los datos al servidor
    fetch('../controllers/userDataById.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json' // Indicar que los datos son JSON
        },
        body: JSON.stringify({ userId: usr_id }) // Enviar el ID del usuario como JSON
    })
    .then(response => response.json()) // Procesar la respuesta del servidor como JSON
    .then(data => {
        if (data.error) {
            console.error(data.error);
            document.getElementById("mensajeResultado").innerText = "Error en la consulta de usuario.";
            return;
        }

        let nombrecompleto = data.nombrecompleto; // Esto viene de la BD

// Dividimos el nombre completo usando el espacio como separador
let partes = nombrecompleto.split(' ');

// Variables para almacenar nombre y apellidos
let nombre = '';
let apellido = '';

// Verificar si la persona tiene 3 o 4 partes en su nombre completo
if (partes.length === 3) {
    // Caso con 1 nombre y 2 apellidos
    nombre = partes[0]; // Primer elemento es el nombre
    apellido = partes.slice(1).join(' '); // Los dos últimos elementos son los apellidos
} else if (partes.length === 4) {
    // Caso con 2 nombres y 2 apellidos
    nombre = partes.slice(0, 2).join(' '); // Los dos primeros elementos son los nombres
    apellido = partes.slice(2).join(' ');  // Los dos últimos son los apellidos
} else {
    console.error("Formato de nombre no esperado");
}

// Asignamos los valores a los campos correspondientes
document.getElementById("inNames").value = nombre;
document.getElementById("inLastname").value = apellido;


        // Asignar los valores obtenidos del JSON a los campos del formulario
        document.getElementById("user-info").innerText = data.nombrecompleto;

        document.getElementById("inCedula").value = data.ci;
        document.getElementById("inRol").value = data.rol;
        console.log(data.rol);

        // Asignar la imagen de perfil si tienes la URL
       // document.getElementById("profile-image").src = data.profile_image_url || '../assets/img/default-avatar.png'; // Si no hay imagen, mostrar una por defecto

        console.log(data); // Verificar los datos recibidos en la consola
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById("mensajeResultado").innerText = "Ocurrió un error durante el registro.";
    });
}
console.log("tamo activo")

function guardarCambios(id) {

console.log(id = parseInt(id));

    // Capturar los valores del formulario
    const nombre = document.getElementById("inNames").value;
    const apellido = document.getElementById("inLastname").value;
    const ci = document.getElementById("inCedula").value;
    const rol = document.getElementById("inRol").value;

    // Validar si los campos están completos
    if (!nombre || !apellido || !ci || !rol || !id) {
        document.getElementById("mensajeResultado").innerText = "Todos los campos son obligatorios.";
        return;
    }

    // Crear un objeto con los datos del formulario
    const datos = {
        id_usr: id,
        nombre: nombre,
        apellido: apellido,
        ci: ci,
        rol: rol
    };
    console.log(datos)

    
    // Usar fetch para enviar los datos al servidor
    fetch('../controllers/modificarUsuario.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json' // Indicar que los datos son JSON
        },
        body: JSON.stringify(datos) // Convertir el objeto de datos a JSON
    })
    .then(response => response.text()) // Procesar la respuesta del servidor como texto
    .then(data => {
        document.getElementById("mensajeResultado").innerText = data;
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById("mensajeResultado").innerText = "Ocurrió un error durante el registro.";
    });
}

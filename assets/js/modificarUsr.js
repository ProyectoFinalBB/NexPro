
 function getParameterByName(name) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name); 
}

const param = getParameterByName('param');

if (param) {
    modificarUsrCampos(param);
} else {
    console.log('El parámetro "param" no se encuentra en la URL.');
}


function modificarUsrCampos(usr_id) {
    usr_id = parseInt(usr_id, 10)
    fetch('../controllers/userDataById.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json' 
        },
        body: JSON.stringify({ userId: usr_id }) 
    })
    .then(response => response.json()) 
    .then(data => {
        if (data.error) {
            console.error(data.error);
            document.getElementById("mensajeResultado").innerText = "Error en la consulta de usuario.";
            return;
        }

        let nombrecompleto = data.nombrecompleto; 


let partes = nombrecompleto.split(' ');


let nombre = '';
let apellido = '';

if (partes.length === 3) {
    nombre = partes[0]; 
    apellido = partes.slice(1).join(' '); 
} else if (partes.length === 4) {
    nombre = partes.slice(0, 2).join(' '); 
    apellido = partes.slice(2).join(' ');  
} else {
    console.error("Formato de nombre no esperado");
}

document.getElementById("inNames").value = nombre;
document.getElementById("inLastname").value = apellido;
        document.getElementById("user-info").innerText = data.nombrecompleto;

        if (data.ruta_img && data.ruta_img !== null) {
            document.getElementById('fotoUsrEdit').src = data.ruta_img;
        } else {
            document.getElementById('fotoUsrEdit').src = "../assets/img/sinImg.jpg";
        }
        

        
        document.getElementById("inCedula").value = data.ci;
        document.getElementById("inRol").value = data.rol;
        console.log(data.rol);

        // Asignar la imagen de perfil 
    
        console.log(data);
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById("mensajeResultado").innerText = "Ocurrió un error durante el registro.";
    });
}
console.log("tamo activo")

function guardarCambios(id) {

console.log(id = parseInt(id));


    const nombre = document.getElementById("inNames").value;
    const apellido = document.getElementById("inLastname").value;
    const ci = document.getElementById("inCedula").value;
    const rol = document.getElementById("inRol").value;

  
    if (!nombre || !apellido || !ci || !rol || !id) {
        document.getElementById("mensajeResultado").innerText = "Todos los campos son obligatorios.";
        return;
    }

   
    const datos = {
        id_usr: id,
        nombre: nombre,
        apellido: apellido,
        ci: ci,
        rol: rol
    };
    console.log(datos)

    
    fetch('../controllers/modificarUsuario.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json' 
        },
        body: JSON.stringify(datos) 
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById("mensajeResultado").innerText = data;
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById("mensajeResultado").innerText = "Ocurrió un error durante el registro.";
    });
}

function restablecerContrasenia(id_usr) {
    
    if (confirm('¿Estás seguro de que deseas restablecer la contraseña a la cédula?')) {
        fetch('../controllers/restablecerContrasenia.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                id_usr: id_usr, 
                restablecerContrasenia: true
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert('La contraseña ha sido restablecida correctamente.');
            } else {
                alert('Error al restablecer la contraseña: ' + data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    }
}

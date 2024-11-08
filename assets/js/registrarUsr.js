
function registrarUsuario() {
    event.preventDefault();


    var nombre = document.getElementById("nombreUsrRegistro").value;
    var apellido = document.getElementById("apellidoUsrRegistro").value;
    var ci = document.getElementById("ciUsrRegistro").value;
    var rol = document.getElementById("rolRegistro").value;


    var datos = {
        nombreUsrRegistro: nombre,
        apellidoUsrRegistro: apellido,
        ciUsrRegistro: ci,
        rolRegistro: rol,
        registrarUsr: "registrarUsr"
    };


     nombrecompleto = nombre + " " + apellido;

     partes = nombrecompleto.split(' ');

    if (partes.length <= 2 || partes.length >= 6) {
        document.getElementById("mensajeResultado").innerText = "Debe ingresar 1 o 2 nombres y 2 apellidos";
    } else {
       
console.log(partes)
    fetch('../controllers/registroUsuario.php', {
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
}


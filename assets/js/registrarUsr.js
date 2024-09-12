
function registrarUsuario() {
    // Prevenir que el formulario se envíe de manera tradicional
    event.preventDefault();

    // Capturar los datos del formulario
    var nombre = document.getElementById("nombreUsrRegistro").value;
    var apellido = document.getElementById("apellidoUsrRegistro").value;
    var ci = document.getElementById("ciUsrRegistro").value;
    var rol = document.getElementById("rolRegistro").value;

    // Crear un objeto con los datos
    var datos = {
        nombreUsrRegistro: nombre,
        apellidoUsrRegistro: apellido,
        ciUsrRegistro: ci,
        rolRegistro: rol,
        registrarUsr: "registrarUsr"
    };

    // Usar fetch para enviar los datos al servidor
    fetch('../controllers/registroUsuario.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json' // Indicar que los datos son JSON
        },
        body: JSON.stringify(datos) // Convertir el objeto de datos a JSON
    })
    .then(response => response.text()) // Procesar la respuesta del servidor como texto
    .then(data => {
        // Mostrar el mensaje de resultado en la página
        document.getElementById("mensajeResultado").innerText = data;
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById("mensajeResultado").innerText = "Ocurrió un error durante el registro.";
    });
}

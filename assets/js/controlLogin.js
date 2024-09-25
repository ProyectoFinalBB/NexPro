function enviarLogin() {
    const ci = document.getElementById('ci').value;
    const contrasenia = document.getElementById('contrasenia').value;

    // Crear el objeto que se enviará al servidor
    const datosLogin = { ci: ci, contrasenia: contrasenia };

    // Mostrar los datos enviados en la consola para verificar
    console.log("Datos enviados:", datosLogin);

    fetch('../controllers/controlLogin.php', {
        method: 'POST', // Aseguramos que es un POST
        headers: {
            'Content-Type': 'application/json' // Especificar que enviamos JSON
        },
        body: JSON.stringify(datosLogin) // Convertir los datos a formato JSON
    })
    .then(response => {
        console.log("Estado de la respuesta:", response.status); // Verificar el estado HTTP
        return response.json(); // Convertir la respuesta a JSON
    })
    .then(data => {
        console.log("Respuesta del servidor:", data); // Verificar la respuesta recibida del servidor
        if (data.success) {
            window.location.href = '../public/index.php'; // Redirigir si el login es exitoso
        } else {
            document.getElementById('mensajeResultado').innerText = data.message; // Mostrar error si existe
        }
    })
    .catch(error => {
        console.error('Error en la solicitud:', error);
        document.getElementById('mensajeResultado').innerText = 'Error durante el inicio de sesión.';
    });
}

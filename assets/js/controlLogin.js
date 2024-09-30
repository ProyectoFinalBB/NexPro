function enviarLogin() {
    const ci = document.getElementById('ci').value;
    const contrasenia = document.getElementById('contrasenia').value;

    const datosLogin = { ci: ci, contrasenia: contrasenia };

    fetch('../controllers/controlLogin.php', {
        method: 'POST', 
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(datosLogin) 
    })
    .then(response => {
        console.log("Estado de la respuesta:", response.status); 
        return response.json(); 
    })
    .then(data => {
        console.log("Respuesta del servidor:", data); 
        if (data.success) {
            window.location.href = '../public/index.php';
        } else {
            document.getElementById('mensajeResultado').innerText = data.message; 
        }
    })
    .catch(error => {
        console.error('Error en la solicitud:', error);
        document.getElementById('mensajeResultado').innerText = 'Error durante el inicio de sesión.';
    });
}

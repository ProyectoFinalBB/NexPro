function cambiarContraseña () {
    event.preventDefault();
ci = document.getElementById("ci").value;
oldPass = document.getElementById("olderPass").value;
newPass = document.getElementById("newPass").value;
newPass2 = document.getElementById("newPass2").value;

mensajeResultado = document.getElementById("mensajeResultado");
if (newPass.length < 8 || newPass.length > 16) {
    mensajeResultado.innerText = "La contraseña debe tener entre 8 y 16 caracteres.";
    return; 
}


if (newPass == newPass2) {
var datos = {
    ci: ci,
    oldPass: oldPass,
    newPass: newPass,
    newPass2: newPass2,
    changePass: "changePass" 
};
fetch('../controllers/cambiarContraseña.php', {
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
    document.getElementById("mensajeResultado").innerText = "Ocurrió un error durante el cambio.";
});
} else {
mensajeResultado.innerText = "Las nuevas contraseñas no coinciden";
}

}
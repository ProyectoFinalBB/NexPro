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

function redirectToView(ruta) {
    const baseURL = '../controllers/viewController.php';
    
    const url = new URL(baseURL, window.location.href);
    
    url.searchParams.append('ruta', ruta);

    window.location.href = url;
}

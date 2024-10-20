function aplicarTraduccion(idioma) { 
    fetch('../assets/js/idiomas.json')
        .then(response => response.json())
        .then(traducciones => {
            // Recorrer los elementos con IDs y cambiar el texto
            document.getElementById('miPerfil').textContent = traducciones[idioma]['miPerfil'];
            if (document.getElementById('subirProyectoBtn')) {
                document.getElementById('subirProyectoBtn').textContent = traducciones[idioma]['subirProyectoBtn'];
            }
            document.getElementById('temaOscuroTexto').textContent = traducciones[idioma]['temaOscuroTexto'];
            document.getElementById('inglesTexto').textContent = traducciones[idioma]['inglesTexto'];
            document.getElementById('cerrarSesionBtn').textContent = traducciones[idioma]['cerrarSesionBtn'];
            document.getElementById('filtrosBtn').textContent = traducciones[idioma]['filtrosBtn'];
            document.getElementById('buscarInput').setAttribute('placeholder', traducciones[idioma]['buscarInput']);

            // Opcionales para administrador
            if (document.getElementById('controlUsuariosBtn')) {
                document.getElementById('controlUsuariosBtn').textContent = traducciones[idioma]['controlUsuariosBtn'];
            }
            if (document.getElementById('solicitudesProyectosBtn')) {
                document.getElementById('solicitudesProyectosBtn').textContent = traducciones[idioma]['solicitudesProyectosBtn'];
            }
            document.getElementById('navEstudiantes').textContent = traducciones[idioma]['navEstudiantes'];
            document.getElementById('navProfesores').textContent = traducciones[idioma]['navProfesores'];
            document.getElementById('navAdministrador').textContent = traducciones[idioma]['navAdministrador'];
            document.getElementById('controlUsuariosTitulo').textContent = traducciones[idioma]['controlUsuariosTitulo'];
            document.getElementById('solicitudesProyectosTitulo').textContent = traducciones[idioma]['solicitudesProyectosTitulo'];

            // Nuevos elementos para registrarUsuario.php
            document.getElementById('headerTitle').textContent = traducciones[idioma]['headerTitle'];
            document.getElementById('tituloRegistro').textContent = traducciones[idioma]['tituloRegistro'];
            document.getElementById('nombreUsrRegistro').setAttribute('placeholder', traducciones[idioma]['nombresLabel']);
            document.getElementById('apellidoUsrRegistro').setAttribute('placeholder', traducciones[idioma]['apellidosLabel']);
            document.getElementById('ciUsrRegistro').setAttribute('placeholder', traducciones[idioma]['cedulaLabel']);
            document.getElementById('rolLabel').textContent = traducciones[idioma]['rolLabel'];
            document.getElementById('registrarUsrBtn').textContent = traducciones[idioma]['registrarUsrBtn'];
        })
        .catch(error => console.error('Error cargando el archivo de traducciones:', error));
}

// Detectar el cambio de idioma (checkbox de inglés)
document.getElementById('ingles').addEventListener('change', function () {
    const idiomaSeleccionado = this.checked ? 'en' : 'es';
    localStorage.setItem('idioma', idiomaSeleccionado); // Guardar en caché
    aplicarTraduccion(idiomaSeleccionado);
}); 

// Cargar el idioma seleccionado al cargar la página
document.addEventListener('DOMContentLoaded', () => {
    const idiomaGuardado = localStorage.getItem('idioma') || 'es'; // Español por defecto
    document.getElementById('ingles').checked = (idiomaGuardado === 'en');
    aplicarTraduccion(idiomaGuardado);
});

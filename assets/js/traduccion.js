function aplicarTraduccion(idioma) { 
    fetch('../assets/js/idiomas.json')
        .then(response => response.json())
        .then(traducciones => {
            const elementos = {
                'miPerfil': 'miPerfil',
                'subirProyectoBtn': 'subirProyectoBtn',
                'temaOscuroTexto': 'temaOscuroTexto',
                'inglesTexto': 'inglesTexto',
                'cerrarSesionBtn': 'cerrarSesionBtn',
                'filtrosBtn': 'filtrosBtn',
                'buscarInput': 'buscarInput',
                'controlUsuariosBtn': 'controlUsuariosBtn',
                'solicitudesProyectosBtn': 'solicitudesProyectosBtn',
                'navEstudiantes': 'navEstudiantes',
                'navProfesores': 'navProfesores',
                'navAdministrador': 'navAdministrador',
                'controlUsuariosTitulo': 'controlUsuariosTitulo',
                'solicitudesProyectosTitulo': 'solicitudesProyectosTitulo',
                'tituloRegistro': 'tituloRegistro',
                'nombreUsrRegistro': 'nombresLabel',
                'apellidoUsrRegistro': 'apellidosLabel',
                'ciUsrRegistro': 'cedulaLabel',
                'rolLabel': 'rolLabel',
                'registrarUsrBtn': 'registrarUsrBtn',
                'tituloPantalla': 'tituloPantalla',
                'inNames': 'inNames',
                'inLastname': 'inLastname',
                'inCedula': 'inCedula',
                'rolEstudiante': 'rolEstudiante',
                'rolProfesor': 'rolProfesor',
                'rolAdministrador': 'rolAdministrador',
                'btnGuardarCambios': 'btnGuardarCambios',
                'tituloSubirProyecto': 'tituloSubirProyecto',
                'nombreProyecto': 'nombreProyecto',
                'descProyecto': 'descProyecto',
                'labelTagsProyecto': 'labelTagsProyecto',
                'opcionFinanzas': 'opcionFinanzas',
                'opcionMarketing': 'opcionMarketing',
                'opcionCiencia': 'opcionCiencia',
                'opcionTecnologia': 'opcionTecnologia',
                'opcionProgramacion': 'opcionProgramacion',
                'opcionInvestigacion': 'opcionInvestigacion',
                'opcionCiberSeguridad': 'opcionCiberSeguridad',
                'opcionVideojuegos': 'opcionVideojuegos',
                'opcionEducacion': 'opcionEducacion',
                'opcionEntretenimiento': 'opcionEntretenimiento',
                'opcionMediosComunicacion': 'opcionMediosComunicacion',
                'opcionRedesSociales': 'opcionRedesSociales',
                'opcionPolitica': 'opcionPolitica',
                'opcionSalud': 'opcionSalud',
                'opcionNutricion': 'opcionNutricion',
                'opcionDeportes': 'opcionDeportes',
                'opcionGastronomia': 'opcionGastronomia',
                'opcionTransporte': 'opcionTransporte',
                'opcionMedioAmbiente': 'opcionMedioAmbiente',
                'opcionAnimales': 'opcionAnimales',
                'archivoProyecto': 'archivoProyecto',
                'integrantesProyecto': 'integrantesProyecto',
                'solicitarRevisionBtn': 'solicitarRevisionBtn'
            };

            
            Object.keys(elementos).forEach(id => {
                const elem = document.getElementById(id);
                if (elem) {
                    const valorTraduccion = elementos[id];
                    if (elem.tagName === 'INPUT') {
                        elem.placeholder = traducciones[idioma][valorTraduccion];
                    } else {
                        elem.textContent = traducciones[idioma][valorTraduccion];
                    }
                }
            });
        })
        .catch(error => console.error('Error cargando el archivo de traducciones:', error));
}


const checkboxIngles = document.getElementById('ingles');
if (checkboxIngles) {
    checkboxIngles.addEventListener('change', function () {
        const idiomaSeleccionado = this.checked ? 'en' : 'es';
        localStorage.setItem('idioma', idiomaSeleccionado); 
        aplicarTraduccion(idiomaSeleccionado);
    });
}


document.addEventListener('DOMContentLoaded', () => {
    const idiomaGuardado = (['es', 'en'].includes(localStorage.getItem('idioma'))) ? localStorage.getItem('idioma') : 'es';
  
    if (checkboxIngles) {
        checkboxIngles.checked = (idiomaGuardado === 'en');
    }
    aplicarTraduccion(idiomaGuardado);
});

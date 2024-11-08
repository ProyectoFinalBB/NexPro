function aplicarTraduccion(idioma) { 
    fetch('../assets/js/idiomas.json')
        .then(response => response.json())
        .then(traducciones => {
            const elementos = {
            
                'miPerfil': 'miPerfil',
                'subirProyectoBtn': 'subirProyectoBtn',
                'temaOscuroTexto': 'temaOscuroTexto',
                'inglesTexto': 'inglesTexto',
                'cerrarSesionBtn1': 'cerrarSesionBtn',
                'cerrarSesionBtn2': 'cerrarSesionBtn',
                'cerrarSesionBtn3': 'cerrarSesionBtn',
                'btn-filters': 'btn-filters',
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
                "descProyectoLabel" : "descProyectoLabel",
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
                'solicitarRevisionBtn': 'solicitarRevisionBtn',
                'miembros': 'miembros',
                'tags': 'tags',
                'miembrosInicioLabel': 'miembrosInicioLabel',
                'modalProyectoInicioTitulo': 'modalProyectoInicioTitulo',
                'nombreProyectoInicioLabel': 'nombreProyectoInicioLabel',
                'nombreProyectoLabel': 'nombreProyectoLabel',
                'miembrosLabel': 'miembrosLabel',
                'modalProyectoTitulo': 'modalProyectoTitulo',
                'aprobarBtn': 'aprobarBtn',
                'rechazarBtn': 'rechazarBtn',
                "rolLabel": "rolLabel",
                "resetPass": "resetPass",
                "noUsuarios":"noUsuarios",
                "noProjectMessage" : "noProjectMessage",
                "TagsSeleccionados":"TagsSeleccionados"
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

            const logoFrase = document.getElementById("logoFrase");
            if (logoFrase) {
                if (idioma === 'en') {
                    logoFrase.src = '../assets/img/estudiar.png';
                } else {
                    logoFrase.src = '../assets/img/frases.png';
                }
            }
        })
        .catch(error => console.error('Error cargando el archivo de traducciones:', error));
}




const checkboxIngles = document.getElementById('ingles');
if (checkboxIngles) {
    checkboxIngles.addEventListener('change', function () {
        const idiomaSeleccionado = this.checked ? 'en' : 'es';
        localStorage.setItem('idioma', idiomaSeleccionado); 
        aplicarTraduccion(idiomaSeleccionado);
        ListadoProyectosPendientes();
        ListadoProyectosAceptados();
    });
}


document.addEventListener('DOMContentLoaded', () => {
    const idiomaGuardado = (['es', 'en'].includes(localStorage.getItem('idioma'))) ? localStorage.getItem('idioma') : 'es';
  
    if (checkboxIngles) {
        checkboxIngles.checked = (idiomaGuardado === 'en');
    }
    aplicarTraduccion(idiomaGuardado);

});

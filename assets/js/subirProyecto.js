function enviarProyecto(event) {
    event.preventDefault(); 

  
    var nombreProyecto = document.getElementById("nombreProyecto").value;
    var descProyecto = document.getElementById("descProyecto").value;
    var archivoProyecto = document.getElementById("archivoProyecto").files[0];
    
 
    var integrantes = Array.from(document.querySelectorAll('input[name="integrantesIDs[]"]')).map(input => input.value);
    
    
    var tagsProyecto = Array.from(document.getElementById('tagsProyecto').selectedOptions).map(option => option.value);

    if (tagsProyecto.length === 0) {
        document.getElementById("mensajeResultado").innerText = "Por favor, selecciona al menos un tag para el proyecto.";
        return; 
    }
  
    var formData = new FormData();
    formData.append('nombreProyecto', nombreProyecto);
    formData.append('descProyecto', descProyecto);
    formData.append('archivoProyecto', archivoProyecto); 
    formData.append('integrantesIDs', JSON.stringify(integrantes));  
    formData.append('tagsProyecto', JSON.stringify(tagsProyecto)); 

   
    fetch('../controllers/subirProyecto.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text()) 
    .then(data => {
        document.getElementById("mensajeResultado").innerText = data; 
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById("mensajeResultado").innerText = "Ocurrió un error al enviar el proyecto.";
    });
}



function buscarIntegrantes(event) {
    let query = event.target.value;

    if (query.length > 2) {
        fetch('../controllers/buscarIntegrantes.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'query=' + encodeURIComponent(query)
        })
        .then(response => response.text())
        .then(data => {
            document.getElementById('resultadosIntegrantes').innerHTML = data;
            agregarEventoSeleccionIntegrante();
        })
        .catch(error => {
            console.error('Error en la búsqueda:', error);
            document.getElementById('resultadosIntegrantes').innerHTML = 'Error en la búsqueda.';
        });
    } else {
        document.getElementById('resultadosIntegrantes').innerHTML = '';
    }
}


function agregarEventoSeleccionIntegrante() {
    document.querySelectorAll('.integrante-item').forEach(item => {
        item.addEventListener('click', function() {
            let integranteID = this.getAttribute('data-id');
            let nombreIntegrante = this.textContent;

            if (!document.querySelector(`input[value="${integranteID}"]`)) {
                let listaSeleccionados = document.getElementById('integrantesSeleccionados');

             
                listaSeleccionados.innerHTML += `<li>${nombreIntegrante}</li>`;

              
                let hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'integrantesIDs[]';
                hiddenInput.value = integranteID;
                document.getElementById('formularioProyecto').appendChild(hiddenInput);

            
                document.getElementById('integrantesProyecto').value = '';
                document.getElementById('resultadosIntegrantes').innerHTML = '';
            }
        });
    });
}

// Inicializar Choices.js para los tags
document.addEventListener('DOMContentLoaded', function() {
    new Choices('#tagsProyecto', {
        removeItemButton: true,
        searchResultLimit: 5,
        placeholderValue: 'Selecciona o escribe tags',
        searchEnabled: true,
    });

   
    document.getElementById('formularioProyecto').addEventListener('submit', enviarProyecto);
    document.getElementById('integrantesProyecto').addEventListener('input', buscarIntegrantes);
});

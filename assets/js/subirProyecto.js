document.getElementById('formularioProyecto').addEventListener('submit', function (event) {
    event.preventDefault(); 


    let formData = new FormData();
    formData.append('nombreProyecto', document.getElementById('nombreProyecto').value);
    formData.append('descProyecto', document.getElementById('descProyecto').value);
    formData.append('archivoProyecto', document.getElementById('archivoProyecto').files[0]);
    formData.append('integrantesProyecto', document.getElementById('integrantesProyecto').value);


    let tagsProyecto = document.getElementById('tagsProyecto');
    let selectedTags = [];
    for (let option of tagsProyecto.options) {
        if (option.selected) {
            selectedTags.push(option.value);
        }
    }
    formData.append('tagsProyecto', selectedTags.join(','));

   
    let xhr = new XMLHttpRequest();
    xhr.open('POST', '../controllers/subirProyecto.php', true);

    xhr.onload = function () {
        if (xhr.status === 200) {
          
            document.getElementById('mensajeResultado').innerHTML = xhr.responseText;
        } else {
            document.getElementById('mensajeResultado').innerHTML = 'Ocurrió un error al enviar el proyecto.';
        }
    };

    xhr.send(formData); 
});
document.addEventListener('DOMContentLoaded', function () {
    const tagsProyecto = new Choices('#tagsProyecto', {
        removeItemButton: true,   
        searchResultLimit: 5,     
        placeholderValue: 'Selecciona o escribe tags', 
        searchEnabled: true,     
    });
});
document.getElementById('integrantesProyecto').addEventListener('input', function () {
    let query = this.value;

    if (query.length > 2) { 
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../controllers/buscarIntegrantes.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function () {
            if (xhr.status === 200) {
                document.getElementById('resultadosIntegrantes').innerHTML = xhr.responseText;
                agregarEventoSeleccionIntegrante();  
            } else {
                document.getElementById('resultadosIntegrantes').innerHTML = 'Error en la búsqueda.';
            }
        };

        xhr.send('query=' + encodeURIComponent(query));
    } else {
        document.getElementById('resultadosIntegrantes').innerHTML = '';
    }
});

function agregarEventoSeleccionIntegrante() {
    document.querySelectorAll('.integrante-item').forEach(function (item) {
        item.addEventListener('click', function () {
            let integranteID = this.getAttribute('data-id');
            let nombreIntegrante = this.textContent;

         
            if (!document.querySelector(`input[value="${integranteID}"]`)) {
                let listaSeleccionados = document.getElementById('integrantesSeleccionados');

        
                let li = document.createElement('li');
                li.textContent = nombreIntegrante;
                listaSeleccionados.appendChild(li);

        
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

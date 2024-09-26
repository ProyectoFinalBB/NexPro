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

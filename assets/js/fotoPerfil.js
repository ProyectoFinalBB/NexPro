
function cargarImagenPerfil() {
    const profileImage = document.getElementById('profileImage');
    const menuProfileimg = document.getElementById('profile-img');

    fetch('../controllers/get_profile_image.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                profileImage.src = data.imagePath; 
                menuProfileimg.src = data.imagePath; 
            } else {
                console.error('Error al cargar la imagen de perfil:', data.message);
            }
        })
        .catch(error => {
            console.error('Error en la petición AJAX:', error);
        });
}

document.getElementById('uploadButton').addEventListener('click', function () {
    document.getElementById('fileInput').click();
});

document.getElementById('fileInput').addEventListener('change', function (e) {
    const file = e.target.files[0];

    if (file) {
        const img = new Image();
        const reader = new FileReader();

        reader.onload = function (e) {
            img.src = e.target.result;
            img.onload = function() {
               
                if (img.width <= 1000 && img.height <= 1000) {
                    const formData = new FormData();
                    formData.append('image', file);

                    fetch('../controllers/upload_img.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('profileImage').src = data.imagePath;
                            
                            cargarImagenPerfil(); 
                            alert('Imagen subida exitosamente.');
                        } else {
                            alert('Error al subir la imagen: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Ocurrió un error al subir la imagen.');
                    });
                } else {
                    alert('Las dimensiones de la imagen deben ser menores de 1000x1000 píxeles.');
                }
            };
        };

        reader.readAsDataURL(file);
    } else {
        alert('Por favor, selecciona una imagen válida.');
    }
});

document.addEventListener('DOMContentLoaded', function () {
    cargarImagenPerfil();
});

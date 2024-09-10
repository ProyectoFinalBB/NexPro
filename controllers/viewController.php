<?php
session_start();

if (isset($_GET['ruta'])) {

    $ruta = $_GET['ruta'];

} else {
    echo "No se ha pasado ningún parámetro 'ruta'.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/styles.css"> 
</head>
<body>

<div class="container">
<div class="form-container">
<?php include($ruta); ?>
</div>
    <div class="container-frases">
        <img src="../assets/img/frases.png" alt="Frase motivacional" class="logo2">
    </div>
</div>


<script src="../assets/js/script.js" ></script>
<script>
    // Función para obtener el parámetro "param" de la URL
    function getParameterByName(name) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(name); // Retorna el valor del parámetro
    }

    // Obtener el valor del parámetro "param" en la URL
    const param = getParameterByName('param');

    // Verificar si existe el parámetro antes de llamar a la función
    if (param) {
        // Llamar a la función modificarUsrCampos con el valor del parámetro
        modificarUsrCampos(param);
    } else {
        console.log('El parámetro "param" no se encuentra en la URL.');
    }

</script>
</body>
</html>
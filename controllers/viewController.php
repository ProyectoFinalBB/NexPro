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
    <title>NexPro</title>
    <link rel="icon" href="../assets/img/logo.png" type="image/x-icon">
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
<p id="mensajeResultado"></p>



</body>
</html>